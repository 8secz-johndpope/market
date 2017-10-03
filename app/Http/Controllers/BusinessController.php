<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 21/09/2017
 * Time: 15:21
 */

namespace App\Http\Controllers;

use App\Mail\PayInvoice;
use App\Model\Address;
use App\Model\Business;
use App\Model\Pack;
use App\Model\Payment;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PDF;
use Illuminate\Support\Facades\Mail;

use App\Model\Contract;
use App\Model\ContractPack;
use App\Model\EmailCode;
use App\Model\ExtraPrice;
use App\Model\ExtraType;
use App\Model\Location;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\Price;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Advert;
use Illuminate\Support\Facades\Auth;
class BusinessController extends BaseController
{
    public function myads(Request $request){
        $user = Auth::user();
        $page = $request->page ? $request->page : 1;

        $pagesize = 10;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => ($page - 1) * $pagesize,
                'size' => $pagesize,
                'query' => [
                    'bool' => [
                        'must' => ['term' => ['user_id' => $user->id]],
                    ]
                ],
                "sort" => [
                    [
                        "created_at" => ["order" => "desc"]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $milliseconds = round(microtime(true) * 1000);
        $products = array_map(function ($a) use ($milliseconds) {

            $diff = $milliseconds-$a['_source']['created_at'];
            if($diff<60*1000){
                $a['_source']['posted'] = 'Just Now';
            }
            else if($diff<60*60*1000){
                $a['_source']['posted'] = (int)($diff/60000).'m ago';
            }
            else if($diff<24*60*60*1000){
                $a['_source']['posted'] = (int)($diff/(60*60000)).'h ago';
            }else{
                $a['_source']['posted'] = (int)($diff/(24*60*60000)).'d ago';
            }
            return $a['_source'];

        },$response['hits']['hits']);

        return view('business.ads',['total' => $response['hits']['total'], 'products' => $products,'mill'=>$milliseconds,'user'=>$user]);
    }
    public function finance(Request $request){
        $user = Auth::user();
        return view('business.finance',['user'=>$user]);

    }
    public function details(Request $request){
        $user = Auth::user();
        return view('business.details',['user'=>$user]);

    }
    public function invoice(Request $request,$id){
        $payment=Payment::find($id);
        if($payment->status!=='pending'){
            return redirect('/business/manage/finance');
        }

        $user=Auth::user();
        $invoice = new PayInvoice();
        $invoice->payment_id=$id;
        $invoice->reference=$payment->reference;
        Mail::to($user)->send($invoice);

        $user=Auth::user();
        $order = new Order;
        $order->buyer_id = $user->id;
        $order->payment_id = $id;
        $order->type='invoice';
        $order->save();
        $request->session()->put('order_id',$order->id);
        return redirect('/user/manage/order');
    }
    public function bump(Request $request){
        if(!$request->has('matrix')){
            return redirect('/business/manage/ads');
        }
        $order= new Order;
        $order->amount = 70;

        $order->save();
        foreach ($request->matrix as $id=>$ad) {
            $advert=Advert::find($id);
            $category = Category::find($advert->param('category'));
            $location = Location::where('res',$advert->param('location_id'))->first();

           // $extratypes = ExtraType::all();
            foreach ($ad as $key=>$val) {

                    $extraprice = ExtraPrice::where('key', $key)->first();
                    if($extraprice===null)
                        return $key.' do';
                    $orderitem = new OrderItem;
                    $orderitem->title = 'Featured';
                    $orderitem->slug = 'featured';
                    $orderitem->advert_id = $advert->id;
                    $orderitem->category_id = $category->id;
                    $orderitem->location_id = $location->id;
                    $orderitem->type_id = $extraprice->id;
                    $orderitem->amount = 0;
                    $orderitem->save();
                    $order->items()->save($orderitem);
            }
        }
        $request->session()->put('order_id', $order->id);

        return redirect('/user/manage/order');
    }
}