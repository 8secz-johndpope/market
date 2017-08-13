<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 11:12
 */

namespace App\Http\Controllers;

use App\Model\Advert;
use App\Model\Category;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user =  Auth::user();

            //Creating a token without scopes...
            $token = $user->createToken('Token Name')->accessToken;
            return ['token'=>$token];
        }else{
            return ['msg'=>"Invalid Credentials"];
        }
    }
    public function profile()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

// Get the currently authenticated user's ID...
        $id = Auth::id();
        return ["yes"=>"no",'user'=>$user];
    }


    public function token(Request $request){
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        $clientToken = $gateway->clientToken()->generate();
        return ['token'=>$clientToken];
    }
    public function nonce(Request $request){
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        $result = $gateway->transaction()->sale([
            "amount" => $request->amount,
            'paymentMethodNonce' => $request->payment_method_nonce,
            'options' => [
                'submitForSettlement' => True
            ]
        ]);
        return ['result'=>$result];
    }

    public function addcard(Request $request)
    {
        $user = Auth::user();

        $stripe_id=$user->stripe_id;
        $token=$request->token;
        $customer = \Stripe\Customer::retrieve($stripe_id);
        try{
            $res=$customer->sources->create(array("source" => $token));

        }catch (\Exception $e) {
            return [
                'success' => false,
                'result' => 'no such token'
            ];
        }
        return [
            'success' => true,
            'result' => $res
        ];
    }

    public function  cards(Request $request){
        $user = Auth::user();
        $stripe_id=$user->stripe_id;
        $cards=\Stripe\Customer::retrieve($stripe_id)->sources->all(array(
            'limit'=>10, 'object' => 'card'));
        return $cards;
    }
    public function charge(Request $request) {
        $user = Auth::user();

        $stripe_id=$user->stripe_id;
        $card = $request->card;
        $amount  = $request->amount*100;
        $description= $request->description;
        try{
            $charge=\Stripe\Charge::create(array(
                "amount" => $amount,
                "currency" => "gbp",
                "customer" => $stripe_id,
                "source" => $card, // obtained with Stripe.js
                "description" => $description
            ));
        }catch (\Exception $e) {
            return [
                'success' => false,
                'result' => 'error charging the card'
            ];
        }

        return ['status'=>'success','result'=>$charge];
    }
    public function adverts(Request $request)
    {

        $user = Auth::user();
        $page = $request->page ? $request->page : 1;

        $pagesize = 10;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from'=> ($page-1)*$pagesize,
                'size'=>$pagesize,
                'query' => [
                    'bool' => [
                        'must'=>['term'=>['user_id'=>$user->id]],
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);

        return ['total'=>$response['hits']['total'],'adverts'=>$products];
    }
    public function create(Request $request){
        $user = Auth::user();
        $advert =  new Advert;
        $advert->save();
        $body=$request->json()->all();
        $body['source_id']=$advert->id;
        $milliseconds = round(microtime(true) * 1000);
        $body['created_at']=$milliseconds;
        $body['username']=$user->name;
        $body['user_id']=$user->id;
        $body['phone']=$user->phone;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => $body
        ];
        $response = $this->client->index($params);
        $advert->sid=$advert->id;
        $advert->elastic=$response['_id'];
        $advert->save();

        return ['body'=>$body,'response'=>$response];
    }
    public function ccreate(Request $request){
        $body=$request->json()->all();
        $category=Category::where('slug',$body['slug'])->first();
        if($category===null){
            $category=new Category;
            $category->slug=$body['slug'];
            $category->save();

        }
        $body['category']=$category->id;
        $advert=Advert::where('sid','=',(int)$body['source_id'])->first();
        if($advert!==null){
            return ['a'=>'b'];
        }

        $advert =  new Advert;

        $advert->sid=(int)$body['source_id'];
        $advert->save();
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => $body
        ];
        $response = $this->client->index($params);
        $advert->elastic=$response['_id'];
        $advert->save();
        return ['response'=>$response];
    }
    public function register(Request $request){
        if(!$request->has('email'))
            return ['msg'=>"Email can't be blank"];
        if(!$request->has('password'))
            return ['msg'=>"Password can't be blank"];
        if(!$request->has('name'))
            return ['msg'=>"Name can't be blank"];
        if(!$request->has('phone'))
            return ['msg'=>"Phone can't be blank"];
        $user = User::where('email',$request->email)->first();
        if($user!==null){
            return ['msg'=>'Email is already registered'];
        }
        $user = new User;
        $user->more(['email'=>$request->email,'name'=>$request->name,'password'=> bcrypt($request->password),'phone'=>$request->phone]);
        $user->save();
        return ['msg'=>'success'];
    }

}