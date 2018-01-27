<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 21/09/2017
 * Time: 15:21
 */

namespace App\Http\Controllers;

use App\Mail\PayInvoice;
use App\Model\Address;
use App\Model\Business;
use App\Model\Image;
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

        $milliseconds = round(microtime(true) * 1000);


        return view('business.ads',['mill'=>$milliseconds,'user'=>$user]);
    }
    public function finance(Request $request){
        $user = Auth::user();
        return view('business.finance',['user'=>$user]);

    }
    public function images(Request $request){
        $user = Auth::user();
        return view('business.images',['user'=>$user]);

    }
    public function image(Request $request){
        $user = Auth::user();
        $image = new Image;
        $image->image = $request->image;
        $image->user_id=$user->id;
        $image->save();
       return ['msg'=>'done'];

    }
    public function add_images(Request $request){
        $advert=Advert::find($request->id);
        if($request->has('images')){
            $body['images']=array_merge($request->images,$advert->param('images'));
        }else{
            $body['images']=[];
        }
        $advert->update_fields($body);
        $advert->save();
        return redirect('/user/manage/ads');

    }
    public function auto(Request $request,$id,$count){
        $user = Auth::user();
        $category=Category::find($id);
        return view('business.auto',['user'=>$user,'category'=>$category,'count'=>$count]);

    }
    public function details(Request $request){

        $user = Auth::user();
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        $stripe_id = $user->stripe_id;

        try{
            $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
                'limit' => 10, 'object' => 'card'));
            $cards = $cards['data'];

        }catch (\Exception $exception){
            $cards = [];
        }
        try{
            $accounts = \Stripe\Account::retrieve($user->stripe_account)->external_accounts->all(array(
                'limit'=>3, 'object' => 'bank_account'));
            $accounts=$accounts['data'];
        }catch (\Exception $exception){
            $accounts = [];
        }
        if(count($user->addresses)>0&&$user->default_address===0){
            $address = $user->addresses[0];
            $user->default_address=$address->id;
            $user->save();
        }
        $account=\Stripe\Account::retrieve($user->stripe_account);



        return view('business.details',['user'=>$user,'cards'=>$cards,'accounts'=>$accounts,'jobs'=>Category::job_leaves(),'balance'=>$balance,'account'=>$account]);

    }
    public function swallet(Request $request){
        $user = Auth::user();
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        $stripe_id = $user->stripe_id;

        try{
            $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
                'limit' => 10, 'object' => 'card'));
            $cards = $cards['data'];

        }catch (\Exception $exception){
            $cards = [];
        }
        try{
            $accounts = \Stripe\Account::retrieve($user->stripe_account)->external_accounts->all(array(
                'limit'=>3, 'object' => 'bank_account'));
            $accounts=$accounts['data'];
        }catch (\Exception $exception){
            $accounts = [];
        }
        if(count($user->addresses)>0&&$user->default_address===0){
            $address = $user->addresses[0];
            $user->default_address=$address->id;
            $user->save();
        }
        $account=\Stripe\Account::retrieve($user->stripe_account);
       return view('business.swallet',['user'=>$user,'cards'=>$cards,'accounts'=>$accounts,'balance'=>$balance,'account'=>$account]);
    }
    public function company(Request $request){
        $user = Auth::user();
        return view('business.company',['user'=>$user]);

    }
    public function metrics(Request $request){
        $user = Auth::user();
        return view('business.metrics',['user'=>$user]);

    }
    public function csv(Request $request){

        $path = $request->csv;//->store('images');
        $row = 1;

        if (($handle = fopen($path->path(), "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                echo "<p> $num fields in line $row: <br /></p>\n";
                $row++;
                for ($c=0; $c < $num; $c++) {
                    echo $data[$c] . "<br />\n";
                }

            }
            fclose($handle);

         }
        return $path->path();
    }
    public function support(Request $request){
        $user = Auth::user();
        return view('business.support',['user'=>$user]);

    }
    public function multiple(Request $request){
        $user=Auth::user();
        $count=$request->count;
        $category=Category::find($request->category);
        foreach (range(1, $count) as $number){
            $ad = new Advert;
            $ad->save();
            $ad->create_draft();
            $ad->category_id=$category->id;
            $ad->save();
            $body=[];
            if($request->has($number.'_postcode')){
                $up =   str_replace(' ','',strtoupper($request->get($number.'_postcode')));
                $a = Postcode::where('hash',crc32($up))->first();
                if($a!==null){
                    $ad->postcode_id=$a->id;
                    $body['location']=$a->lat.','.$a->lng;
                    $body['location_id']=$a->location->res;
                    $body['location_name']=$a->location->title;
                }
            }

            $body['category']=$category->id;
            if($request->has($number.'_title'))
                $body['title']=$request->get($number.'_title');
            if($request->has($number.'_description'))
                $body['description']=$request->get($number.'_description');
            $ad->update_fields($body);
            $body=[];
            foreach ($ad->category->fields as $field){
                if($field->slug!=='price'&&$request->has($number.'_'.$field->slug)){
                    $body[$field->slug] = $request->get($number.'_'.$field->slug);
                }
            }
            if($request->has($number.'_'.'price')){
                $body['price']=$request->get($number.'_'.'price')*100;
            }else{
                $body['price']=-1;
            }
            $ad->update_meta($body);


        }
        return redirect('/user/manage/ads');
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
        $user = Auth::user();
        if(!$request->has('matrix')){
            return redirect('/business/manage/ads');
        }
        $order= new Order;
        $order->amount = 70;
        $order->type='bump';
        $order->buyer_id=$user->id;
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
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }

}