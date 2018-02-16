<?php

namespace App\Http\Controllers;
use App\Mail\AccountCreated;
use App\Model\Address;
use App\Model\Application;
use App\Model\Business;
use App\Model\CompanyAlert;
use App\Model\Commission;
use App\Model\Contact;
use App\Model\Cover;
use App\Model\Cv;
use App\Model\Dispatch;
use App\Model\Distance;
use App\Model\Invoice;
use App\Model\InvoiceItem;
use App\Model\Profile;
use App\Model\Message;
use App\Model\Pack;
use App\Model\Payment;
use App\Model\Postcode;
use App\Model\Rating;
use App\Model\ReplyTemplate;
use App\Model\Review;
use App\Model\Room;
use App\Model\Sale;
use App\Model\SearchAlert;
use App\Model\Shipping;
use App\Model\Transaction;
use App\User;
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
use App\Model\LookingFor;
use App\Model\Field;
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
    public function push(Request $request){
        $this->ios_call('yea',['data'=>'yes']);
    }

    public function post(Request $request)
    {
        $user = Auth::user();
        $categories = Category::where('parent_id', 0)->get();

        return view('home.post', ['categories' => $categories, 'user' => $user, 'extras' => false, 'fields' => false, 'hasprice' => false, 'category' => false, 'location' => false, 'message' => false]);

    }
    public function c_login(Request $request,$id){
        $advert=Advert::find($id);
        return redirect($advert->url());
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
        $user = Auth::user();

        return view('home.ad',['user'=>$user,'advert'=>$advert,'categories' => $categories,'shipping'=>$shipping,'economies'=>Shipping::where('type',0)->get(),'standards'=>Shipping::where('type',1)->get(),'expresses'=>Shipping::where('type',2)->get(),'distances'=>Distance::all(),'dispatches'=>Dispatch::all()]);
    }
    public function edit(Request $request,$id)
    {
        $advert = Advert::find($id);
        $user = Auth::user();
        //$advert = Advert::find($id);
        $categories = Category::where('parent_id', 0)->get();
        if($advert->has_param('shipping')){
            $shipping=Shipping::find($advert->param('shipping'));
        }else{
            $shipping=Shipping::find(1);
        }
        if($advert->has_meta('available_date')){
            $advert->dict['meta']['available_date'] = date('Y-m-d', $advert->meta('available_date') / 1000);
        }

        return view('home.edit',['user'=>$user,'advert'=>$advert,'categories' => $categories,'shipping'=>$shipping,'economies'=>Shipping::where('type',0)->get(),'standards'=>Shipping::where('type',1)->get(),'expresses'=>Shipping::where('type',2)->get(),'distances'=>Distance::all(),'dispatches'=>Dispatch::all()]);
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
            $forsale = Category::find(2000000000);

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
        if($request->has('candeliver')&&$request->candeliver==='1')
        {
            $body['candeliver']=1;
            $meta['distance']=(int)$request->distance;
            $meta['delivery']=(int)($request->delivery*100);
        }else{
            $body['candeliver']=0;
        }

        if($request->has('freeshipping')&&$request->freeshipping==='1')
        {
            $body['freeshipping']=1;
            $meta['shipping']=0;
        }else{
            $body['freeshipping']=0;
            $meta['shipping']=(int)($request->buyer_pays*100);
        }

        if($request->has('acceptreturns')&&$request->acceptreturns==='1')
            $body['acceptreturns']=1;
        else
            $body['acceptreturns']=0;
        if($request->has('canship')&&$request->canship==='1'){

            $body['canship']=1;
            $meta['dispatch']=(int)$request->dispatch;
            $body['shipping']=(int)$request->shipping;
            $advert->shipping_id=(int)$request->shipping;
            $advert->save();
        }else{
            $body['canship']=0;
        }

        if($request->has('phone')&&$request->phone==='1'){
            $body['phone']=$user->phone;
        }
            else{
                $advert->remove_param('phone');
            }

        if($request->has('offer')&&$request->offer==='1'){
            $body['offer']=1;
        }
        else{
            $body['offer']=0;
        }

        if($request->has('showmap')&&$request->showmap==='1'){
            $body['showmap']=1;
        }
        else{
            $body['showmap']=0;
        }


            $advert->update_fields($body);

        foreach ($advert->category->fields as $field){
            if($field->slug!=='price' && $field->slug!=='available_date' && $request->has($field->slug)){
                $meta[$field->slug] = $request->get($field->slug);
            }
        }
        if($request->has('price')){
            $meta['price']=$request->price*100;
        }else{
            $meta['price']=-1;
        }
        if($request->has('available_date')){
            $meta['available_date'] =  strtotime($request->get('available_date')) * 1000;
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
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
        ));
        $clientToken = $gateway->clientToken()->generate();

        return view('home.payment',['order'=>Order::find($order_id),'cards'=>$cards,'token' => $clientToken,'def'=>$card,'user'=>$user]);
    }
    public function sale(Request $request,$id){
        $user = Auth::user();
        /*
        $balance = \Stripe\Balance::retrieve(
            array("stripe_account" => $user->stripe_account)
        );
        */


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
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
        ));
        $clientToken = $gateway->clientToken()->generate();
        $sale=Sale::find($id);
        return view('home.sale',['sale'=>$sale,'cards'=>$cards,'token' => $clientToken,'def'=>$card,'user'=>$user,'advert'=>$sale->advert]);
    }
    public function checkout(Request $request,$id){
        $user = Auth::user();
        /*
        $balance = \Stripe\Balance::retrieve(
            array("stripe_account" => $user->stripe_account)
        );
        */
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
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
        ));
        $clientToken = $gateway->clientToken()->generate();
        $sale=Sale::find($id);
        return view('home.checkout',['sale'=>$sale,'cards'=>$cards,'token' => $clientToken,'def'=>$card,'user'=>$user,'advert'=>$sale->advert]);
    }
    public function agree_sale(Request $request)
    {
        $user = Auth::user();
        $advert=Advert::find($request->id);
        $sale = new Sale;
        $sale->user_id=$user->id;
        //$sale->type=$request->type;
        $sale->advert_id=$advert->id;
        $sale->seller_id=$advert->user_id;
        $sale->save();
        return redirect('/user/manage/sale/'.$sale->id);
    }
    public function shipping(Request $request,$id){
        $user = Auth::user();
        /*
        $balance = \Stripe\Balance::retrieve(
            array("stripe_account" => $user->stripe_account)
        );
        */
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
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
    public function createAlert(Request $request){
        $user = Auth::user();
        $jobCategory = Category::find(4000000000);
        $childcareServices = Category::find(5070000000);
        $healtBeauty = Category::find(4252000000);
        $housekeeping = Category::find(4120706000);
        $fields = array();
        foreach ($jobCategory->fields as $field) {
            $fields[$field->id] = $field;
        }
        $sectors = $jobCategory->children->put($childcareServices->id, $childcareServices);
        $sectors = $sectors->put($housekeeping->id, $housekeeping);
        $sectors = $sectors->put($healtBeauty->id, $healtBeauty)->sortBy('title');
        return view('home.alert',[ 'user' => $user, 'sectors' => $sectors, 'fields' => $fields]);
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
        return redirect('/'.$category->slug.'/'.$location->slug)->with('msg', 'Your alert was created correctly');
    }
    public function createCompanyAlert(Request $request, $id){
        $company = Business::find($id);
        $user = Auth::user();
        $companyAlert = new CompanyAlert();
        $companyAlert->user_id = $user->id;
        $companyAlert->title = $company->name;
        $companyAlert->business_id = $company->id;
        $companyAlert->save();
        return redirect('/companies')->with('msg', 'Your alert was create correctly');
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
            $dict2 = ['description.keyword'=> strtolower($text)];

        }else{
            $dict = ['title'=> strtolower($text)];
            $dict2 = ['description'=> strtolower($text)];

        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size' => 0,
                'query'=>['match_phrase'=>['title'=>$text]],
      //          'query' => ['bool'=>['should'=>[['term'=>$dict],['term'=>$dict2]]]],
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
        $sids = array_map(function ($a) { return $a->id; },$categories);

        $titles = Category::where('title','like','%'.$text.'%')->whereNotIn('id',$sids)->limit(4)->get();
        foreach ($titles as $category){
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
    public function product_url(Request $request,$any,$id)
    {
        $advert = Advert::find($id);
        return redirect($advert->url().'?srn=true');
    }
    public function profile(Request $request,$type)
    {
        $profileTypes = ['general', 'social-childcare', 'sub-contractor'];
        $user = Auth::user();
        if($user->profile($type)===null){
            $profile = new Profile($type);
            $profile->user_id=$user->id;
            $profile->save();
        }
        $totalApplication = $user->applications()->count();
        return view('home.jobprofile',['profile'=>$user->profile($type),'user'=>$user,'type'=>$type,'types' => $profileTypes, 'totalApplication' => $totalApplication]);
    }

    public function view_profile(Request $request,$id)
    {
        $user = User::find($id);
        if($user->profile===null){
            $profile = new Profile();
            $profile->user_id=$user->id;
            $profile->save();
            $user->profile=$profile;

        }


        return view('market.jobprofile',['profile'=>$user->profile,'user'=>$user]);
    }

    public function create_invoice(Request $request,$id)
    {
        $room = Room::find($id);
        $user = Auth::user();
        return view('home.invoice',['room'=>$room,'user'=>$user]);
    }
    public function invoices(Request $request)
    {
        $user = Auth::user();
        return view('home.invoices',['user'=>$user]);
    }
    public function save_invoice(Request $request)
    {
        $user = Auth::user();

        $room =  Room::find($request->id);
        $invoice = new Invoice();
        $invoice->title = $request->title;
        $invoice->notes = $request->notes;
        $invoice->terms = $request->terms;
        $invoice->user_id = $user->id;
        if($request->has('add_ship_info'))
            $invoice->show_ship = $request->add_ship_info;
        if($request->has('add_vat_info'))
            $invoice->show_vat = $request->add_vat_info;
        $invoice->save();

        $items = $request->items;
        $amounts = $request->prices;
        for($i=0;$i<count($amounts);$i++){
            $invoice_item = new InvoiceItem();
            $invoice_item->invoice_id = $invoice->id;
            $invoice_item->title = $items[$i];
            $invoice_item->amount = $amounts[$i]*100;
            $invoice_item->save();
        }


        $message = new Message;
        $message->message='Invoice';
        $message->type='invoice';
        $message->from_msg=$user->id;
        $message->to_msg=$room->other()->id;
        $message->room_id=$room->id;
        $message->invoice_id=$invoice->id;

        $message->url='';
        $message->save();

        $invoice->message_id=$message->id;
        $invoice->save();

        $this->notify($room,$message);
        $room->modify();

        return redirect('/user/manage/messages');
    }
    public function pay(Request $request,$id){
        $user = Auth::user();
        $invoice = Invoice::find($id);
        $seller = $invoice->message->user;
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
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
        ));
        $clientToken = $gateway->clientToken()->generate();

        return view('home.pay',['invoice'=>$invoice, 'seller' => $seller,'cards'=>$cards,'token' => $clientToken,'def'=>$card,'user'=>$user]);
    }
    
    public function applications(Request $request)
    {
        $user = Auth::user();
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        return view('home.applications',['jobs'=>$user->jobs,'user'=>$user, 'balance' => $balance]);
    }
    public function motors(Request $request)
    {
        $user = Auth::user();
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        return view('home.motors',['motors'=>$user->motors,'user'=>$user, 'balance' => $balance]);
    }
    public function view_applications(Request $request,$id)
    {
        $user = Auth::user();

        return view('home.view_applications',['job'=>Advert::find($id),'user'=>$user]);
    }
    public function save_profile(Request $request)
    {
        $user = Auth::user();

        $profile=$user->profile;
        $profile->about_me = $request->about_me;
        $profile->salary=$request->salary;
        $profile->save();

        return redirect('/user/manage/details');

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

        $forsale = Category::find(2000000000);
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

        $forsale = Category::find(2000000000);
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
        if($request->has('redirect'))
            return redirect($request->redirect);
        else{
            return ['msg', 'ok'];
        }
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
        if($request->has('cv'))
        $application->cv_id = $request->cv;
        if($request->has('cover'))
        $application->cover_id = $request->cover;
        if($request->has('ctext')&&$request->ctext){
            $cover = new Cover;
            $cover->title=$request->ctitle;
            $cover->category_id=$advert->category_id;
            $cover->cover=$request->ctext;
            $cover->user_id=$user->id;
            $cover->save();
            $application->cover_id = $cover->id;
        }
        $application->save();

        $room = Room::where('advert_id',$advert->id)->where('sender_id',$user->id)->first();
        if($room===null){
            $room = new Room;
            $room->advert_id = $advert->id;
            $room->image=$advert->first_image();
            $room->title=$advert->param('title');
            $room->sender_id=$user->id;
            $room->save();
            $room->users()->save($user);
            if($user->id!==$advert->user_id){

                if($advert->user===null){
                    $room->users()->save(User::find(1));
                }else{

                    $room->users()->save($advert->user);
                }
            }

            $advert->replies++;
            $advert->save();
        }


        if($application->cover) {

            $message = new Message;
            $message->message = $application->cover->cover;
            $message->from_msg = $user->id;
            $message->to_msg = $advert->user_id;
            $message->room_id = $room->id;
            $message->url = '';
            $message->save();

            $this->notify($room, $message);
        }
        return redirect($advert->url());

    }
    public function apply_all(Request $request)
    {

        // Get the currently authenticated user...
        $user = Auth::user();
        $ids = $request->ids;
        if($ids===null) {
            return redirect('/user/manage/my/applications');
        }
        foreach ($ids as $id) {
            $advert = Advert::find($id);
            $application = Application::where('advert_id',$advert->id)->where('user_id',$user->id)->first();
            if($application===null){
                $application = new Application;
                $application->advert_id = $advert->id;
                $application->user_id = $user->id;
                $application->save();
            }
        }
        return redirect('/user/manage/my/applications');

    }
    public function my_applications(Request $request)
    {
        $user = Auth::user();
        $applications = $user->applications()->orderBy('id','desc')->paginate(10);

        return view('home.my_applications',['user'=>$user,'applications'=>$applications]);

    }
    public function apply_show(Request $request)
    {
        $user=Auth::user();
        $ids = $request->ids;
        if($ids===null){
            return redirect()->back()->with('msg', 'Please select at least one application');

        }
        $ads = [];
        foreach ($ids as $id) {
            $advert = Advert::find($id);
            $ads[] = $advert;
        }
        return view('home.bulk',['user'=>$user,'adverts'=> $ads]);

    }
    public function add_template(Request $request){
        $user=Auth::user();

        return view('home.template',['user'=>$user]);
    }

    public function templates(Request $request){
        $user=Auth::user();

        return view('home.templates',['user'=>$user]);
    }
    public function save_template(Request $request){
        $user=Auth::user();
        $template = new ReplyTemplate();
        $template->title = $request->title;
        $template->message = $request->message;
        $template->user_id = $user->id;
        $template->save();
        return redirect('/user/manage/templates');
    }
    public function delete_template(Request $request,$id){
        $template = ReplyTemplate::find($id);
        $template->delete();

        return redirect('/user/manage/templates');

    }

    public function reply_all(Request $request){
        $user=Auth::user();

        $template = ReplyTemplate::find($request->template);
        foreach ($request->ids as $id) {


            $application = Application::find($id);
            $advert = $application->advert;


            $room = Room::where('advert_id', $application->advert_id)->where('sender_id', $application->user_id)->first();
            if ($room === null) {
                $room = new Room;
                $room->advert_id = $application->advert->id;
                $room->image = $application->advert->first_image();
                $room->title = $application->advert->param('title');
                $room->sender_id = $application->user->id;
                $room->save();
                $room->users()->save($application->user);
                if ($user->id !== $application->user->id) {
                    $room->users()->save($user);


                }

                $advert->replies++;
                $advert->save();
            }


            $message = new Message;
            $message->message = $template->message;
            $message->from_msg = $user->id;
            $message->to_msg = $application->user_id;
            $message->room_id = $room->id;
            $message->url = '';
            $message->save();


            $room->modify();

            $this->notify($room, $message);
        }
        return redirect()->back()->with('msg', 'Replies successfully sent');

    }

    public function identity(Request $request)
    {
        $user = Auth::user();

        $filename = $request->identity;
        $path = $request->file('identity')->getRealPath();

        $fp = fopen($path, 'r');
        $result = \Stripe\FileUpload::create(array(
            'purpose' => 'identity_document',
            'file' => $fp
        ));
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->legal_entity->verification->document = $result->id;
        $account->save();
        return redirect('/user/manage/details');
    }
    public function terms(Request $request)
    {
        $user = Auth::user();
        $account = \Stripe\Account::retrieve($user->stripe_account);
        $account->tos_acceptance->date = time();
        $account->tos_acceptance->ip = $request->ip();
        $account->save();
        return redirect('/user/manage/details');
    }
    public function add_address(Request $request)
    {
        $postcode = Postcode::where('postcode',strtoupper(str_replace(' ','',$request->postcode)))->first();

        $user = Auth::user();
        $address = new Address;
        $address->line1=$request->line1;
        $address->city=$request->city;
        $address->postcode=$postcode->postcode;
        $address->user_id=$user->id;
        $address->zip_id=$postcode->id;
        $address->code=rand(1000,9999);
        $address->save();
        if($user->default_address===0){
            $user->default_address=$address->id;
            $user->save();
        }
        if(count($user->addresses)===1){
            $account = \Stripe\Account::retrieve($user->stripe_account);
            $account->legal_entity->address->line1=$request->line1;
            $account->legal_entity->address->city=$request->city;
            $account->legal_entity->address->country='GB';
            $account->legal_entity->address->postal_code=$postcode->postcode;
            $account->save();
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
        if(env('APP_DEBUG')){

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
                'body' => env('APP_NAME').': Your verification code is '.$code
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

        $token = $user->createToken('Contract Token')->accessToken;

        $order->contract->api_token=$token;
        $order->contract->save();

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
                if($item->type->extra_type){
                    $body[$item->type->extra_type->slug] = 1;

                    $body[$item->type->extra_type->slug.'_count'] = 0;

                    $body[$item->type->extra_type->slug.'_expires'] = $milliseconds + $item->type->quantity * 24 * 3600 * 1000;
                }

            }

            if(!empty($body)){
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
                  //
                    "customer" => $stripe_id,
                   "source" => $card, // obtained with Stripe.js
                   "description" => $description
               ));
           }

            if($order->type==='contract'){
               $this->complete_contract($order);
               // $request->session()->forget('order_id');
                $transaction = new Transaction();
                $transaction->amount = $order->amount_in_pence();
                $transaction->user_id = 0;
                $transaction->description = "Funds from Invoice ".$order->id;
                $transaction->type=5;
                $transaction->direction = 0;
                $transaction->save();
                return redirect('/user/contract/sign');
            }
            if($order->type==='bump') {
                $this->complete_bump($order);
                $request->session()->forget('order_id');

                $transaction = new Transaction();
                $transaction->amount = $order->amount_in_pence();
                $transaction->user_id = 0;
                $transaction->description = "Funds from Enhancement ".$order->id;
                $transaction->type=6;
                $transaction->direction = 0;
                $transaction->save();

                return redirect('/user/manage/ads');
            }
           if($order->type==='invoice') {
               $this->complete_invoice($order);
               $request->session()->forget('order_id');

               $transaction = new Transaction();
               $transaction->amount = $order->amount_in_pence();
               $transaction->user_id = 0;
               $transaction->description = "Funds from Invoice ".$order->id;
               $transaction->type=5;
               $transaction->direction = 0;
               $transaction->save();

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
    public function mark_received(Request $request,$id){
        $user = Auth::user();
        $sale=Sale::find($id);
        $sale->status=2;

        $transaction = new Transaction();
        $transaction->amount = (int)(90*$sale->advert->price());
        $transaction->user_id = $sale->advert->user_id;
        $transaction->description = "Funds for Order ID ".$sale->id;
        $transaction->direction = 1;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->amount = (int)(10*$sale->advert->price());
        $transaction->user_id = 0;
        $transaction->description = 'Commission from Sale with ID '.$sale->id;
        $transaction->type=1;
        $transaction->direction = 0;
        $transaction->save();

        $sale->save();
        return redirect('/user/manage/orders');
    }
    public function mark_shipped(Request $request,$id){
        $user = Auth::user();

        $sale=Sale::find($id);
        if($sale->advert->shipping->tracking==='Yes')
        {
            return redirect('/user/order/provide/tracking/'.$sale->id);
        }
        $sale->status=2;
        $transaction = new Transaction();
        $transaction->amount = (int)(90*$sale->advert->price());
        $transaction->user_id = $user->id;
        $transaction->description = "Funds for Order ID ".$sale->id;
        $transaction->direction = 1;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->amount = (int)(10*$sale->advert->price());
        $transaction->user_id = 0;
        $transaction->description = 'Commission from Sale with ID '.$sale->id;
        $transaction->type=1;
        $transaction->direction = 0;
        $transaction->save();

        $sale->save();
        return redirect('/user/manage/orders');
    }

    public function cancel_sale(Request $request,$id){
        $sale=Sale::find($id);
        $sale->status=3;
        $sale->save();
        return redirect('/user/manage/orders');
    }
    public function provide_tracking(Request $request,$id){
        $user = Auth::user();

        $sale=Sale::find($id);
        return view('home.tracking',['sale'=>$sale,'user'=>$user]);
    }
    public function update_tracking(Request $request){
        $user = Auth::user();

        $sale=Sale::find($request->id);
        $sale->tracking = $request->tracking;
        $sale->status=2;
        $transaction = new Transaction();
        $transaction->amount = (int)(90*$sale->advert->price());
        $transaction->user_id = $user->id;
        $transaction->description = "Funds for Order ID ".$sale->id;
        $transaction->direction = 1;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->amount = (int)(10*$sale->advert->price());
        $transaction->user_id = 0;
        $transaction->description = 'Commission from Sale with ID '.$sale->id;
        $transaction->type=1;
        $transaction->direction = 0;
        $transaction->save();

        $sale->save();
        return redirect('/user/manage/orders');
    }
    public function update_offer($user){
        if($user->offered===0&&$user->referred_code!==''){
            $other = User::where('referral_code',$user->referred_code)->first();
            $transaction = new Transaction();
            $transaction->amount = 300;
            $transaction->user_id = $other->id;
            $transaction->description = "Referral Credit from ".$user->name;
            $transaction->direction = 1;
            $transaction->save();


            $transaction = new Transaction();
            $transaction->amount = 300;
            $transaction->user_id = 0;
            $transaction->description = "Referral Credit to ".$other->name;
            $transaction->direction = 1;
            $transaction->save();

            $user->offered=1;
            $user->save();
        }
    }
    public function sale_stripe(Request $request,$id){
        $user = Auth::user();
        $sale=Sale::find($id);
        $stripe_id = $user->stripe_id;
        $card = $request->card;
        $sale->type=$request->type;
        $sale->save();
        $description = 'Payment towards to Order id '.$sale->id;
        try {
            if($sale->amount_in_pence()>0){
                $charge = \Stripe\Charge::create(array(
                    "amount" => $sale->amount_in_pence(),
                    "currency" => "gbp",
                    "customer" => $stripe_id,
                    "source" => $card, // obtained with Stripe.js
                    "description" => $description
                ));
               $this->update_offer($user);
            }
            $sale->status=1;
            /*if($sale->type == 0){
                if($request->has('delivery_address'))
                    $sale->address_id=$request->delivery_address;
            }
            else*/ 
            if($sale->type < 2){
                if($request->has('shipping_address'))
                    $sale->address_id = $request->shipping_address;
            }
            if($request->has('billing_address'))
                $sale->billing_address_id=$request->billing_address;
                     $sale->save();
            $sale->advert->update_fields(['sold'=>1]);


            if($sale->type==2){
                $transaction = new Transaction();
                $transaction->amount = (int)(90*$sale->advert->price());
                $transaction->user_id = $sale->advert->user_id;
                $transaction->description = "Funds for Order ID ".$sale->id;
                $transaction->direction = 1;
                $transaction->save();


                $transaction = new Transaction();
                $transaction->amount = (int)(10*$sale->advert->price());
                $transaction->user_id = 0;
                $transaction->description = 'Commission from Sale with ID '.$sale->id;
                $transaction->type=1;
                $transaction->direction = 0;
                $transaction->save();


            }
            $this->notify_sale($sale);


                return redirect('/user/manage/orders');


        }
        catch (\Exception $e) {
            return [
                'status' => 'failed',
                'error' => $e,
                'result' => ['msg' => 'error charging the card']
            ];
        }

    }
    public function invoice_stripe(Request $request,$id){
        $user = Auth::user();
        $invoice=Invoice::find($id);
        $stripe_id = $user->stripe_id;
        $card = $request->card;




        $description = 'Payment towards to Invoice id '.$invoice->id;
        try {
            if($invoice->amount_in_pence()>0){
                $charge = \Stripe\Charge::create(array(
                    "amount" => $invoice->amount_in_pence(),
                    "currency" => "gbp",
                    "customer" => $stripe_id,
                    "source" => $card, // obtained with Stripe.js
                    "description" => $description
                ));
                $this->update_offer($user);

            }

            if($invoice->type===0){
                $transaction = new Transaction();
                $transaction->amount = (int)(90*$invoice->amount());
                $transaction->user_id = $invoice->user_id;
                $transaction->description = "Funds for Invoice ID ".$invoice->id;
                $transaction->direction = 1;
                $transaction->save();

                $transaction = new Transaction();
                $transaction->amount = (int)(10*$invoice->amount());
                $transaction->user_id = 0;
                $transaction->description = "Commission from Invoice ID ".$invoice->id;
                $transaction->type=2;
                $transaction->direction = 0;
                $transaction->save();

            }
            $invoice->status=1;


            if($request->has('billing_address'))
                $invoice->billing_address_id=$request->billing_address;
            $invoice->save();



            $this->notify_invoice($invoice);


            return redirect('/user/manage/messages');


        }
        catch (\Exception $e) {
            return [
                'status' => 'failed',
                'error' => $e,
                'result' => ['msg' => 'error charging the card']
            ];
        }

    }
    public function invoice_paypal(Request $request,$id){
        $user = Auth::user();
        $invoice=Invoice::find($id);

        $gateway = new \Braintree\Gateway(array(
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
        ));



        $description = 'Payment towards to Invoice id '.$invoice->id;
        try {

            if($invoice->amount()>0){
                $result = $gateway->transaction()->sale([
                    "amount" => $invoice->amount(),
                    'paymentMethodNonce' => $request->nonce,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);
                $this->update_offer($user);

            }

            if($invoice->type===0){
                $transaction = new Transaction();
                $transaction->amount = (int)(90*$invoice->amount());
                $transaction->user_id = $invoice->user_id;
                $transaction->description = "Funds for Invoice ID ".$invoice->id;
                $transaction->direction = 1;
                $transaction->save();

                $transaction = new Transaction();
                $transaction->amount = (int)(10*$invoice->amount());
                $transaction->user_id = 0;
                $transaction->description = "Commission from Invoice ID ".$invoice->id;
                $transaction->type=2;
                $transaction->direction = 0;
                $transaction->save();
            }
            $invoice->status=1;


            if($request->has('billing_address'))
                $invoice->billing_address_id=$request->billing_address;
            $invoice->save();



            $this->notify_invoice($invoice);


            return redirect('/user/manage/messages');


        }
        catch (\Exception $e) {
            return [
                'status' => 'failed',
                'error' => $e,
                'result' => ['msg' => 'error charging the card']
            ];
        }

    }
    public function sale_paypal(Request $request,$id){
        $user = Auth::user();
        $sale=Sale::find($id);
        $sale->type=$request->type;
        $sale->save();
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
        ));




        try {
            if($sale->amount()>0){
                $result = $gateway->transaction()->sale([
                    "amount" => $sale->amount(),
                    'paymentMethodNonce' => $request->nonce,
                    'options' => [
                        'submitForSettlement' => True
                    ]
                ]);
                $this->update_offer($user);

            }
            $sale->status=1;

            if($request->has('delivery_address'))
                $sale->address_id=$request->delivery_address;
            if($request->has('shipping_address'))
                $sale->address_id=$request->shipping_address;
            $sale->save();
            $sale->advert->update_fields(['sold'=>1]);

            if($sale->type==2){
                $transaction = new Transaction();
                $transaction->amount = (int)(90*$sale->advert->price());
                $transaction->user_id = $sale->advert->user_id;
                $transaction->description = "Funds for Sale ID ".$sale->id;
                $transaction->direction = 1;
                $transaction->save();

                $transaction = new Transaction();
                $transaction->amount = (int)(10*$sale->advert->price());
                $transaction->user_id = 0;
                $transaction->description = "Commission from Sale ID ".$sale->id;
                $transaction->type=1;
                $transaction->direction = 0;
                $transaction->save();
            }
            $this->notify_sale($sale);


            return redirect('/user/manage/orders');


        } catch (Exception $e) {

            return ['result' => ['msg' => 'failed']];
        }
    }
    public function paypal(Request $request){
        $user = Auth::user();
        $gateway = new \Braintree\Gateway(array(
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
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
                $this->update_offer($user);

            }

            if($order->type==='contract'){
                $this->complete_contract($order);
                // $request->session()->forget('order_id');

                $transaction = new Transaction();
                $transaction->amount = $order->amount_in_pence();
                $transaction->user_id = 0;
                $transaction->description = "Funds from Invoice ".$order->id;
                $transaction->type=5;
                $transaction->direction = 0;
                $transaction->save();

                return redirect('/user/contract/sign');
            }
            if($order->type==='bump') {
                $this->complete_bump($order);
                $request->session()->forget('order_id');

                $transaction = new Transaction();
                $transaction->amount = $order->amount_in_pence();
                $transaction->user_id = 0;
                $transaction->description = "Funds from Enhancement ".$order->id;
                $transaction->type=6;
                $transaction->direction = 0;
                $transaction->save();

                return redirect('/user/manage/ads');
            }
            if($order->type==='invoice') {
                $this->complete_invoice($order);
                $request->session()->forget('order_id');

                $transaction = new Transaction();
                $transaction->amount = $order->amount_in_pence();
                $transaction->user_id = 0;
                $transaction->description = "Funds from Invoice ".$order->id;
                $transaction->type=5;
                $transaction->direction = 0;
                $transaction->save();

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
        $user = Auth::user();

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
        $request->setSubject(env('APP_NAME').' Contract');
        $request->setMessage('welcome to '.env('APP_NAME'));
        $request->addSigner($user->email, $user->name.' '.$user->last);
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

    public function withdraw(Request $request)
    {
        $user = Auth::user();
        $bank = $request->account;
        $amount = $request->amount * 100;

        \Stripe\Stripe::setApiKey($user->sk_key);
        try {
            \Stripe\Payout::create(array(
                "amount" => $amount,
                "currency" => "gbp",
                "destination" => $bank
            ));

        } catch (\Exception $e) {
            return [
                'success' => false,
                'res'=>$e,
                'result' => 'error withdrawing'
            ];
        }

        return redirect('/user/manage/details');
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
                $contract->discount = 30;
                $contract->minimum = 2500000;
            }
            else if((int)$id===3){
                $contract->discount = 40;
                $contract->minimum = 10000000;
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
                $contract->discount = 20;
                $contract->minimum = 500000;
            }
            else if((int)$id===2){
                $contract->discount = 30;
                $contract->minimum = 2500000;
            }
            else if((int)$id===3){
                $contract->discount = 40;
                $contract->minimum = 10000000;
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
        $request->addSigner(env('MAIL_FROM_ADDRESS'), 'Anil');
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
    public function contacts(Request $request){
        $user=Auth::user();

        return view('home.contacts',['user'=>$user]);
    }
    public function add_contact(Request $request){
        $user=Auth::user();

        return view('home.addcontact',['user'=>$user]);
    }
    public function create_group(Request $request){
        $user=Auth::user();

        return view('home.group',['user'=>$user]);
    }
    public function create_broadcast(Request $request){
        $user=Auth::user();

        return view('home.broadcast',['user'=>$user]);
    }


    public function edit_profile(Request $request){
        $user=Auth::user();

        return view('home.profile',['user'=>$user]);
    }
    public function new_message(Request $request){
        $user=Auth::user();

        return view('home.newmessage',['user'=>$user]);
    }
    public function settings(Request $request){
        $user=Auth::user();

        return view('home.settings',['user'=>$user]);
    }
    public function transfer_balance(Request $request,$id){
        $user=Auth::user();
        $other = User::find($id);
        return view('home.sharebalance',['user'=>$user,'other'=>$other]);
    }
    public function share_balance(Request $request){
        $user=Auth::user();
        $other = User::find($request->id);
        return view('home.sharebalance',['user'=>$user,'other'=>$other]);
    }
    public function save_pro(Request $request){
        $user=Auth::user();
        $user->image = $request->image;
        $user->display_name = $request->display_name;
        $user->save();

        return redirect('/user/manage/messages/');
    }

    public function adds_contact(Request $request){
        $user=Auth::user();
        $contact = new Contact();
        $contact->user_id=$user->id;
        $contact->first = $request->first;
        $contact->last = $request->last;
        $contact->phone = $request->phone;
        $contact->email = $request->email;
        $contact->save();
        return redirect('/user/manage/contacts');
    }
    public function stats(Request $request,$id){
        $advert = Advert::find($id);
        return view('business.stats',['advert'=>$advert]);
    }
    public function write_review(Request $request){
        $user=Auth::user();
        $review = new Review();
        $review->author_id = $user->id;
        $review->title = $request->title;
        $review->review = $request->review;
        $review->user_id = $request->id;
        $review->save();

        return redirect()->back();

    }
    public function rate_ad(Request $request){
        $user=Auth::user();
        $review = new Rating();
        $review->author_id = $user->id;
        $review->feedback = $request->feedback;
        $review->fees_rating = $request->fees_rating*10;
        $review->professional_rating = $request->professional_rating*10;
        $review->speed_rating = $request->speed_rating*10;
        $review->knowledge_rating = $request->knowledge_rating*10;
        $review->overall_rating = ($request->fees_rating + $request->professional_rating + $request->speed_rating + $request->knowledge_rating)*2.5;
        $review->user_id = $request->id;
        $review->save();

        return redirect()->back();
    }
    public function createPublicProfile(Request $request){
        $user = Auth::user();
        return view('home.public-profile', ['user' => $user]);
    }
    public function create_cover(Request $request){
        $user = Auth::user();
        if(isset($user->covers))
            $cover = $user->covers[0];
        else{
            $cover = null;
        }
        return view('home.create_covers', ['user' => $user, 'jobs' => Category::job_leaves(), 'cover' => $cover]);   
    }
    public function create_work_experience(Request $request){
        $user = Auth::user();
        return view('home.create_work_experience', ['user' => $user]);
    }
    public function upload_cv(Request $request){
        $user = Auth::user();
        return view('home.upload_cv_cloud', ['user' => $user, 'jobs' => Category::job_leaves()]);   
    }
    public function looking_for(Request $request){
        $user = Auth::user();
        $profile = $user->profile('general');
        if($profile->looking_for == null){
            $lookingFor = new LookingFor();
            $lookingFor->profile_id = $profile->id;
            $profile->looking_for = $lookingFor;
            $profile->looking_for->save(); 
            //$profile->save();
        }
        $lookingFor = $profile->looking_for;
        //return $lookingFor->jobTypes;
        $jobChildren = Category::find(4000000000)->children;
        $field = Field::find(15);
        $sectorsPreferred = array();
        $idsSubSectorPreferred = $lookingFor->sectors;
        $subSectorsPreferred = array();
        foreach($idsSubSectorPreferred as $sector){
            if(!array_key_exists($sector->parent_id, $sectorsPreferred)){
                $sectorsPreferred[$sector->parent_id] = $sector->parent;
                $subSectorsPreferred[$sector->parent_id] = array();
            }
            $subSectorsPreferred[$sector->parent_id][] = $sector;
        }
        $contractTypes = $field->values;
        return view('home.looking_for_edit', ['user' => $user, 'lookingFor' => $lookingFor, 'contractTypes' => $contractTypes, 'jobChildren' => $jobChildren, 'subSectorsPreferred' => $subSectorsPreferred, 'sectorsPreferred' => $sectorsPreferred]);
    }
    public function saveLookingFor(Request $request){
        $lookingFor = LookingFor::Find($request->looking_for_id);
        $lookingFor->job_title = $request->job_title;
        $lookingFor->min_per_annum = $request->minimum_salary;
        $lookingFor->min_per_hour = $request->minimum_temp_rate;
        $lookingFor->jobTypes()->detach();
        $lookingFor->jobTypes()->attach($request->contract_type);
        $lookingFor->sectors()->detach();
        $lookingFor->sectors()->attach($request->edit_subsector);
        if(isset($request->is_full_time))
            $lookingFor->full_time = 1;
        if(isset($request->is_part_time))
            $lookingFor->part_time = 1;
        $lookingFor->save();
        return redirect($request->redirect); 
    }
    public function cv_builder(Request $request, $slug){
        $user = Auth::user();
        $cvSections = [];
        $cvSections['personal-details'] = 'Details';
        $cvSections['work-experience'] = 'Work experience';
        $cvSections['qualifications'] = 'Qualifications';
        $cvSections['personal-statement'] = 'Personal statement';
        $indexSector = 0;
        foreach($cvSections as $key => $section){
            if($key === $slug){
                break;
            }
            $indexSector += 1;
        }  
        return view('home.cv-builder', ['user' => $user, 'slug' => $slug, 'cvSections' => $cvSections, 'indexSector' => $indexSector]);
    }
}
