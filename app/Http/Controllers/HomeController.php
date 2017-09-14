<?php

namespace App\Http\Controllers;

use App\Model\EmailCode;
use App\Model\ExtraType;
use App\Model\Location;
use App\Model\Order;
use App\Model\OrderItem;
use App\Model\Price;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Advert;
use Illuminate\Support\Facades\Auth;

class HomeController extends BaseController
{
    const MAX_CHILDREN = 10;

    protected $layout = 'layouts.home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return redirect('/');

        //$base = Category::where('parent_id',0)->get();
        //Need  chande de response is not search client
        $base=Category::where('parent_id',0)->get();
        $j = 0;
        $all=array();
        foreach ($base as $cat) {
            $cat->class = "category-$j";
            $cat->children= $cat->mchildren;
            $all[]=$cat;
            $j++;
        }
        //Need chande de response is not search client
        $min = 0;
        $max = 999999999;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => 0,
                'size'=> 24,
                'query' => [
                    'range' => [
                        'category' => [
                            'gte'=>$min,
                            'lte'=>$max
                        ]
                    ]
                ],
                "sort"=> [
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]
                ]

            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $spl1 = array_slice($products, 0, 6);
        $spl2 = array_slice($products, 6, 6);
        $spl3 = array_slice($products, 12, 6);
        $spl4 = array_slice($products, 18, 6);
        return view('home',['base' => $all, 'spotlight' => $products]);
    }
    public function verify(Request $request){
        $user = Auth::user();
        $email_code = EmailCode::where('code',$request->code)->first();
        if($email_code!==null){
            if($user->id===$email_code->user->id){
                $user->email_verified=1;
                $user->save();
                return view('home.verified',['msg'=>'Your email is successfully verified']);
            }
        }
        return view('home.verified',['msg'=>'Oops! Something went wrong here']);
    }
    public function post(Request $request)
    {
        $user = Auth::user();
        $categories = Category::where('parent_id',0)->get();

        return view('home.post',['categories'=>$categories,'urgent'=>$user,'featured'=>$user->featured,'spotlight'=>$user->spotlight,'shipping',$user->shipping]);
    }
    public  function delete(Request $request,$id)
    {
        $user = Auth::user();
        $advert = Advert::find($id);

        if ($advert === null) {
            $advert = Advert::where('sid', $id)->first();
        }
        if ($advert === null) {
            return redirect('/user/manage/ads');
            //return ['code' => 1, 'msg' => 'Advert not found'];
        }
        if ($advert->user_id != $user->id) {

            return redirect('/user/manage/ads');
           // return ['code' => 2, 'msg' => 'Advert does not belong to you'];
        }

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic
        ];

// Update doc at /my_index/my_type/my_id
        $response = $this->client->delete($params);
        $advert->delete();
        return redirect('/user/manage/ads');
    }
        public  function newad(Request $request){

        $user= Auth::user();
        $category=Category::find($request->category);
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
        $body['location_name']=$request->location_name;
        $body['location']='52.2,0.12';
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
        $advert->elastic = $response['_id'];
        $advert->user_id=$user->id;
        $advert->save();
        $total = (int)$request->total;
        if($total>0){
           // $orders = array();
            $order= new Order;
            $order->amount = $total;
            $order->advert_id=$advert->id;
            $order->save();

            if($request->has('featured')){
                $orderitem = new OrderItem;
                $orderitem->title = 'Featured';
                $orderitem->slug = 'featured';
                $orderitem->amount = $request->get('featured-price');
                $orderitem->save();
                $order->items()->save($orderitem);
               // $orders[] = ['title'=>'Featured','price'=>$request->get('featured-price')];
            }
            if($request->has('urgent')){
                $orderitem = new OrderItem;
                $orderitem->title = 'Urgent';
                $orderitem->slug = 'urgent';
                $orderitem->amount = $request->get('urgent-price');
                $orderitem->save();
                $order->items()->save($orderitem);
              //  $orders[] = ['title'=>'Urgent','price'=>$request->get('urgent-price')];
            }
            if($request->has('spotlight')){
                $orderitem = new OrderItem;
                $orderitem->title = 'Spotlight';
                $orderitem->slug = 'spotlight';
                $orderitem->amount = $request->get('spotlight-price');
                $orderitem->save();
                $order->items()->save($orderitem);
               // $orders[] = ['title'=>'Spotlight','price'=>$request->get('spotlight-price')];
            }
            if($request->has('shipping')){
                $orderitem = new OrderItem;
                $orderitem->title = 'Shipping';
                $orderitem->slug = 'shipping';
                $orderitem->amount = $request->get('shipping-price');
                $orderitem->save();
                $order->items()->save($orderitem);
              //  $orders[] = ['title'=>'Shipping','price'=>$request->get('shipping-price')];
            }

            $request->session()->put('order_id', $order->id);
            return redirect('/user/manage/order');

        }else{
            return redirect('/user/manage/ads');

        }
      //  return ['response' => $response];
      //  return $request->all();
      //  $categories = Category::where('parent_id',0)->get();

     //   return view('home.myadverts');
    }
    public function order(Request $request){
        $user = Auth::user();
        /*
        $balance = \Stripe\Balance::retrieve(
            array("stripe_account" => $user->stripe_account)
        );
        */
        $stripe_id = $user->stripe_id;
        $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
            'limit' => 10, 'object' => 'card'));
        $customer = \Stripe\Customer::retrieve($stripe_id);
        $card = $customer->sources->retrieve($customer->default_source);
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        $clientToken = $gateway->clientToken()->generate();
        $order_id  = $request->session()->get('order_id');

        return view('home.payment',['order'=>Order::find($order_id),'cards'=>$cards['data'],'token' => $clientToken,'def'=>$card]);
    }
    public function shipping(Request $request,$id){
        $user = Auth::user();
        /*
        $balance = \Stripe\Balance::retrieve(
            array("stripe_account" => $user->stripe_account)
        );
        */
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        $clientToken = $gateway->clientToken()->generate();
        $stripe_id = $user->stripe_id;
        $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
            'limit' => 10, 'object' => 'card'));
        $customer = \Stripe\Customer::retrieve($stripe_id);
        $card = $customer->sources->retrieve($customer->default_source);

       // $order_id  = $request->session()->get('order_id');
        $advert = Advert::find($id);

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic
        ];
        $response = $this->client->get($params);

        $request->session()->put('id', $response['_source']['source_id']);

        return view('home.shipping',['addresses'=>$user->addresses,'user'=>$user,'cards'=>$cards['data'],'token' => $clientToken,'def'=>$card,'product'=>$response['_source'],'order'=>Order::find(15)]);
    }
    public function favorites(Request $request){
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
        return view('home.favorites',[ 'products' => $adverts]);

    }
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
        $products = array_map(function ($a) {
            return $a['_source'];
        }, $response['hits']['hits']);

        return view('home.myadverts',['total' => $response['hits']['total'], 'products' => $products]);
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

        return view('home.suggest',['categories'=>$categories]);
    }
    public function string(Request $request,$id)
    {
        $category = Category::find($id);
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
        return $category->parentstring.' > <span class="select-category">'.$category->title.'</span>';
    }
    public function lstring(Request $request,$id)
    {
        $category = Location::find($id);
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
        return $category->parentstring.' > <span class="select-category">'.$category->title.'</span>';
    }
    public function children(Request $request,$id)
    {
        $category = Category::find($id);
        return view('home.categorylist',['categories'=>$category->children]);
    }
    public function lchildren(Request $request,$id)
    {
        $location = Location::find($id);
        return view('home.locationlist',['categories'=>$location->children]);
    }
    public  function extras(Request $request,$id){
        $category = Category::find($id);
        if($category===null){
            return ['msg'=>'Catagory not found'];
        }
        $fields = $category->fields;
        $hasprice = false;
        foreach ($fields as $field){
            if($field->slug==='price'){
                $hasprice=true;
            }
            if($field->type==='list'){
                $field->values = $field->values;
            }
        }
        return view('home.extras',['fields'=>$fields,'hasprice'=>$hasprice]);
    }
    public  function prices(Request $request,$id){
        $category = Category::find($id);
        $forsale = Category::find(200000000);
        if($category===null){
            return ['msg'=>'Catagory not found'];
        }
        if($id>=$forsale->id&&$id<=$forsale->ends)
        $extras = ExtraType::all();
        else{
            $extras = ExtraType::where('id','<',4)->get();
        }
        foreach ($extras as $extra){
            if($extra->type==='single'){
                $extra->price = $extra->price($id,$request->lat,$request->lng);
            }else{
                $extra->prices = $extra->prices($id,$request->lat,$request->lng);
            }
        }
      //  return $extras;
        return view('home.prices',['prices'=>[],'extras'=>$extras]);
    }
    public  function price(Request $request,$id){
        $category = Category::find($id);
        return 80;
        if($category===null){
            return ['msg'=>'Catagory not found'];
        }
        $extras = ExtraType::all();
        foreach ($extras as $extra){
            if($extra->type==='single'){
                $extra->price = $extra->price(0,1,2);
            }else{
                $extra->prices = $extra->prices(0,1,2);
            }
        }
        return view('home.prices',['prices'=>[],'extras'=>$extras]);
    }
    public function baseAndFirstChildren(){
        $base = Category::where('parent_id',0)->get();
        $j = 0;
        foreach ($base as $cat) {
            $cat->class = "category-$j";
            $cat->children= $base->children()->limit(self::MAX_CHILDREN);
            $j++;
        }
        return $base;
    }
    public function  addcard(Request $request){
        $user = Auth::user();

        $stripe_id = $user->stripe_id;
        $customer = \Stripe\Customer::retrieve($stripe_id);
        $customer->sources->create(array("source" => $request->stripeToken));
        return redirect('/user/manage/order');
    }
    public function stripe(Request $request){
        $user = Auth::user();
        $stripe_id = $user->stripe_id;
        $card = $request->card;
        if ($request->session()->has('id')) {
            //
            $id  = $request->session()->get('id');
            $advert = Advert::find($id);

            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $advert->elastic
            ];
            $response = $this->client->get($params);
            $amount = (int)($response['_source']['meta']['price']);
            try {
                $charge = \Stripe\Charge::create(array(
                    "amount" => $amount,
                    "currency" => "gbp",
                    "customer" => $stripe_id,
                    "source" => $card, // obtained with Stripe.js
                    "description" => 'Shipping Item '
                ));
                $request->session()->forget('id');
                $order = new Order;
                $order->advert_id = $advert->id;
                $order->buyer_id = $user->id;
                $order->seller_id = $advert->user_id;
                $order->amount = $amount;
                $order->address_id = $user->default_address;
                $order->type='shipping';
                $order->save();

            }
            catch (\Exception $e) {
            }
            return redirect('/user/manage/ads');
        }

        $order_id  = $request->session()->get('order_id');
        $order = Order::find($order_id);

        $amount = (int)($order->amount * 100);
        $description = 'Payment towards to Order id '.$order_id;
       try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $amount,
                "currency" => "gbp",
                "customer" => $stripe_id,
                "source" => $card, // obtained with Stripe.js
                "description" => $description
            ));
            $advert = Advert::find($order->advert_id);
            foreach ($order->items as $item){
                $body[$item->slug]=1;
            }
           $body['featured_count'] = 0;
           $body['urgent_count'] = 0;
           $body['spotlight_count'] = 0;
           $milliseconds = round(microtime(true) * 1000);

           $body['featured_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
           $body['urgent_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
           $body['spotlight_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
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
           $request->session()->forget('order_id');

           return redirect('/user/manage/ads');

        }
        catch (\Exception $e) {
            return [
                'status' => 'failed',
                'error' => $e,
                'result' => ['msg' => 'error charging the card']
            ];
        }

    }
    public function orders(Request $request){
        $user = Auth::user();
        $orders = $user->orders;
        foreach ($orders as $order){
            $advert = Advert::find($order->advert_id);
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $advert->elastic
            ];
            $response = $this->client->get($params);
            $order->product = $response['_source'];
            $products[]=$order;
        }
        return view('home.orders',['orders'=>$products]);
    }
    public function buying(Request $request){
        $user = Auth::user();
        $orders = $user->buying;
        foreach ($orders as $order){
            $advert = Advert::find($order->advert_id);
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $advert->elastic
            ];
            $response = $this->client->get($params);
            $order->product = $response['_source'];
            $products[]=$order;
        }
        return view('home.buying',['orders'=>$products]);
    }
    public function messages(Request $request){

        return view('home.messages',[]);
    }
    public function details(Request $request){

        return view('home.details',['user'=>Auth::user()]);
    }
    public function paypal(Request $request){
        $user = Auth::user();
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        if ($request->session()->has('id')) {
            $id  = $request->session()->get('id');
            $advert = Advert::find($id);

            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $advert->elastic
            ];
            $response = $this->client->get($params);
            $amount = ($response['_source']['meta']['price']/100);
            try{
                $result = $gateway->transaction()->sale([
                    "amount" => $amount,
                    'paymentMethodNonce' => $request->nonce,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);
                $request->session()->forget('id');
                $order = new Order;
                $order->advert_id = $advert->id;
                $order->buyer_id = $user->id;
                $order->seller_id = $advert->user_id;
                $order->amount = $amount*100;
                $order->address_id = $user->default_address;
                $order->type='shipping';
                $order->save();

            }
            catch (Exception $e) {

            }

        }
        $order_id  = $request->session()->get('order_id');
        $order = Order::find($order_id);

        $amount = $order->amount;

        try {
            $result = $gateway->transaction()->sale([
                "amount" => $amount,
                'paymentMethodNonce' => $request->nonce,
                'options' => [
                    'submitForSettlement' => True
                ]
            ]);
            $advert = Advert::find($order->advert_id);
            foreach ($order->items as $item){
                $body[$item->slug]=1;
            }
            $body['featured_count'] = 0;
            $body['urgent_count'] = 0;
            $body['spotlight_count'] = 0;
            $milliseconds = round(microtime(true) * 1000);

            $body['featured_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
            $body['urgent_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
            $body['spotlight_expires'] = $milliseconds + 7 * 24 * 3600 * 1000;
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
            $request->session()->forget('order_id');

            return redirect('/user/manage/ads');

        } catch (Exception $e) {

            return ['result' => ['msg' => 'failed']];
        }
    }
    public  function  change(Request $request,$id){
        $user = Auth::user();
        $user->default_address = $id;
        $user->save();

        return ['msg'=>'Done'];
    }
    public function update_shipping(Request $request,$id){
        $order = Order::find($id);
        $order->tracking = $request->tracking;
        $order->save();

        return ['msg'=>'Done'];

    }
    public function packs(Request $request){
        $prices = Price::all();
        return view('home.packs',['prices'=>$prices]);
    }
    public function pricegroup(Request $request){
        $prices = Price::all();
        $categories = Category::where('parent_id',0)->get();
        $locations = Location::where('parent_id',0)->get();

        return view('home.pricegroup',['prices'=>$prices,'categories'=>$categories,'locations'=>$locations]);
    }
    public function add_pricegroup(Request $request){
        $price = new Price;
        $price->category_id = $request->category;
        $price->location_id = $request->location;
        $price->standard = $request->standard*100;
        $price->spotlight = $request->spotlight*100;
        $price->urgent = $request->urgent*100;
        $price->featured = $request->featured*100;
        $price->featured_3 = $request->featured_3*100;
        $price->featured_14 = $request->featured_14*100;
        $price->bump = $request->bump*100;
        $price->save();
        return ['msg'=>'done'];

    }
}
