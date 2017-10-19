<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 11:12
 */

namespace App\Http\Controllers;

use App\Mail\AccountCreated;
use App\Mail\OrderShipped;
use App\Model\Address;
use App\Model\Advert;
use App\Model\ExtraPrice;
use App\Model\ExtraType;
use App\Model\Location;
use App\Model\SearchAlert;
use Validator;
use App\Model\Application;
use App\Model\Category;
use App\Model\Cover;
use App\Model\Cv;
use App\Model\EmailCode;
use App\Model\Favorite;
use App\Model\Featured;
use App\Model\Interest;
use App\Model\Offer;
use App\Model\Order;

use App\Model\OrderItem;
use App\Model\Payment;
use App\Model\Phone;
use App\Model\Postcode;
use App\Model\Price;
use App\Model\Report;
use App\Model\Review;
use App\Model\Shipping;
use App\Model\Spotlight;
use App\Model\Transaction;
use App\Model\Urgent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use Mockery\Exception;
use Twilio\Rest\Client;

class UserController extends BaseController
{
    public function contacts(Request $request){

        $numbers = $request->numbers;
        foreach ($numbers as $number){
            try{
                $phone = new Phone;
                $phone->phone=$number;
                $phone->save();
            }catch (\Exception $e){

            }
        }
        $users = DB::table('users')
            ->whereIn('phone', $numbers)->get();
        return $users;
    }
    public function postcode(Request $request){

        $up =   str_replace(' ','',strtoupper($request->q));
        $a = Postcode::where('hash',crc32($up))->first();
        if($a===null){
            return ['msg'=>'Not valid'];
        }else{
            return ['msg'=>'yes','val'=>$a->postcode,'id'=>$a->location->id];
        }
    }
    public function corder(Request $request){
        $advert=Advert::find($request->id);
        $order= new Order;
        $order->amount = 70;
        $order->type='bump';
        $order->advert_id=$request->id;
        $order->save();

        $extratypes=ExtraType::all();
        foreach ($extratypes as $type){
            if($request->has($type->slug)&&$request->get($type->slug)==1){
                $key = $type->slug;
                if($type->type==='list'){
                    $key = $request->get($type->key);
                }
                $extraprice = ExtraPrice::where('key',$key)->first();
                $orderitem = new OrderItem;
                $orderitem->title = 'Featured';
                $orderitem->slug = 'featured';
                $orderitem->advert_id=$advert->id;
                $orderitem->category_id = $advert->param('category');
                $orderitem->location_id = $advert->location()->id;
                $orderitem->type_id = $extraprice->id;
                $orderitem->amount = 0;
                $orderitem->save();
                $order->items()->save($orderitem);


            }

        }
        return ['id'=>$order->id,'total'=>$order->amount()*100];
    }
    public function complete_bump(Request $request,$id){
        $order=Order::find($id);
        $transaction = Transaction::where('slug', $request->transaction_id)->first();
        if ($transaction === null || $transaction->used === 1) {
            return ['result' => ['msg' => 'Not a valid transaction id']];
        }

        if ($transaction->amount < $order->amount()*100) {
            return ['msg' => 'Wrong transaction amount'];
        }
        $transaction->used=1;
        $transaction->save();
        foreach ($order->items as $item) {
            $advert = Advert::find($item->advert_id);
            $milliseconds = round(microtime(true) * 1000);


            if($item->price()===0){
                $pack = $item->pack();
                $pack->remaining--;
                $pack->save();
            }
            if($item->type->key==='bump') {
                if($advert->has_param('bumped'))
                    $body['bumped']=$advert->param('bumped')+1;
                else
                    $body['bumped']=1;
                $body['created_at']=$milliseconds;
            }else{
                $body[$item->type->extra_type->slug] = 1;

                $body[$item->type->extra_type->slug.'_count'] = 0;


                $body[$item->type->extra_type->slug.'_expires'] = $milliseconds + $item->type->quantity * 24 * 3600 * 1000;
            }


            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $advert->elastic,
                'body' => [
                    'doc' => $body
                ]
            ];

// Update doc at /my_index/my_type/my_id
            $response = $this->client->update($params);
        }


        $order->payment = 'done';
        $order->save();
        return ['id'=>$order->id,'msg'=>'done'];

    }
    public function userads(Request $request, $id)
    {
        $ad = Advert::where('sid',$id)->first();
        if($ad->user_id===0)
        {
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $ad->elastic
            ];
            $response = $this->client->get($params);
            return [$response['_source']];
        }

        $user = User::find($ad->user_id);
        $adverts = [];
        foreach ($user->adverts()->paginate(15) as $advert){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $advert->elastic
            ];
            $response = $this->client->get($params);
            if(!isset($response['_source']['draft'])&&!isset($response['_source']['inactive']))
            $adverts[]=$response['_source'];
        }
        return ['adverts'=>$adverts,'total'=>count($adverts)];
    }

        public function login(Request $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            //Creating a token without scopes...
            $token = $user->createToken('Token Name')->accessToken;
            return ['token' => $token, 'id' => $user->id, 'email' => $user->email, 'name' => $user->name];
        } else {
            return ['msg' => "Invalid Credentials"];
        }
    }

    public function contract(Request $request)
    {

        $price = $this->cprice($request);
        $discounted = (int)(0.75 * $price);
        if ($discounted < 250000) {
            return ['msg' => 'Minimum £2500 is needed to start a contract'];
        }
        if (!$request->has('transaction_id')) {
            return ['msg' => '5% deposit is required to start the contract'];
        }
        $monthly = (int)(0.95 * 1.2 * $price / 12);
        foreach (range(3, 15) as $i) {
            $payment = new Payment;
            $payment->amount = $monthly;
            $payment->charge_at = date("Y-m-d H:i:s", strtotime('+' . $i . ' months'));
            $payment->save();
        }
        return ['msg' => 'contract has just started'];

    }

    public function addcv(Request $request)
    {
        $user = Auth::user();
        $category = $request->category;
        $title = $request->title;
        $file_name = $request->file_name;

        $cv = new Cv;
        $cv->category_id = $category;
        $cv->title = $title;
        $cv->file_name = $file_name;
        $cv->user_id = $user->id;
        $cv->save();
        return ['msg' => 'Cv added'];

    }

    public function getcvs()
    {
        $user = Auth::user();

        return ["cv" => $user->cvs, "covers" => $user->covers];
    }


    public function review(Request $request)
    {
        $user = Auth::user();
        $order_id = $request->order_id;
        $order = Order::find($order_id);

        if ($order === null) {
            return ['msg' => 'No order found'];
        }
        if ($order->buyer_id !== $user->id) {
            return ['msg' => 'You cannot rate this order'];
        }
        $review = $request->review;
        $cv = new Review;
        $cv->order_id = $order->id;
        $cv->review = $review;
        $cv->description_rating = $request->description_rating;
        $cv->communication_rating = $request->communication_rating;
        $cv->dispatchtime_rating = $request->dispatchtime_rating;
        $cv->postage_rating = $request->postage_rating;
        $cv->save();

        return ['msg' => 'Review added'];

    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $advert = Advert::find($request->id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['msg' => 'Advert not found'];
        }
        if ($advert->user_id != $user->id) {
            return ['msg' => 'Advert does not belong to you'];
        }
        $body=[];
        if($request->has('title'))
            $body['title']=$request->title;
        if($request->has('description'))
            $body['description']=$request->description;
        if($request->has('images')){
            $body['images']=$request->images;
        }
        $advert->update_fields($body);
        $body=[];
        foreach ($advert->category->fields as $field){
            if($field->slug!=='price'&&$request->has($field->slug)){
                $body[$field->slug] = $request->get($field->slug);
            }
        }
        if($request->has('price')){
            $body['price']=$request->price*100;
        }else{
            $body['price']=-1;
        }
        $advert->update_meta($body);
        return ['msg' => 'updated', 'response' => []];
    }

    public function delete(Request $request)
    {
        $user = Auth::user();
        $advert = Advert::find($request->id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['code' => 1, 'msg' => 'Advert not found'];
        }
        if ($advert->user_id != $user->id) {
            return ['code' => 2, 'msg' => 'Advert does not belong to you'];
        }
        $advert->make_inactive();
        return ['code' => 3, 'msg' => 'deleted', 'response' => []];
    }
    public function repost(Request $request)
    {
        $user = Auth::user();
        $advert = Advert::find($request->id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['code' => 1, 'msg' => 'Advert not found'];
        }
        if ($advert->user_id != $user->id) {
            return ['code' => 2, 'msg' => 'Advert does not belong to you'];
        }
        $advert->make_active();
        return ['code' => 3, 'msg' => 'reposted', 'response' => []];
    }
    public function addcover(Request $request)
    {
        $user = Auth::user();
        $category = $request->category;
        $title = $request->title;
        $cover = $request->cover;

        $cv = new Cover;
        $cv->category_id = $category;
        $cv->title = $title;
        $cv->cover = $cover;
        $cv->user_id = $user->id;
        $cv->save();
        return ['msg' => 'Cover added'];
    }
    public function duplicate(Request $request,$id)
    {
        $advert=Advert::find($id);
        $advert->duplicate();
        return ['msg'=>'duplicated'];
    }

    public function alerts(Request $request){
        $user = Auth::user();
        $alerts = $user->alerts;
        foreach ($alerts as $alert){
            $alert->category=$alert->category;
            $alert->location=$alert->location;
        }
        return $alerts;
    }

    public function alert(Request $request,$id){
        $category=Category::find($id);
        $location=Location::find($request->id);
        $alert = new SearchAlert;
        $user=Auth::user();
        $alert->user_id=$user->id;
        $alert->category_id=$category->id;
        $alert->location_id=$location->id;
        $alert->save();
        return ['msg'=>'done'];
    }
    public function delete_alert(Request $request,$id){
        $alert=SearchAlert::find($id);
        $alert->delete();
        return ['msg'=>'done'];
    }
    public function toggle_alert(Request $request,$id){
        $alert=SearchAlert::find($id);
        $alert->active=!$alert->active;
        $alert->save();
        return ['msg'=>'done'];
    }
    public function suggest(Request $request)
    {

        $text = $request->q;
        if(preg_match('/\s/',$text)>0){
            $dict = ['title.keyword'=> strtolower($text)];

        }else{
            $dict = ['title'=> strtolower($text)];

        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size' => 0,
                'query' => ['bool'=>['should'=>[['term'=>$dict]]]],
                'aggs' => [
                    'group_by_category' => [
                        "terms" => [ "field"=> "category", "size"=> 5]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        // return $response;
        $buckets = $response['aggregations']['group_by_category']['buckets'];
        $bts = array_filter($buckets, function( $a ) {

            return Category::find($a['key']) !== null;
        } );
        $bts = array_values($bts);
        //return $bts;
        $categories=array();
        foreach ($bts as $bt){
            $category = Category::find($bt['key']);
            $parents = array();
            $cur = $category;
            while ($cur->parent!==null){
                $parents[]=$cur->parent;
                $cur=$cur->parent;
            }
            $titles =  array_map(function ($a) {
                return $a->title;
            }, $parents);
            $titles =  array_reverse($titles);
            $category->parentstring = implode(' > ',$titles);
            $categories[]=$category;
        }

        return $categories;
    }
    public function save(Request $request){
        if($request->has('id'))
        $advert=Advert::find($request->id);
        else
        {
            $advert=new Advert;
            $advert->save();
            $advert->create_draft();
        }
        $body=[];
        if($request->has('postcode')){
            $up =   str_replace(' ','',strtoupper($request->postcode));
            $a = Postcode::where('hash',crc32($up))->first();
            if($a!==null){
                $advert->postcode_id=$a->id;
                $body['location']=$a->lat.','.$a->lng;
                $body['location_id']=$a->location->res;
                $body['location_name']=$a->location->title;
            }
        }
        if($request->has('category')){
            $category=Category::find($request->category);
            $advert->category_id=$category->id;
            $advert->save();
            $body['category']=$category->id;

        }
        if($request->has('title'))
            $body['title']=$request->title;
        if($request->has('images'))
            $body['images']=$request->images;
        if($request->has('description'))
            $body['description']=$request->description;
        $advert->update_fields($body);
        $body=[];
        foreach ($advert->category->fields as $field){
            if($field->slug!=='price'&&$request->has($field->slug)){
                $body[$field->slug] = $request->get($field->slug);
            }
        }
        if($request->has('price')){
            $body['price']=$request->get('price')*100;
        }else{
            $body['price']=-1;
        }
        $advert->update_meta($body);
        if($request->has('post')){
            $advert->publish();
            return ['msg'=>'posted'];
        }
        return ['msg'=>'saved'];
    }

    public function offer(Request $request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
        $id = $request->id;
        $advert = Advert::find($id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['msg' => 'No Advert found'];
        }

        $offer = new Offer;
        $offer->amount = $request->amount;
        $offer->user_id = $user->id;
        $offer->save();

        $advert->offers()->save($offer);
        return ['msg' => 'Offer successfully sent'];

    }

    public function favorite(Request $request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
        $id = $request->id;
        $advert = Advert::find($id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['msg' => 'No Advert found'];
        }


        $favorite = new Favorite;
        $favorite->advert_id = $advert->id;
        $favorite->user_id = $user->id;
        $favorite->save();

        return ['msg' => 'Favorite sent'];

    }
    public function unfavorite(Request $request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
        $id = $request->id;
        $advert = Advert::find($id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['msg' => 'No Advert found'];
        }


        $favorite =  Favorite::where('user_id',$user->id)->where('advert_id',$advert->id)->first();
        if($favorite!==null)
        $favorite->delete();

        return ['msg' => 'Favorite removed'];

    }
    public function text(Request $request) {
        $sid = 'AC7237043426f3c67ac884ab4b4b0d3ff3';
        $token = 'cd153bce35fcea43c3dadf1a9373aad7';
        $client = new Client($sid, $token);
        $code = rand(1000,9999);
        if($request->has('testing')){

            return ['code'=>$code];
        }

// Use the client to do fun stuff like send text messages!
        $client->messages->create(
        // the number you'd like to send the message to
            $request->phone,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+441202286628',
                // the body of the text message you'd like to send
                'body' => 'Sumra: Your verification code is '.$code
            )
        );
        return ['code'=>$code];
    }
    public function ctext(Request $request) {
        $sid = 'AC7237043426f3c67ac884ab4b4b0d3ff3';
        $token = 'cd153bce35fcea43c3dadf1a9373aad7';
        $client = new Client($sid, $token);


// Use the client to do fun stuff like send text messages!
        $client->messages->create(
        // the number you'd like to send the message to
            $request->phone,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+441202286628',
                // the body of the text message you'd like to send
                'body' => $request->message
            )
        );
        return ['code'=>'yes'];
    }
    public function favorites()
    {
        $user = Auth::user();
        $favs = $user->favorites;


        $adverts = array();
        foreach ($favs as $favorite){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $favorite->elastic
            ];
            $response = $this->client->get($params);
            $adverts[]=$response['_source'];
        }

        return ['favorites' => $favs ,'adverts'=>$adverts];
    }



    public function report(Request $request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
        $id = $request->id;
        $advert = Advert::find($id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['msg' => 'No Advert found'];
        }
        $report = new Report;
        $report->advert_id = $advert->id;
        $report->user_id = $user->id;
        $report->info = $request->info;
        $report->save();

        return ['msg' => 'Report sent'];

    }

    public function apply(Request $request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
        $id = $request->id;
        $advert = Advert::find($id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['msg' => 'No Advert found'];
        }
        $cover = Cover::find($request->cover_id);
        if ($cover === null) {
            return ['msg' => 'No Cover found'];
        }
        $cv = Cv::find($request->cv_id);
        if ($cv === null) {
            return ['msg' => 'No Cv found'];
        }
        $application = new Application;
        $application->advert_id = $advert->id;
        $application->user_id = $user->id;
        $application->cv_id = $cv->id;
        $application->cover_id = $cover->id;
        $application->save();

        return ['msg' => 'Application sent'];

    }

    public function interest(Request $request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();
        $id = $request->id;
        $advert = Advert::find($id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        if ($advert === null) {
            return ['msg' => 'No Advert found'];
        }
        $interest = new Interest;
        $interest->advert_id = $advert->id;
        $interest->user_id = $user->id;
        $interest->save();

        return ['msg' => 'Interest sent'];

    }

    public function profile()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

// Get the currently authenticated user's ID...
        //$id = Auth::id();

        return ['email_verified'=>$user->email_verified,"phone" => $user->phone, "email" => $user->email, "name" => $user->name, 'featured' => $user->featured, 'urgent' => $user->urgent, 'spotlight' => $user->spotlight, 'balance' => $user->balance, 'available' => $user->available, 'shipping' => $user->shipping, 'cvs' => $user->cvs, 'covers' => $user->covers];
    }

    public function price(Request $request)
    {
        // Get the currently authenticated user...
        $user = Auth::user();

// Get the currently authenticated user's ID...
        //$id = Auth::id();
        $category = $request->category;
        $lat = $request->lat;
        $lng = $request->lng;
        return Price::find(1);
    }

    public function mprice(Request $request)
    {

        return ['price' => (int)( $this->cprice($request))];
    }

    public function cprice($request)
    {

        $price = Price::find(1);
        $featured = $request->featured;
        $urgent = $request->urgent;
        $spotlight = $request->spotlight;
        $featured_14 = $request->featured_14;
        $shipping_1 = $request->shipping_1;
        $shipping_2 = $request->shipping_2;
        $shipping_3 = $request->shipping_3;
        return (int)(($featured * $price->featured + $urgent * $price->urgent + $spotlight * $price->spotlight + $featured_14 * $price->featured_14 + $shipping_1 * $price->shipping_1 + $shipping_2 * $price->shipping_2 + $shipping_3 * $price->shipping_3));
    }

    public function token(Request $request)
    {
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        $clientToken = $gateway->clientToken()->generate();
        return ['token' => $clientToken];
    }

    public function stripe(Request $request)
    {
        $token = \Stripe\Token::create(array(
            "card" => array(
                "number" => "4242424242424242",
                "exp_month" => 8,
                "exp_year" => 2018,
                "cvc" => "314"
            )
        ));
        return $token;
    }

    public function nonce(Request $request)
    {
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        try {
            $result = $gateway->transaction()->sale([
                "amount" => $request->amount,
                'paymentMethodNonce' => $request->payment_method_nonce,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            $transaction = new Transaction;
            $transaction->slug = uniqid();
            $transaction->amount = $request->amount * 100;
            $transaction->save();
            return ['status' => 'success', 'result' => $result, 'transaction_id' => $transaction->slug];
        } catch (Exception $e) {
            return ['result' => ['msg' => 'failed']];
        }

    }

    public function addcard(Request $request)
    {
        $user = Auth::user();

        $stripe_id = $user->stripe_id;
        $token = $request->token;
        $customer = \Stripe\Customer::retrieve($stripe_id);
        try {
            $res = $customer->sources->create(array("source" => $token));
            $user->vid='V2';
            $user->save();

        } catch (\Exception $e) {
            return [
                'success' => false,
                'result' => ['msg' => 'no such token']
            ];
        }
        return [
            'success' => true,
            'result' => $res
        ];
    }

    public function cards(Request $request)
    {
        $user = Auth::user();
        $stripe_id = $user->stripe_id;
        $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
            'limit' => 10, 'object' => 'card'));
        return $cards;
    }

    public function charge(Request $request)
    {
        $user = Auth::user();

        $stripe_id = $user->stripe_id;
        $card = $request->card;
        $amount = $request->amount * 100;
        $description = $request->description;
        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount,
                "currency" => "gbp",
                "customer" => $stripe_id,
                "source" => $card, // obtained with Stripe.js
                "description" => $description
            ), array("stripe_account" => "{$user->stripe_account}"));
            $transaction = new Transaction;
            $transaction->slug = uniqid();
            $transaction->amount = $amount;
            $transaction->save();
            return ['status' => 'success', 'result' => $charge, 'transaction_id' => $transaction->slug];

        } catch (\Exception $e) {
            return [
                'status' => 'failed',
                'error' => $e,
                'result' => ['msg' => 'error charging the card']
            ];
        }


    }

    public function dob(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->dob->day = $request->day;
        $account->legal_entity->dob->month = $request->month;
        $account->legal_entity->dob->year = $request->year;
        $account->save();
        return ['status' => 'success'];
    }

    public function identity(Request $request)
    {
        $user = Auth::user();

        $filename = $request->name;
        copy('https://s3.eu-central-1.amazonaws.com/chat.sumra.net/' . $filename, '/tmp/' . $filename);
        $fp = fopen('/tmp/' . $filename, 'r');
        $result = \Stripe\FileUpload::create(array(
            'purpose' => 'identity_document',
            'file' => $fp
        ));
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->verification->document = $result->id;
        $account->save();
        return ['status' => 'success'];
    }

    public function add_address(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->address->line1 = $request->line1;
        $account->legal_entity->address->city = $request->city;
        $account->legal_entity->address->postal_code = $request->postcode;
        $account->save();
        $address = new Address;
        $address->line1 = $request->line1;
        $address->city = $request->city;
        $address->postcode = $request->postcode;
        $address->code = rand(1000, 9999);
        $address->save();
        $user->addresses()->save($address);
        return ['status' => 'success'];
    }

    public function addresses(Request $request)
    {
        $user = Auth::user();

        return $user->addresses;
    }

    public function verify_address(Request $request, $id)
    {
        $address = Address::find($id);
        if ($address->code === $request->code) {
            $address->verified = 1;
            $address->save();
            return ['status' => 'success'];
        } else {
            return ['status' => 'failed'];
        }

    }

    public function account(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $data['object'] = 'bank_account';
        $data['account_number'] = $request->number;
        $data['country'] = 'gb';
        $data['currency'] = 'gbp';
        $data['routing_number'] = $request->sortcode;
        $account->external_accounts->create(array("external_account" => $data));
        $user->vid='V3';
        $user->save();
        return ['status' => 'success'];
    }

    public function terms(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->tos_acceptance->date = $request->date;
        $account->tos_acceptance->ip = $request->ip;
        $account->save();
        return ['status' => 'success'];
    }

    public function info()
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        /*
        $balance = \Stripe\Balance::retrieve(
            array("stripe_account" => $user->stripe_account)
        );
        */
        $stripe_id = $user->stripe_id;
        $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
            'limit' => 10, 'object' => 'card'));
        return ['account' => $account, 'balance' => $user->balance, 'available' => $user->available, 'cards' => $cards];
    }

    public function withdraw(Request $request)
    {
        $user = Auth::user();
        $bank = $request->bank;
        $amount = $request->amount * 100;
        \Stripe\Transfer::create(array(
            "amount" => $amount,
            "currency" => "gbp",
            "destination" => $user->stripe_account
        ));
        \Stripe\Stripe::setApiKey($user->sk_key);
        try {
            \Stripe\Payout::create(array(
                "amount" => $amount,
                "currency" => "gbp",
                "destination" => $bank
            ));
            $user->balance -= $amount;
            $user->available -= $amount;
            $user->save();
        } catch (\Exception $e) {
            return [
                'success' => false,
                'result' => 'error withdrawing'
            ];
        }

        return ['status' => 'success'];
    }


    public function adverts(Request $request)
    {

        $type = $request->type;
        $user = Auth::user();
        $adverts = [];
        foreach ($user->adverts()->paginate(200) as $advert){
            if($advert->elastic) {

                try{
                    $params = [
                        'index' => 'adverts',
                        'type' => 'advert',
                        'id' => $advert->elastic
                    ];
                    $response = $this->client->get($params);
                    $response['_source']['posted']=$advert->posted();
                     if($type==='draft'&&isset($response['_source']['draft'])){
                         $adverts[] = $response['_source'];
                    }
                     if($type==='inactive'&&isset($response['_source']['inactive'])){
                        $adverts[] = $response['_source'];
                    }
                    if($type==='live'&&!isset($response['_source']['inactive'])&&!isset($response['_source']['draft'])){
                        $adverts[] = $response['_source'];
                    }

                }catch (\Exception $e){

                }


            }
        }

        return ['total' => count($adverts), 'adverts' => $adverts];
    }

    public function create(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'title' => 'required|max:255',
            'postcode' => 'required',
            'category' => 'required',
            'description' => 'required',
        ]);
        if ($validator->fails()) {
            //
            return $validator->messages();
        }
        $user = Auth::user();
        $category=Category::find($request->category);

        $postcode = Postcode::where('postcode',strtoupper(str_replace(' ','',$request->postcode)))->first();
        $location=$postcode->location;
        $fields = $category->fields;

        $body['category'] = $category->id;
        $milliseconds = round(microtime(true) * 1000);
        $body['created_at'] = $milliseconds;
        $body['username'] = $user->name;
        $body['user_id'] = $user->id;
        $body['phone'] = $user->phone;
        $advert = new Advert;
        $advert->save();
        $advert->sid = $advert->id;
        $advert->save();
        $body['source_id']=$advert->id;
        $body['title']=$request->title;
        $body['description']=$request->description;
        $body['location_name']=$location->title;
        $body['location_id']=$location->res;

        $body['location']=$postcode->lat.','.$postcode->lng;
        $body['views']=0;
        $body['list_views']=0;
        if($request->has('images')){
            $body['images']=$request->images;
        }else{
            $body['images']=[];
        }

        $body['meta']['price']=(int)($request->price*100);
        foreach ($fields as $field){
            if($field->slug!=='price'&&$request->has($field->slug)){
                $body['meta'][$field->slug] = $request->get($field->slug);
            }
        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => $body
        ];

        $response = $this->client->index($params);
        $advert->sid = $advert->id;
        $advert->user_id=$user->id;
        $advert->category_id=$category->id;
        $advert->postcode_id=$postcode->id;
        $advert->elastic = $response['_id'];
        $advert->save();
        if ($user->offer === 0) {
            $user->balance += 500;
            $user->available += 500;
            $user->offer = 1;
            $user->save();
        }

        return ['body' => $body, 'response' => $response,'id'=>$advert->id];
    }

    public function order(Request $request)
    {
        $user = Auth::user();
        $advert = Advert::find($request->id);
        if ($advert === null) {
            return ['msg' => 'Advert not found'];
        }

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic
        ];

        $response = $this->client->get($params);

        $price = $response['_source']['meta']['price'];
        $transaction = Transaction::where('slug', $request->transaction_id)->first();
        if ($transaction === null || $transaction->used === 1) {
            return ['result' => ['msg' => 'Not a valid transaction id']];
        }

        if ($transaction->amount != $price) {
            return ['msg' => 'Wrong transaction amount'];
        }


        $order = new Order;
        $order->advert_id = $response['_source']['source_id'];
        $order->buyer_id = $user->id;
        $order->save();
        return ['success' => true, 'msg' => 'Order successfully placed'];
    }

    public function topup(Request $request)
    {
        $user = Auth::user();

        $transaction = Transaction::where('slug', $request->transaction_id)->first();
        if ($transaction === null || $transaction->used === 1) {
            return ['result' => ['msg' => 'Not a valid transaction id']];
        }

        $total = $transaction->amount;
        $transaction->used = 1;
        $transaction->save();
        $user->available += $total;
        $user->balance += $total;
        $user->save();

        return ['success' => true, 'result' => ['msg' => 'The amount is added to account']];
    }

    public function buy(Request $request)
    {
        $user = Auth::user();
        // return $user;
        // $body = $request->json()->all();

        $balance = (int)$request->balance;
        $total = $this->cprice($request);
        $subtract = 0;
        if ($balance === 1) {

            if ($total > $user->available) {
                $total -= $user->available;
                $subtract = $user->available;
            } else {
                $total = 0;
                $subtract = $total;
            }

        }
        if ($total === 0) {


            $user->available -= $subtract;
            $user->balance -= $subtract;
            $user->save();
            //     return ['success'=>true,'result'=>['msg'=>'The packs successfully added to account'],'featured'=>$user->featured,'urgent'=>$user->urgent,'spotlight'=>$user->spotlight,'balance'=>$user->balance,'available'=>$user->available,'shipping'=>$user->shipping];
        }

        if ($total > 0) {
            $transaction = Transaction::where('slug', $request->transaction_id)->first();
            if ($transaction === null || $transaction->used === 1) {
                return ['success' => false, 'result' => ['msg' => 'Not a valid transaction id']];
            }
            if ($transaction->amount < $total) {
                return ['success' => false, 'result' => ['msg' => 'Not enough amount in the transaction']];
            }
        }
        $featured = array();
        $urgent = array();
        $spotlight = array();
        $shipping = array();
        if ($request->featured > 0) {
            $fff = new Featured;
            $fff->count = $request->featured;
            $fff->days = 7;
            $fff->save();
            $user->featured()->save($fff);
            $featured[] = $fff;
        }
        if ($request->urgent > 0) {
            $uuu = new Urgent;
            $uuu->count = $request->urgent;
            $uuu->days = 7;
            $uuu->save();
            $user->urgent()->save($uuu);
            $urgent[] = $uuu;
        }
        if ($request->spotlight > 0) {
            $sss = new Spotlight;
            $sss->count = $request->spotlight;
            $sss->days = 7;
            $sss->save();
            $user->spotlight()->save($sss);
            $spotlight[] = $sss;
        }
        if ($request->featured_14 > 0) {
            $fff = new Featured;
            $fff->count = $request->featured_14;
            $fff->days = 14;
            $fff->save();
            $user->featured()->save($fff);
            $featured[] = $fff;
        }
        if ($request->shipping_1 > 0) {
            $fff = new Shipping;
            $fff->count = $request->shipping_1;
            $fff->weight = 2;
            $fff->save();
            $user->shipping()->save($fff);
            $shipping[] = $fff;
        }
        if ($request->shipping_2 > 0) {
            $fff = new Shipping;
            $fff->count = $request->shipping_2;
            $fff->weight = 5;
            $fff->save();
            $user->shipping()->save($fff);
            $shipping[] = $fff;
        }
        if ($request->shipping_3 > 0) {
            $fff = new Shipping;
            $fff->count = $request->shipping_3;
            $fff->weight = 10;
            $fff->save();
            $user->shipping()->save($fff);
            $shipping[] = $fff;
        }
        $user->available -= $subtract;
        $user->balance -= $subtract;
        $user->save();

        return ['success' => true, 'result' => ['msg' => 'The packs successfully added to account'], 'featured' => $featured, 'urgent' => $urgent, 'spotlight' => $spotlight, 'balance' => $user->balance, 'available' => $user->available, 'shipping' => $shipping];
    }

    public function transfer(Request $request)
    {
        $user = Auth::user();
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size' => 2000,
                'query' => [
                    'bool' => [
                        'must' => ['term' => ['phone.keyword' => $user->phone]],
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) {
            $ans = $a['_source'];
            $ans['id'] = $a['_id'];
            return $ans;
        }, $response['hits']['hits']);

        foreach ($products as $product) {

            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $product['id'],
                'body' => [
                    'doc' => [
                        'user_id' => $user->id
                    ]
                ]
            ];

// Update doc at /my_index/my_type/my_id
            $response = $this->client->update($params);

        }
        return ['msg' => 'success'];
    }

    public function bump(Request $request)
    {
        $user = Auth::user();
        $advert = new Advert;

        $advert->save();
        $body = $request->json()->all();

        $featured = (int)$body['featured'];
        $urgent = (int)$body['urgent'];
        $spotlight = (int)$body['spotlight'];
        $canship = (int)$body['canship'];

        if ($featured === 1) {
            if (isset($body['featured_id'])) {
                $vd = Featured::find($body['featured_id']);
                if ($vd === null) {
                    return ['success' => false, 'msg' => 'Not valid featured id'];
                }
                $vd->count--;
                $vd->save();
            } else {
                return ['success' => false, 'msg' => 'No featured id'];
            }
        }

        if ($urgent === 1) {
            if (isset($body['urgent_id'])) {
                $vd = Urgent::find($body['urgent_id']);
                if ($vd === null) {
                    return ['success' => false, 'msg' => 'Not valid urgent id'];
                }
                $vd->count--;
                $vd->save();
            } else {
                return ['success' => false, 'msg' => 'No urgent id '];
            }
        }
        if ($spotlight === 1) {
            if (isset($body['spotlight_id'])) {
                $vd = Spotlight::find($body['spotlight_id']);
                if ($vd === null) {
                    return ['success' => false, 'msg' => 'Not valid spotlight id'];
                }
                $vd->count--;
                $vd->save();

            } else {
                return ['success' => false, 'msg' => 'No spotlight id '];
            }
        }
        if ($canship === 1) {
            if (isset($body['shipping_id'])) {
                $vd = Shipping::find($body['shipping_id']);
                if ($vd === null) {
                    return ['success' => false, 'msg' => 'Not valid shipping id'];
                }
                $vd->count--;
                $vd->save();
                $advert->canship = 1;
                $advert->save();

            } else {
                return ['success' => false, 'msg' => 'No shipping id '];
            }
        }
        unset($body['featured_id']);
        unset($body['urgent_id']);
        unset($body['spotlight_id']);
        unset($body['shipping_id']);
        // unset($body['canship']);
        $body['source_id'] = $advert->id;
        $milliseconds = round(microtime(true) * 1000);
        $body['created_at'] = $milliseconds;
        $body['expires_at'] = $milliseconds + 60 * 24 * 3600 * 1000;
        $body['featured_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
        $body['urgent_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
        $body['spotlight_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;

        $body['username'] = $user->name;
        $body['user_id'] = $user->id;
        $body['phone'] = $user->phone;
        $body['featured_count'] = 0;
        $body['urgent_count'] = 0;
        $body['spotlight_count'] = 0;
        if (!isset($body['meta']['price'])) {
            $body['meta']['price'] = -1;
        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => $body
        ];
        $response = $this->client->index($params);
        $advert->sid = $advert->id;
        $advert->user_id = $user->id;
        $advert->elastic = $response['_id'];
        $advert->save();
        if ($user->offer === 0) {
            \Stripe\Transfer::create(array(
                "amount" => 500,
                "currency" => "gbp",
                "destination" => $user->stripe_account
            ));
            $user->offer = 1;
            $user->save();
        }

        return ['success' => true, 'body' => $body, 'response' => $response];
    }

    public function ccreate(Request $request)
    {
        $body = $request->json()->all();
        $user = User::find($body['user_id']);
        if($user===null){
            $user = new User;
            $user->email='g'.$body['source_id'].'@sumra.net';
            $user->name=$body['username'];
            $user->password= bcrypt('password');
            $user->phone='07777777777';
           // $user->more(['email' => 'g'.$body['source_id'].'@sumra.net', 'name' => $body['username'], 'password' => bcrypt('password'), 'phone' => '07777777777']);
            //  $user->id=(int)$body['user_id'];
            $user->save();
        }

        $category = Category::where('slug', $body['slug'])->first();
        if ($category === null) {
            $category = new Category;
            $category->slug = $body['slug'];
            $category->save();

        }
        $body['category'] = $category->id;
        $advert = Advert::where('sid', '=', (int)$body['source_id'])->first();
        if ($advert !== null) {
            if($advert->user_id!=0&&$advert->user_id<20000)
            {
                foreach ($user->adverts as $advert){
                    $advert->user_id = $advert->user_id;
                    $advert->save();
                }
                //$user->delete();

            }

            return ['a' => 'b'];
        }

        $advert = new Advert;
        $advert->sid = (int)$body['source_id'];
        $advert->save();


        $body['user_id']=$user->id;

        $advert->user_id =$user->id;
        $advert->save();
        $location = $body['location'];
        $parts = explode(',', $location);
        $lat = (float)$parts[0];
        $lng = (float)$parts[1];
        $loc = Location::where('min_lat','<=',$lat)->where('max_lat','>=',$lat)->where('min_lng','<=',$lng)->where('max_lng','>=',$lng)->orderBy('product')->first();
        $body['location_id']=$loc->res;
        $body['views']=0;
        $body['list_views']=0;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => $body
        ];
        try{
            $response = $this->client->index($params);
            $advert->elastic = $response['_id'];
            $advert->category_id=$category->id;
            $advert->save();
            return ['response' => $response,'user'=>$user];
        }catch (\Exception $e){
            return $e;
        }

    }

    public function register(Request $request)
    {
        if (!$request->has('email'))
            return ['msg' => "Email can't be blank"];
        if (!$request->has('password'))
            return ['msg' => "Password can't be blank"];
        if (!$request->has('name'))
            return ['msg' => "Name can't be blank"];
        if (preg_match('/\s/', $request->name) === 0)
            return ['msg' => 'Should have full name'];
        if (!$request->has('phone'))
            return ['msg' => "Phone can't be blank"];
        $user = User::where('email', $request->email)->first();
        if ($user !== null) {
            return ['msg' => 'Email is already registered'];
        }
        $user = new User;


        $user->more(['email' => $request->email, 'name' => $request->name, 'password' => bcrypt($request->password), 'phone' => $request->phone]);
        $user->save();
        $acc = new AccountCreated();
        $verify = new EmailCode;
        $verify->user_id = $user->id;
        $verify->code=uniqid();
        $verify->save();
        $acc->verify_code=$verify->code;
        Mail::to($user)->send($acc);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fire.sumra.net/updatetitle");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['id' => $user->id, 'title' => $user->name, "image" => ""]));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);
        curl_close($ch);
        /*
        $names = explode(' ', $user->name);
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->first_name = $names[0];
        $account->legal_entity->last_name = $names[1];
        $account->legal_entity->type = 'individual';
        $account->save();
        */


        //Creating a token without scopes...
        $token = $user->createToken('Token Name')->accessToken;

        return ['msg' => 'success', 'token' => $token, 'id' => $user->id, 'email' => $user->email, 'name' => $user->name];
    }

}