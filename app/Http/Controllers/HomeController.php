<?php

namespace App\Http\Controllers;

use App\Model\EmailCode;
use App\Model\ExtraType;
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
        $body['meta']['price']=$request->price*100;
        foreach ($fields as $field){
            if($request->has($field->slug)){
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
            $orders = array();
            if($request->has('featured')){
                $orders[] = ['title'=>'Featured','price'=>$request->get('featured-price')];
            }
            if($request->has('urgent')){
                $orders[] = ['title'=>'Urgent','price'=>$request->get('urgent-price')];
            }
            if($request->has('spotlight')){
                $orders[] = ['title'=>'Spotlight','price'=>$request->get('spotlight-price')];
            }
            if($request->has('shipping')){
                $orders[] = ['title'=>'Shipping','price'=>$request->get('shipping-price')];
            }
            $user = Auth::user();
            /*
            $balance = \Stripe\Balance::retrieve(
                array("stripe_account" => $user->stripe_account)
            );
            */
            $stripe_id = $user->stripe_id;
            $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
                'limit' => 10, 'object' => 'card'));
            $gateway = new \Braintree\Gateway(array(
                'accessToken' => 'access_token$sandbox$jv3x2sd9tm2n385b$ec8ce1335aea01876baaf51326d9bd90',
            ));
            $clientToken = $gateway->clientToken()->generate();

            return view('home.payment',['orders'=>$orders,'total'=>$total,'cards'=>$cards['data'],'token' => $clientToken]);
        }else{
            return redirect('/user/manage/ads');

        }
      //  return ['response' => $response];
      //  return $request->all();
      //  $categories = Category::where('parent_id',0)->get();

     //   return view('home.myadverts');
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
    public function children(Request $request,$id)
    {
        $category = Category::find($id);
        return view('home.categorylist',['categories'=>$category->children]);
    }
    public  function extras(Request $request,$id){
        $category = Category::find($id);
        if($category===null){
            return ['msg'=>'Catagory not found'];
        }
        $fields = $category->fields;
        foreach ($fields as $field){
            if($field->type==='list'){
                $field->values = $field->values;
            }
        }
        return view('home.extras',['fields'=>$fields]);
    }
    public  function prices(Request $request,$id){
        $category = Category::find($id);
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
        return redirect('/user/manage/ads');
    }
}
