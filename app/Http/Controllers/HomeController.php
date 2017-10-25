<?php

namespace App\Http\Controllers;
use App\Mail\AccountCreated;
use App\Model\Address;
use App\Model\Application;
use App\Model\Business;
use App\Model\Cover;
use App\Model\Cv;
use App\Model\Dispatch;
use App\Model\Distance;
use App\Model\Pack;
use App\Model\Payment;
use App\Model\Postcode;
use App\Model\Room;
use App\Model\SearchAlert;
use App\Model\Shipping;
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
use Cassandra;
use Ramsey\Uuid\Uuid;
use Twilio\Rest\Client;
use GuzzleHttp\Client as GClient;

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
        return view('home',['base' => $all, 'spotlight' => $products,'category'=>Category::find(0)]);
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
        $categories = Category::where('parent_id', 0)->get();

        return view('home.post', ['categories' => $categories, 'user' => $user, 'extras' => false, 'fields' => false, 'hasprice' => false, 'category' => false, 'location' => false, 'message' => false]);

    }
    public function create(Request $request){
        $advert=new Advert;
        $advert->save();
        $advert->create_draft();

        return redirect('/user/manage/ad/'.$advert->id);
    }
    public function change_category(Request $request){
        $advert = Advert::find($request->id);
     //   return $advert;
        $advert->update_fields(['category'=>(int)$request->category]);

        $advert->category_id=$request->category;
        $advert->save();
        return redirect('/user/manage/ad/'.$advert->id);
    }
    public function change_location(Request $request){
        $advert = Advert::find($request->id);
        $up =   str_replace(' ','',strtoupper($request->postcode));
        $a = Postcode::where('hash',crc32($up))->first();
        if($a===null){
            $advert->postcode_id=-1;
            $advert->save();
        }else{
            $advert->postcode_id=$a->id;
            $advert->update_fields(['location_id'=>$a->location->res,'location_name'=>$a->location->title,'location'=>$a->lat.','.$a->lng]);
            $advert->save();
        }

        return redirect('/user/manage/ad/'.$advert->id);
    }
    public function manage(Request $request,$id){
        $advert = Advert::find($id);
        $categories = Category::where('parent_id', 0)->get();
        if($advert->has_param('shipping')){
            $shipping=Shipping::find($advert->param('shipping'));
        }else{
            $shipping=Shipping::find(1);
        }

        return view('home.ad',['advert'=>$advert,'categories' => $categories,'shipping'=>$shipping,'economies'=>Shipping::where('type',0)->get(),'standards'=>Shipping::where('type',1)->get(),'expresses'=>Shipping::where('type',2)->get(),'distances'=>Distance::all(),'dispatches'=>Dispatch::all()]);
    }
    public function edit(Request $request,$id)
    {
        $advert=Advert::find($id);
        $user = Auth::user();

        return view('home.edit',['advert'=>$advert,'user'=>$user,'shippings'=>Shipping::all()]);
    }
    public function duplicate(Request $request,$id)
    {
        $advert=Advert::find($id);
        $advert->duplicate();
        $user = Auth::user();
        return redirect('/user/manage/ads');
    }
    public function location(Request $request){
        $user = Auth::user();
        $categories = Category::where('parent_id',0)->get();
        $category=Category::find($request->category);
        $up =   str_replace(' ','',strtoupper($request->postcode));
        $a = Postcode::where('hash',crc32($up))->first();
        if($a===null){
            return view('home.post',['categories'=>$categories,'user'=>$user,'extras'=>false,'fields'=>false,'hasprice'=>false,'category'=>$category,'location'=>false,'message'=>'Not a valid postcode']);
        }else{
            $location=$a->location;
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
            $forsale = Category::find(200000000);

            if($category->id>=$forsale->id&&$category->id<=$forsale->ends)
                $extras = ExtraType::all();
            else{
                $extras = ExtraType::where('id','<',4)->get();
            }
            foreach ($extras as $extra){
                if($extra->type==='single'){
                    $extra->price = $extra->price($category->id,$location->id);
                }else{
                    $extra->prices = $extra->prices($category->id,$location->id);
                }
            }
            return view('home.post',['categories'=>$categories,'user'=>$user,'extras'=>$extras,'fields'=>$fields,'hasprice'=>$hasprice,'category'=>$category,'location'=>$a->location,'message'=>false,'postcode'=>$a->postcode]);

        }



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

        $advert->make_inactive();
        return redirect('/user/manage/ads');
    }
    public  function repost(Request $request,$id)
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
        $date = date("Y-m-d H:i:s");
        $advert->modified_at=$date;
        $advert->save();

        $advert->make_active();
        return redirect('/user/manage/ads');
    }
        public  function newad(Request $request){

        $user= Auth::user();
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
        $advert->elastic = $response['_id'];
        $advert->user_id=$user->id;
        $advert->postcode_id=$postcode->id;
        $advert->category_id=$category->id;
        $advert->save();
        //$total = (int)$request->total;
       // if($total>0){
           // $orders = array();
            $extratypes=ExtraType::all();
            $needsorder=false;
            foreach ($extratypes as $type) {
                if ($request->has($type->slug) && $request->get($type->slug) == 1) {
                $needsorder=true;
                }
            }
            if($needsorder) {
                $order = new Order;
                $order->amount = 70;
                $order->type = 'bump';
                $order->buyer_id = $user->id;
                $order->advert_id = $advert->id;
                $order->save();


                foreach ($extratypes as $type) {
                    if ($request->has($type->slug) && $request->get($type->slug) == 1) {
                        $key = $type->slug;
                        if ($type->type === 'list') {
                            $key = $request->get($type->key);
                        }
                        $extraprice = ExtraPrice::where('key', $key)->first();
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
            }else{
                return redirect('/user/manage/ads');
            }

        //}else{
          //  return redirect('/user/manage/ads');

        //}
      //  return ['response' => $response];
      //  return $request->all();
      //  $categories = Category::where('parent_id',0)->get();

     //   return view('home.myadverts');
    }

    public function dvla(Request $request){
        try {


            $client = new GClient;
            $url = 'https://dvlasearch.appspot.com/DvlaSearch?licencePlate='.$request->q.'&apikey=KM7ol0xqsObXb1nl';
            $r = $client->get($url);
            $r = json_decode($r->getBody(), true);
            $all = [];
            $day = $r['dateOfFirstRegistration'];
            $parts = explode(' ', $day);
            $year = (int)$parts[2];
            $size = $r['cylinderCapacity'];
            $parts = explode(' ', $size);
            $engine = (int)$parts[0];
            $all['vehicle_fuel_type'] = strtolower($r['fuelType']);
            $all['vehicle_registration_year'] = $year;
            $all['vehicle_engine_size'] = $engine;
            $all['vehicle_colour'] = strtolower($r['colour']);
            $all['vehicle_transmission'] = strtolower($r['transmission']);

            return $all;
        }catch (\Exception $exception){
            return ['msg'=>'Not valid plate'];
        }


    }
    public  function save(Request $request)
    {

        $user=Auth::user();
        $advert=Advert::find($request->id);
        $body=['title'=>$request->title,'description'=>$request->description];
        $meta=[];
        if($request->has('category')){
            $milliseconds = round(microtime(true) * 1000);
            $body['category']=$advert->category_id;
            $body['location_id']=$advert->postcode->location->res;
            $body['location_name']=$advert->postcode->location->title;
            $body['views']=0;
            $body['list_views']=0;
            $body['created_at']=$milliseconds;

        }
        if($request->has('images')){
            $body['images']=$request->images;

        }else{
            $body['images']=[];
        }
        if($request->has('candeliver'))
        {
            $body['candeliver']=1;
            $meta['distance']=(int)$request->distance;
            $meta['delivery']=(int)($request->delivery*100);
        }else{
            $body['candeliver']=0;
        }

        if($request->has('freeshipping'))
        {
            $body['freeshipping']=1;
            $meta['shipping']=0;
        }else{
            $body['freeshipping']=0;
            $meta['shipping']=(int)($request->buyer_pays*100);
        }

        if($request->has('acceptreturns'))
            $body['acceptreturns']=1;
        else
            $body['acceptreturns']=0;
        if($request->has('canship')){
            $body['canship']=1;
            $meta['dispatch']=(int)$request->dispatch;
            $body['shipping']=(int)$request->shipping;
        }else{
            $body['canship']=0;
        }

        $advert->update_fields($body);

        foreach ($advert->category->fields as $field){
            if($field->slug!=='price'&&$request->has($field->slug)){
                $meta[$field->slug] = $request->get($field->slug);
            }
        }
        if($request->has('price')){
            $meta['price']=$request->price*100;
        }else{
            $meta['price']=-1;
        }
        $advert->update_meta($meta);
        if($request->has('post')){
            $advert->publish();
        }
        if($request->has('post')||$request->has('update')){

            $extratypes=ExtraType::all();
            $needsorder=false;
            foreach ($extratypes as $type) {
                if ($request->has($type->slug) && $request->get($type->slug) == 1) {
                    $needsorder=true;
                }
            }
            if($needsorder) {
                $order = new Order;
                $order->amount = 70;
                $order->type = 'bump';
                $order->buyer_id = $user->id;
                $order->advert_id = $advert->id;
                $order->save();

                foreach ($extratypes as $type) {
                    if ($request->has($type->slug) && $request->get($type->slug) == 1) {
                        $key = $type->slug;
                        if ($type->type === 'list') {
                            $key = $request->get($type->key);
                        }
                        $extraprice = ExtraPrice::where('key', $key)->first();
                        $orderitem = new OrderItem;
                        $orderitem->title = 'Featured';
                        $orderitem->slug = 'featured';
                        $orderitem->advert_id = $advert->id;
                        $orderitem->category_id = $advert->category->id;
                        $orderitem->location_id = $advert->postcode->location->id;
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
        return redirect('/user/manage/ads');
    }
        public function order(Request $request){
        $user = Auth::user();
        /*
        $balance = \Stripe\Balance::retrieve(
            array("stripe_account" => $user->stripe_account)
        );
        */
        $order_id  = $request->session()->get('order_id');

        $stripe_id = $user->stripe_id;
        $customer = \Stripe\Customer::retrieve($stripe_id);

        try{
            $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
                'limit' => 10, 'object' => 'card'));
            $card = $customer->sources->retrieve($customer->default_source);
            $cards = $cards['data'];

        }catch (\Exception $exception){
            $cards = [];
            $card=null;
        }

        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));
        $clientToken = $gateway->clientToken()->generate();

        return view('home.payment',['order'=>Order::find($order_id),'cards'=>$cards,'token' => $clientToken,'def'=>$card,'user'=>$user]);
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

        return view('home.favorites',[ 'user' => $user]);

    }
    public function alerts(Request $request){
        $user = Auth::user();

        return view('home.alerts',[ 'user' => $user]);

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
        return redirect('/'.$category->slug.'/'.$location->slug);
    }
    public function delete_alert(Request $request,$id){
        $alert=SearchAlert::find($id);
        $alert->delete();

        return redirect('/user/manage/alerts');

    }
    public function delete_address(Request $request,$id){
        $alert=Address::find($id);
        $alert->delete();

        return redirect('/user/manage/details');

    }
    public function delete_cv(Request $request,$id){
        $alert=Cv::find($id);
        $alert->delete();

        return redirect('/user/manage/details');

    }
    public function delete_cover(Request $request,$id){
        $alert=Cover::find($id);
        $alert->delete();

        return redirect('/user/manage/details');

    }
    public function primary_address(Request $request,$id){
        $user = Auth::user();

        $adddress=Address::find($id);
        $user->default_address=$adddress->id;
        $user->save();

        return redirect('/user/manage/details');

    }
    public function toggle_alert(Request $request,$id){
        $alert=SearchAlert::find($id);
        $alert->active=!$alert->active;
        $alert->save();
        return ['msg'=>'done'];

    }
    public function myads(Request $request){
        $user = Auth::user();
        if($user->contract!==null)
        {
            return redirect('/business/manage/ads');
        }


        return view('home.myadverts',['total' => count($user->adverts), 'user' => $user]);
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
                $extra->price = $extra->price($id,$request->id);
            }else{
                $extra->prices = $extra->prices($id,$request->id);
            }
        }
      //  return $extras;
        return view('home.prices',['prices'=>[],'extras'=>$extras]);
    }
    public  function price(Request $request,$id){

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
                $extra->price = $extra->price($id,$request->id);
            }else{
                $extra->prices = $extra->prices($id,$request->id);
            }
        }

        return $extras;

    }
    public function total(Request $request,$id){
        $extratypes = ExtraType::all();
        $price = Price::price($id,$request->id);
        $total = 0;
        foreach ($extratypes as $type){
            if($request->has($type->slug)&&$request->get($type->slug)==1){
                $key = $type->slug;
                if($type->type==='list'){
                    $key = $request->get($type->key);
                }
                if(Pack::has_packs($key,$id,$request->id)) {

                }else{
                    $total += $price->{$key};
                }
            }

        }
        return ['total'=>$total/100];
    }
    public function ad_total(Request $request){
        $advert=Advert::find($request->id);
        return ['total'=> $advert->total($request->all())];
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
        $parts = explode('/',$request->expiry);
        $month = (int)$parts[0];
        $year = (int)$parts[1];
        $card=str_replace(' ','',trim($request->card));
        $customer->sources->create(array("source" => ['object'=>'card','number'=>$card,'exp_month'=>$month,'exp_year'=>$year,'cvc'=>$request->cvc]));
        $user->vid='V2';
        $user->save();
        return redirect($request->redirect);
    }
    public function add_bank_account(Request $request)
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
        return redirect($request->redirect);
    }
    public function add_cover(Request $request)
    {
        $user = Auth::user();
        $cover = new Cover;
        $cover->title=$request->title;
        $cover->category_id=$request->category;
        $cover->cover=$request->cover;
        $cover->user_id=$user->id;
        $cover->save();
        return redirect($request->redirect);
    }
    public function apply(Request $request)
    {
        
        // Get the currently authenticated user...
        $user = Auth::user();
        $id = $request->id;
        $advert = Advert::find($id);

        $application = new Application;
        $application->advert_id = $advert->id;
        $application->user_id = $user->id;
        $application->cv_id = $request->cv;
        $application->cover_id = $request->cover;
        $application->save();
        return redirect($advert->url());

    }
    public function add_address(Request $request)
    {
        $user = Auth::user();
        $address = new Address;
        $address->line1=$request->line1;
        $address->city=$request->city;
        $address->postcode=$request->postcode;
        $address->user_id=$user->id;
        $address->code=rand(1000,9999);
        $address->save();
        if($user->default_address===0){
            $user->default_address=$address->id;
            $user->save();
        }


        return redirect($request->redirect);
    }
    public function add_cv(Request $request)
    {
        $user = Auth::user();
        $cv = new Cv;
        $cv->title=$request->title;
        $cv->file_name=$request->file_name;
        $cv->category_id=$request->category;
        $cv->user_id=$user->id;
        $cv->save();
        return ['msg'=>'done'];
    }
    public function delete_card(Request $request){
        $user = Auth::user();
        $stripe_id = $user->stripe_id;
        $customer = \Stripe\Customer::retrieve($stripe_id);
        $customer->sources->retrieve($request->card)->delete();
        return redirect($request->redirect);

    }
    public function text(Request $request) {
        $user=Auth::user();

        $code = rand(1000,9999);
        $user->phone_code=$code;
        $user->save();
        if($request->has('testing')){

            return ['code'=>$code];
        }
        $sid = 'AC7237043426f3c67ac884ab4b4b0d3ff3';
        $token = 'cd153bce35fcea43c3dadf1a9373aad7';
        $client = new Client($sid, $token);
// Use the client to do fun stuff like send text messages!
        $client->messages->create(
        // the number you'd like to send the message to
            $user->phone,
            array(
                // A Twilio phone number you purchased at twilio.com/console
                'from' => '+441202286628',
                // the body of the text message you'd like to send
                'body' => 'Sumra: Your verification code is '.$code
            )
        );
        return ['code'=>'sent'];
    }
    public function verify_text(Request $request) {
        $user=Auth::user();
        if($user->phone_code!==(int)$request->code){
            return ['msg'=>'wrong'];
        }else{
            $user->phone_verified=1;
            $user->save();
            return ['msg'=>'correct'];
        }

    }
    public function resend_email(Request $request){
        $user=Auth::user();

        $acc = new AccountCreated;
        $verify = new EmailCode;
        $verify->user_id = $user->id;
        $verify->code=uniqid();
        $verify->save();
        $acc->verify_code=$verify->code;
        Mail::to($user)->send($acc);
        return redirect('/user/manage/details');
    }
    private function complete_contract($order){
        $user=Auth::user();
        $order->payment = 'done';
        $order->save();
        foreach ($order->contract->packs as $pack){
            $cpack = new Pack;
            $cpack->type = $pack->slug;
            $cpack->category_id = $pack->category_id;
            $cpack->location_id = $pack->location_id;
            $cpack->remaining = $order->contract->count;
            $cpack->total = $order->contract->count;
            $cpack->user_id = $user->id;
            $cpack->save();
        }
        foreach ($order->contract->fdays() as $day){
            $payment = new Payment;
            $payment->charge_at = $day;
            $payment->contract_id = $order->contract->id;
            $payment->amount = (int)$order->contract->monthly_payment()*100;
            $payment->reference = strtoupper(uniqid());
            $payment->save();
        }
        if($user->contract!==null){
            $user->contract->status='settled';
            $user->contract->save();
        }
        $order->contract->user_id = $user->id;
        $order->contract->save();
    }

    private function complete_bump($order){

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

    }
    private function complete_invoice($order){
        $order->invoice->status='done';
        $order->invoice->save();
    }

    public function stripe(Request $request){
        $user = Auth::user();
        $stripe_id = $user->stripe_id;
        $card = $request->card;


        $order_id  = $request->session()->get('order_id');
        $order = Order::find($order_id);


        $description = 'Payment towards to Order id '.$order_id;
       try {
           if($order->amount_in_pence()>0){
               $charge = \Stripe\Charge::create(array(
                   "amount" => $order->amount_in_pence(),
                   "currency" => "gbp",
                   "customer" => $stripe_id,
                   "source" => $card, // obtained with Stripe.js
                   "description" => $description
               ), array("stripe_account" => "{$user->stripe_account}"));
           }

            if($order->type==='contract'){
               $this->complete_contract($order);
               // $request->session()->forget('order_id');
                return redirect('/user/contract/sign');
            }
            if($order->type==='bump') {
                $this->complete_bump($order);
                $request->session()->forget('order_id');
                return redirect('/user/manage/ads');
            }
           if($order->type==='invoice') {
               $this->complete_invoice($order);
               $request->session()->forget('order_id');
               return redirect('/business/manage/finance');
           }

        }
        catch (\Exception $e) {
            return [
                'status' => 'failed',
                'error' => $e,
                'result' => ['msg' => 'error charging the card']
            ];
        }

    }
    public function paypal(Request $request){
        $user = Auth::user();
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
        ));

        $order_id  = $request->session()->get('order_id');
        $order = Order::find($order_id);


        try {
            if($order->amount()>0){
                $result = $gateway->transaction()->sale([
                    "amount" => $order->amount(),
                    'paymentMethodNonce' => $request->nonce,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);
            }

            if($order->type==='contract'){
                $this->complete_contract($order);
                // $request->session()->forget('order_id');
                return redirect('/user/contract/sign');
            }
            if($order->type==='bump') {
                $this->complete_bump($order);
                $request->session()->forget('order_id');
                return redirect('/user/manage/ads');
            }
            if($order->type==='invoice') {
                $this->complete_invoice($order);
                $request->session()->forget('order_id');
                return redirect('/business/manage/finance');
            }


        } catch (Exception $e) {

            return ['result' => ['msg' => 'failed']];
        }
    }
    public function orders(Request $request){
        $user = Auth::user();

        return view('home.orders',['user'=>$user]);
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

        return view('business.details',['user'=>Auth::user()]);
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
    private function get_payment_days(){
        for($i=1;$i<12;$i++){
            $days[] = date('d-m-Y',strtotime('+90 days +'.$i.' months'));
        }
        return $days;
    }
    public function sign(Request $request)
    {

/*
        if ($request->session()->has('contract_id')) {
            $id = $request->session()->get('contract_id');
            $contract = Contract::find($id);
            if($contract->total_after_vat()<$contract->minimum_payment()){
                return redirect('/user/contract/start');
            }
        }else{
            return redirect('/user/contract/start');
          //  $contract = new Contract;
          //  $contract->save();
           // $request->session()->put('contract_id',$contract->id);
        }
*/
      //  $packs = $contract->packs;
        if(!$request->session()->has('order_id')){
           // $order = new Order;
         //   $order->type = 'contract';
           // $order->contract_id = $contract->id;
            //$order->save();
            //$request->session()->put('order_id', $order->id);
            return redirect('/user/contract/start');
        }else{
            $order_id =  $request->session()->get("order_id");
            $order = Order::find($order_id);
            $contract = $order->contract;
            if($order->payment==='pending'){
                return redirect('/user/manage/order');
            }
        }
        $request->session()->forget('order_id');
        $days=$this->get_payment_days();
        $pdf = PDF::loadView('pdf.invoice', ['contract'=>$contract,'user'=>Auth::user(),'days'=>$days]);
        $pdf->save('/home/anil/market/storage/contracts/invoice.pdf');
        $client = new \HelloSign\Client('ecd17a4e5e1e6b1d60d17a12711665789956cc4874b608f06f5de462ba26bbc1');
        $request = new \HelloSign\SignatureRequest;
        $request->enableTestMode();
        $request->setSubject('My First embedded signature request with a template');
        $request->setMessage('Awesome, right?');
        $request->addSigner('anil@sumra.net', 'Anil');
        $request->addFile("/home/anil/market/storage/contracts/invoice.pdf");

        $client_id = 'd88c4209bd93093d3815ef0e26069793';
        $embedded_request = new \HelloSign\EmbeddedSignatureRequest($request, $client_id);
        $response = $client->createEmbeddedSignatureRequest($embedded_request);
        $signatures   = $response->getSignatures();
        $signature_id = $signatures[0]->getId();

// Retrieve the URL to sign the document
        $response = $client->getEmbeddedSignUrl($signature_id);

// Store it to use with the embedded.js HelloSign.open() call
        $sign_url = $response->getSignUrl();
        //return $sign_url;
        // $client = new \HelloSign\Client('ecd17a4e5e1e6b1d60d17a12711665789956cc4874b608f06f5de462ba26bbc1');
        //   $response = $client->getEmbeddedSignUrl('559aa46cf6b9ab8bc4599862ee1f5b01');

        return view('pdf.contract',['url'=>$sign_url]);
      //  return view('home.sign');
    }
    public function pack(Request $request,$category,$location){
        $id = $request->session()->get('order_id');
        $order = Order::find($id);
        $contract = $order->contract;
        $price = Price::price($category,$location);
        foreach ($request->types as $type){
            $extraprice = ExtraPrice::where('key',$type)->first();
            $pack = new ContractPack;
            $pack->slug = $type;
            $pack->category_id = $category;
            $pack->location_id = $location;
            $pack->title = $extraprice->stitle;
            $pack->amount = $contract->count*$price->{$type};
            $price->save();
            $contract->packs()->save($pack);
        }
       // return ['location'=>$location,'category'=>$category,'contract'=>$contract,'types'=>$request->types];
        return view('home.packs',['contract'=>$contract]);

    }
    public function packs(Request $request){
        $id = $request->session()->get('contract_id');
        $contract = Contract::find($id);

        // return ['location'=>$location,'category'=>$category,'contract'=>$contract,'types'=>$request->types];
        return view('home.packs',['contract'=>$contract]);

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
    public function business(Request $request,$id)
    {
        $user = Auth::user();

        if ($request->session()->has('order_id')) {

        }else{
            $order = new Order;
            $contract = new Contract;
            $contract->type = $id;
            if((int)$id===2){
                $contract->discount = 35;
                $contract->minimum = 1000000;
            }
            else if((int)$id===3){
                $contract->discount = 45;
                $contract->minimum = 5000000;
            }
            $contract->save();
            $order->contract_id = $contract->id;
            $order->buyer_id = $user->id;
            $order->type='contract';
            $order->save();
            $request->session()->put('order_id',$order->id);

        }
        if($user->business!==null){
            $order_id =  $request->session()->get('order_id');
            $order = Order::find($order_id);
            $contract = $order->contract;
            if((int)$id===1){
                $contract->discount = 25;
                $contract->minimum = 250000;
            }
            else if((int)$id===2){
                $contract->discount = 35;
                $contract->minimum = 1000000;
            }
            else if((int)$id===3){
                $contract->discount = 45;
                $contract->minimum = 5000000;
            }
            $contract->save();
            return redirect('/user/contract/start');
        }
        return view('home.business');
    }
    public function cbusiness(Request $request)
    {
        $user=Auth::user();
        $business = new Business;
        $business->name = $request->name;
        $address = new Address;
        $address->line1=$request->line1;
        $address->city=$request->city;
        $address->postcode=$request->postcode;
        $address->user_id=$user->id;
        $address->code = rand(1000,9999);
        $address->save();
        $business->phone = $request->phone;
        $business->company = $request->company;
        $business->vat = $request->vat;
        $business->user_id = $user->id;
        $business->address_id = $address->id;
        $business->save();
        return ['msg'=>'done'];
    }
    public function contract(Request $request){
        if ($request->session()->has('order_id')) {
            $order_id =  $request->session()->get('order_id');
            $order = Order::find($order_id);
            $contract = $order->contract;
        }else{
            return redirect('/user/contract/pricing');
        }
        $packs = $contract->packs;
        $prices = Price::all();
        $categories = Category::where('parent_id',0)->get();
        $locations = Location::where('parent_id',0)->get();
        return view('home.start',['prices'=>$prices,'categories'=>$categories,'locations'=>$locations,'packs'=>$packs,'contract'=>$contract]);


    }
    public  function delete_pack(Request $request,$id){
        $pack = ContractPack::find($id);
        $pack->delete();

        return redirect('/user/contract/start');
    }
    public function pdf(Request $request){
        $data['name']='Hello';
        $pdf = PDF::loadView('pdf.invoice', $data);
        $pdf->save('/home/anil/market/storage/contracts/invoice.pdf');
        $client = new \HelloSign\Client('ecd17a4e5e1e6b1d60d17a12711665789956cc4874b608f06f5de462ba26bbc1');
        $request = new \HelloSign\SignatureRequest;
        $request->enableTestMode();
        $request->setSubject('My First embedded signature request with a template');
        $request->setMessage('Awesome, right?');
        $request->addSigner('anil@sumra.net', 'Anil');
        $request->addFile("/home/anil/market/storage/contracts/invoice.pdf");

        $client_id = 'd88c4209bd93093d3815ef0e26069793';
        $embedded_request = new \HelloSign\EmbeddedSignatureRequest($request, $client_id);
        $response = $client->createEmbeddedSignatureRequest($embedded_request);
        $signatures   = $response->getSignatures();
        $signature_id = $signatures[0]->getId();

// Retrieve the URL to sign the document
        $response = $client->getEmbeddedSignUrl($signature_id);

// Store it to use with the embedded.js HelloSign.open() call
        $sign_url = $response->getSignUrl();
        //return $sign_url;
       // $client = new \HelloSign\Client('ecd17a4e5e1e6b1d60d17a12711665789956cc4874b608f06f5de462ba26bbc1');
     //   $response = $client->getEmbeddedSignUrl('559aa46cf6b9ab8bc4599862ee1f5b01');
        return view('pdf.contract',['url'=>$sign_url]);
    }

    public function pricing(Request $request){
        return view('home.pricing');
    }
    public function stats(Request $request,$id){
        $advert = Advert::find($id);
        return view('business.stats',['advert'=>$advert]);
    }
}
