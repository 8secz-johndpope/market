<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 11:12
 */

namespace App\Http\Controllers;

use App\Model\Address;
use App\Model\Advert;
use App\Model\Category;
use App\Model\Featured;
use App\Model\Order;

use App\Model\Price;
use App\Model\Spotlight;
use App\Model\Transaction;
use App\Model\Urgent;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Mockery\Exception;

class UserController extends BaseController
{
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user =  Auth::user();
            //Creating a token without scopes...
            $token = $user->createToken('Token Name')->accessToken;
            return ['token'=>$token,'id'=>$user->id,'email'=>$user->email,'name'=>$user->name];
        }else{
            return ['msg'=>"Invalid Credentials"];
        }
    }
    public function profile()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

// Get the currently authenticated user's ID...
        //$id = Auth::id();
        return ["name"=>$user->name,'featured'=>$user->featured,'urgent'=>$user->urgent,'spotlight'=>$user->spotlight,'balance'=>$user->balance,'available'=>$user->available];
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
        $price = Price::find(1);
        $featured = $request->featured;
        $urgent = $request->urgent;
        $spotlight = $request->spotlight;
        $featured_14 = $request->featured_14;
        $shipping_1 = $request->shipping_1;
        $shipping_2 = $request->shipping_2;
        $shipping_3 = $request->shipping_3;
        return ['price'=>(int)(0.8*($featured*$price->featured+$urgent*$price->urgent+$spotlight*$price->spotlight+$featured_14*$price->featured_14+$shipping_1*$price->shipping_1+$shipping_2*$price->shipping_2+$shipping_3*$price->shipping_3))];
    }
    public function token(Request $request){
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        $clientToken = $gateway->clientToken()->generate();
        return ['token'=>$clientToken];
    }
    public function  stripe(Request $request){
       $token =  \Stripe\Token::create(array(
            "card" => array(
                "number" => "4242424242424242",
                "exp_month" => 8,
                "exp_year" => 2018,
                "cvc" => "314"
            )
        ));
       return $token;
    }
    public function nonce(Request $request){
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        try{
            $result = $gateway->transaction()->sale([
                "amount" => $request->amount,
                'paymentMethodNonce' => $request->payment_method_nonce,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            $transaction = new Transaction;
            $transaction->slug = uniqid();
            $transaction->amount=$request->amount*100;
            $transaction->save();
            return ['status'=>'success','result'=>$result,'transaction_id'=>$transaction->slug];

        }catch (Exception $e){

            return ['result'=>['msg'=>'failed']];
        }

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
                'result' => ['msg'=>'no such token']
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
            $transaction = new Transaction;
            $transaction->slug = uniqid();
            $transaction->amount=$amount;
            $transaction->save();
            return ['status'=>'success','result'=>$charge,'transaction_id'=>$transaction->slug];

        }catch (\Exception $e) {
            return [
                'success' => false,
                'result' => 'error charging the card'
            ];
        }


    }
    public function dob(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->dob->day = $request->day;
        $account->legal_entity->dob->month = $request->month;
        $account->legal_entity->dob->year= $request->year;
        $account->save();
        return ['status'=>'success'];
    }
    public function identity(Request $request)
    {
        $user = Auth::user();

        $filename=$request->name;
        copy('https://s3.eu-central-1.amazonaws.com/chat.sumra.net/'.$filename, '/tmp/'.$filename);
        $fp = fopen('/tmp/'.$filename, 'r');
        $result=\Stripe\FileUpload::create(array(
            'purpose' => 'identity_document',
            'file' => $fp
        ));
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->verification->document = $result->id;
        $account->save();
        return ['status'=>'success'];
    }

    public function add_address(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->address->line1 = $request->line1;
        $account->legal_entity->address->city = $request->city;
        $account->legal_entity->address->postal_code= $request->postcode;
        $account->save();
        $address = new Address;
        $address->line1 = $request->line1;
        $address->city=$request->city;
        $address->postcode = $request->postcode;
        $address->code = rand(1000, 9999);
        $address->save();
        $user->addresses()->save($address);
        return ['status'=>'success'];
    }
    public function addresses(Request $request)
    {
        $user = Auth::user();

        return $user->addresses;
    }
    public function verify_address(Request $request,$id){
        $address = Address::find($id);
        if($address->code===$request->code){
            $address->verified=1;
            $address->save();
            return ['status'=>'success'];
        }else{
            return ['status'=>'failed'];
        }

    }
    public function account(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $data['object']='bank_account';
        $data['account_number']= $request->number;
        $data['country']= 'gb';
        $data['currency']= 'gbp';
        $data['routing_number'] = $request->sortcode;
        $account->external_accounts->create(array("external_account" => $data));
        return ['status'=>'success'];
    }
    public function terms(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->tos_acceptance->date = $request->date;
        $account->tos_acceptance->ip = $request->ip;
        $account->save();
        return ['status'=>'success'];
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
        $stripe_id=$user->stripe_id;
        $cards=\Stripe\Customer::retrieve($stripe_id)->sources->all(array(
            'limit'=>10, 'object' => 'card'));
        return ['account'=>$account,'balance'=>$user->balance,'available'=>$user->available,'cards'=>$cards];
    }

    public function withdraw(Request $request)
    {
        $user = Auth::user();
        $bank = $request->bank;
        $amount  = $request->amount*100;
        \Stripe\Transfer::create(array(
            "amount" => $amount,
            "currency" => "gbp",
            "destination" => $user->stripe_account
        ));
        \Stripe\Stripe::setApiKey($user->sk_key);
        try{
            \Stripe\Payout::create(array(
                "amount" => $amount,
                "currency" => "gbp",
                "destination" => $bank
            ));
            $user->balance -= $amount;
            $user->available -= $amount;
            $user->save();
        }
        catch (\Exception $e) {
            return [
                'success' => false,
                'result' => 'error withdrawing'
            ];
        }

        return ['status'=>'success'];
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
                ],
                "sort" => [
                    [
                        "created_at" => ["order" => "desc"]
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
        if($user->offer===0){
            $user->balance += 500;
            $user->available += 500;
            $user->offer=1;
            $user->save();
        }

        return ['body'=>$body,'response'=>$response];
    }

    public function order(Request $request)
    {
        $user = Auth::user();
        $advert  = Advert::find($request->id);

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic
        ];

        $response = $this->client->get($params);


        $stripe_id=$user->stripe_id;
        $card = $request->card;
        try{
            $charge=\Stripe\Charge::create(array(
                "amount" => (int)$response['_source']['meta']['price'],
                "currency" => "gbp",
                "customer" => $stripe_id,
                "source" => $card, // obtained with Stripe.js
                "description" => 'Buy Advert/'
            ));


        }catch (\Exception $e) {
            return [
                'success' => false,
                'result' => 'error charging the card'
            ];
        }


        $order = new Order;
        $order->advert_id = $response['_source']['source_id'];
        $order->save();
        return ['success'=>true,'result'=>$charge];
    }

    public function topup(Request $request)
    {
        $user = Auth::user();

        $transaction = Transaction::where('slug',$request->transaction_id)->first();
        if($transaction===null||$transaction->used===1){
            return ['result'=>['msg'=>'Not a valid transaction id']];
        }

            $total =  $transaction->amount;
            $transaction->used=1;
            $transaction->save();
            $user->available += $total;
            $user->balance += $total;
            $user->save();

        return ['success'=>true,'result'=>['msg'=>'The amount is added to account']];
    }
    public function buy(Request $request){
        $user = Auth::user();
        $price = Price::find(1);
        $body=$request->json()->all();
        $featured = (int)$body['featured'];
        $urgent = (int)$body['urgent'];
        $spotlight = (int)$body['spotlight'];
        $balance = (int)$body['balance'];
        $total = $price->featured * $featured + $price->urgent * $urgent  + $price->spotlight* $spotlight;
        $subtract=0;
        if($balance===1){

            if($total>$user->available){
                $total -= $user->available;
                $subtract = $user->available;
            }else{
                $total = 0;
                $subtract = $total;
            }

        }
        if($total===0) {
            if($featured>0){
                $fff = new Featured;
                $fff->count = $featured;
                $fff->save();
                $user->featured()->save($fff);
            }
            if($urgent>0){
                $uuu = new Urgent;
                $uuu->count = $urgent;
                $uuu->save();
                $user->urgent()->save($uuu);
            }
            if($spotlight>0){
                $sss = new Spotlight;
                $sss->count = $spotlight;
                $sss->save();
                $user->spotlight()->save($sss);
            }

            $user->available -= $subtract;
            $user->balance -= $subtract;
            $user->save();
            return ['success'=>true];
        }

        $transaction = Transaction::where('slug',$request->transaction_id)->first();
        if($transaction===null||$transaction->used===1){
            return ['result'=>['msg'=>'Not a valid transaction id']];
        }
        if($transaction->amount!=$total){
            return ['result'=>['msg'=>'Not enough amount in the transaction']];
        }
            if($featured>0){
                $fff = new Featured;
                $fff->count = $featured;
                $fff->save();
                $user->featured()->save($fff);
            }
            if($urgent>0){
                $uuu = new Urgent;
                $uuu->count = $urgent;
                $uuu->save();
                $user->urgent()->save($uuu);
            }
           if($spotlight>0){
               $sss = new Spotlight;
               $sss->count = $spotlight;
               $sss-save();
               $user->spotlight()->save($sss);
           }



            $user->available -= $subtract;
            $user->balance -= $subtract;
            $user->save();

        return ['success'=>true,'result'=>['msg'=>'The packs successfully added to account']];
    }
    public function transfer(Request $request){
        $user = Auth::user();
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>2000,
                'query' => [
                    'bool' => [
                        'must'=>['term'=>['phone.keyword'=>$user->phone]],
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) {
            $ans = $a['_source'];
            $ans['id'] = $a['_id'];
            return $ans;
        },$response['hits']['hits']);

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
        return ['msg'=>'success'];
    }
    public function bump(Request $request){
        $user = Auth::user();
        $advert =  new Advert;
        $advert->save();
        $body=$request->json()->all();
        $payment = $body['payment'];
        $featured = (int)$body['featured'];
        $urgent = (int)$body['urgent'];
        $spotlight = (int)$body['spotlight'];
        $total = 0;
        if($featured>0){
            $total += 3399;
        }
        if($urgent>0){
            $total += 2399;
        }
        if($spotlight>0){
            $total += 4499;
        }

        if($payment==='p'||$payment==='pb'||$payment==='pc'||$payment==='pbc'){
            if($featured>0&&$user->featured>0){
                $total-=3399;
            }
            if($urgent>0&&$user->urgent>0){
                $total-=2399;
            }
            if($spotlight>0&&$user->spotlight>0){
                $total-=4499;
            }
        }
        if($payment==='b'||$payment==='pb'||$payment==='pbc'){
            $subtract = 0;
            if($user->available>$total){
                $total=0;
                $subtract = $total;
            }else{
                $total-=$user->available;
                $subtract = $user->available;
            }
        }
        if($total>0){
            if (!$request->has('transaction_id')) {
                return ['msg'=>'Not enough balance or packs to make this operation'];
            }
            $transaction = Transaction::where('slug',$request->transaction_id)->first();
            if($transaction===null){
                return ['msg'=>'Invalid transaction id'];
            }


        }
        if($featured>0&&$user->featured>0){
            $user->featured -= 1;
        }
        if($urgent>0&&$user->urgent>0){
            $user->urgent -= 1;
        }
        if($spotlight>0&&$user->spotlight>0){
            $user->spotlight -= 1;
        }
        $user->available -= $subtract;

        $user->save();
        unset($body['card']);
        unset($body['payment']);

        $body['source_id']=$advert->id;
        $milliseconds = round(microtime(true) * 1000);
        $body['created_at']=$milliseconds;
        $body['expires_at']=$milliseconds+7*24*3600*1000;
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
        if($user->offer===0){
            \Stripe\Transfer::create(array(
                "amount" => 500,
                "currency" => "gbp",
                "destination" => $user->stripe_account
            ));
            $user->offer=1;
            $user->save();
        }

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
        if(preg_match('/\s/',$request->name)===0)
            return ['msg'=>'Should have full name'];
        if(!$request->has('phone'))
            return ['msg'=>"Phone can't be blank"];
        $user = User::where('email',$request->email)->first();
        if($user!==null){
            return ['msg'=>'Email is already registered'];
        }
        $user = new User;
        $user->more(['email'=>$request->email,'name'=>$request->name,'password'=> bcrypt($request->password),'phone'=>$request->phone]);
        $user->save();
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,"https://fire.sumra.net/updatetitle");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode(['id'=>$user->id,'title'=>$user->name,"image"=>""]));
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $names=explode(' ',$user->name);
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->first_name = $names[0];
        $account->legal_entity->last_name = $names[1];
        $account->legal_entity->type = 'individual';
        $account->save();

        return ['msg'=>'success','id'=>$user->id,'email'=>$user->email,'name'=>$user->name];
    }

}