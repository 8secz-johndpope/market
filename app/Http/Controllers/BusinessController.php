<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 21/09/2017
 * Time: 15:21
 */

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Business;
use App\Model\Pack;
use App\Model\Payment;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use PDF;
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
        $favorites = $user->favorites;
        $sids = array();
        foreach ($favorites as $favorite){
            $sids[] = $favorite->sid;
        }
        return view('business.ads',['total' => $response['hits']['total'], 'products' => $products,'sids'=>$sids]);
    }
}