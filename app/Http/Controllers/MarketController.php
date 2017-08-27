<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:28
 */

namespace App\Http\Controllers;


use App\Model\Advert;
use App\Model\Category;
use App\Model\Field;
use App\Model\FieldValue;
use App\Model\Filter;
use App\Model\Relation;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Model\Categories;

class MarketController extends BaseController
{
    public function show($id)
    {


        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>50,
                'query' => [
                    'bool' => [
                        'must_not'=>['term'=>['meta.price'=>-1]],
                        "filter" => [
                            "script" => ["script" => "doc['images'].values.length > 0"]
                        ]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        //$products=array_rand($products,50);
        return View('user.profile',['catagories'=>$this->categories,'products'=>$products]);
    }
    public  function  train(Request $request){
        $term = $request->q;
        $result = file_get_contents("https://www.gumtree.com/ajax/suggestions/prefix?input=".$term);

        $result = json_decode($result,true);

        $weight = $request->weight;
        foreach ($result['suggestions'] as $suggestion) {

            $params = [
                'index' => 'suggest',
                'type' => 'complete',
                'id' => random_int(10000000000,9999999999999),
                'body' => [
                    'suggest' => ['input' => $suggestion['name'], 'weight' => $weight],
                ]
            ];
            $response = $this->client->index($params);
            return $response;
            return ['a'=>'b'];
        }

    }
    public function suggest(Request $request)
    {

        $term = $request->q;


        // return ['q'=>$request->query,'suggestions'=>[['value'=>'Hello','data'=>'HE'],['value'=>'Samsung','data'=>'HE'],['value'=>'iPhone','data'=>'HE']]];
        $params = [
            'index' => 'suggest',
            'type' => 'complete',
            'body' => [
                "suggest" => [
             "search-suggest" => [
            "prefix" => ''.strtolower($term),
            "completion" => [
                "field" => "suggest"
                ]
        ]
            ]
            ]
        ];
        $response = $this->client->search($params);
      //  return $response['suggest']['search-suggest'][0]['options'];
        if(isset($response['suggest']['search-suggest'][0]['options'][0]['text'])){
            $text = $response['suggest']['search-suggest'][0]['options'][0]['text'];
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
                            "terms" => [ "field"=> "category", "size"=> 10]
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
            $cats = array_map(function ($a) use  ($text) {
                $ans = $a['key'];
                $category = Category::find($ans);
                if($category!==null)
                return ['value'=>strtolower($text),'category' => $category->title,'slug' => $category->slug,'data'=>$category->id];
            }, $bts);
            return ['text'=>$text,'suggestions'=>$cats];
        }else{
            return ['text'=>'','suggestions'=>[]];
        }


        /*
 // should start with page 15
            $adverts = Advert::paginate(10000);

            foreach ($adverts as $advert) {
                $params = [
                    'index' => 'adverts',
                    'type' => 'advert',
                    'id' => $advert->elastic
                ];

// Get doc at /my_index/my_type/my_id
                $response = $this->client->get($params);
                $title = $response['_source']['title'];
                $id = $response['_source']['source_id'];
                $params = [
                    'index' => 'suggest',
                    'type' => 'complete',
                    'id' => $id,
                    'body' => [
                        'suggest' => ['input' => $title, 'weight' => 255 - strlen($title)],
                    ]
                ];
                $response = $this->client->index($params);

            }

        return ['a'=>'b'];
        */

    }

    public  function id(Request $request,$id){
        return $this->categories[$id];
    }
    public function categories(Request $request){
        $base = Category::where('parent_id',0)->get();
        $categories = Category::all();
        $maps=array();
        foreach ($categories as $category){
            $category->children=$category->children;
            $maps[$category->id]=$category;
        }

        return ['base'=>$base,'categories'=>$maps];

    }
    /**
     * [getAllCategories description]
     * @param  Request $request [description]
     * @return Array with base categories and all categories and subcategories
     */
    public function getAllCategories(Request $request){
        $base = Category::where('parent_id',0)->get();
        $i = 0;
        $categories = Categories::getInstance()->getCategories();
        $maps=array();
        foreach ($base as $category){
            //$category->children=$category->children;
            $category->children =$category->getAllDescendants();
            $maps[$i]=$category;
            $i++;
        }
        return ['base'=>$base,'categories'=>$maps];

    }

    public function clients(Request $request){
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size' => 0,
                'aggs' => [
                    'group_by_phone' => [
                        "terms" => [ "field"=> "phone.keyword", "size"=> 200]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        return $response['aggregations']['group_by_phone']['buckets'];
    }

    public function update(Request $request){

            $id=$request->id;
            $replace = $request->replace;

            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size' => 10000,
                    'query' => [
                        'term' => [
                            "category" => $id
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
                            'category' => $replace
                        ]
                    ]
                ];

// Update doc at /my_index/my_type/my_id
                $response = $this->client->update($params);
                print_r($response);

            }
            return ['a'=>'b'];
        }

    public function insert(Request $request){
        $car = Category::find(105000000);
        $make=Field::find(1);
        $car->fields()->syncWithoutDetaching([$make->id]);

        return 'abc';
    }
    public function filters(Request $request,$any)
    {

        $category = Category::find($any);
        if($category===null){
            return ['msg'=>'Catagory not found'];
        }
        $fields = $category->fields;
        $aggs=array();
        foreach ($fields as $field){
            if($field->type==='integer'){
                $filters = $field->filters;
                $ranges = array();
                foreach ($filters as $filter){
                    $ranges[] = ['from'=>$filter->from_int,'to'=>$filter->to_int];
                }
                $aggs['group_by'.$field->slug]=['range'=>['field'=>'meta.'.$field->slug,'ranges'=>$ranges]];
            }else{
                $aggs['group_by'.$field->slug]=['terms'=>['field'=>'meta.'.$field->slug.'.keyword','size'=>1000000]];
            }
        }
        return ['fields' => $aggs];

    }
    public function fields(Request $request,$any)
    {
        $category = Category::find($any);
        if($category===null){
            return ['msg'=>'Catagory not found'];
        }
        $fields = $category->fields;
        foreach ($fields as $field){
            if($field->type==='list'){
                $field->values = $field->values;
            }
        }
        return ['fields' => $fields];
    }
    public function addfields(Request $request,$any){
        $categories = Category::all();

        foreach ($categories as $category) {

            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size' => 1,
                    'query' => [
                        'term' => [
                            "category" => $category->id
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
            if(count($products)==0){
               continue;
            }
            $product = $products[0];
            foreach ($product['meta'] as $key => $val) {
                if (in_array($val, ['true', 'false'])) {
                    echo 'is bool ' . $key . '<br>';
                } else if (is_int($val)) {
                    echo 'is int ' . $key . '<br>';
                } else {
                    echo 'is string ' . $key . '<br>';
                    $field = Field::where('slug', $key)->first();
                    if ($field !== null) {
                        $category->fields()->save($field);
                    }
                }
            }
        }

        return 'yes';
    }


    public function  pull(Request $request){
        $output = shell_exec('/home/anil/market/gitpull');
        return $output;
    }
    public function dummy(Request $request){
        return View('welcome');
    }
    public function jobscats(Request $request)
    {


        $params = [
            'index' => 'categories',
            'type' => 'category',
            'body' => [
                'size'=>2000,
                'query' => [
                    'range' => [
                        'id'=>['gte'=>400000000,"lt"=>500000000]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $cats = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        //$products=array_rand($products,50);
        $all=[];
        foreach ($cats as $cat)
        {
            echo  $cat['slug'].'?recruiter_type=recruiter_type,recruiter_type<br>';
            echo  $cat['slug'].'?salary_period=salary_period,salary_period<br>';
            echo  $cat['slug'].'?salary_min=salary_min,salary_min<br>';
            echo  $cat['slug'].'?salary_max=salary_max,salary_max<br>';
        }
        return "";
    }
    public function product(Request $request,$cat,$sid)
    {
        $breads = array();

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>1,
                'query' => [
                    'bool' => [
                        'must'=>['term'=>['source_id'=>$sid]],

                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $product=$products[0];
	

        $catagory= Category::find($product['category']);


        $cat=$catagory->slug;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [

                'size'=>6,
                'query' => [
                    'bool' => [
                        'must_not'=>['term'=>['source_id'=>$sid]],

                    'must'=>['range' => [
                        'category' => [
                            'gte'=>$catagory->id,
                            'lte'=>$catagory->ends
                        ]
                    ]]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $start=$cat;
        while (isset($this->parents[$start])){
            $start=$this->parents[$start];
            array_unshift($breads,$start);
        }

        return View('market.product',['last'=>$cat,'product'=>$product,'breads'=>$breads,'base'=>$this->base,'products'=>$products,'catagories'=>$this->categories,'parents'=>$this->parents,'children'=>$this->children]);
    }
    public function index(Request $request){
        return redirect('all');
    }
    public function leaves(Request $request){
        foreach ($this->categories as $cat=>$val){
            if(!isset($this->children[$cat]))
            {
                echo $cat.'<br>';
            }
        }
        return '';
    }
    public function error(Request $request){
        return ['msg'=>'No route found'];
    }
    public function query(Request $request){
        $category = Category::find($request->category);

        return $this->filter($request,$category);

    }
    public function filter($request,$category){
        $any = $category->slug;
        $fields = $category->fields()->where('can_filter',1)->get();
        $input = $request->all();

        $aggs=array();
        $musts=array();
        $lat = 52.1;
        $lng = 0.1;
        $input['lat']=$lat;
        $input['lng']=$lng;
        $musts['category']= [
            'range' => [
                'category' => [
                    'gte'=>$category->id,
                    'lte'=>$category->ends
                ]
            ]
        ];
        $min_price = -2;
        if($request->has('min_price')){
            if(is_numeric($request->min_price))
                $min_price = $request->min_price*100;
        }
        $max_price = 999999999999;
        if($request->has('max_price')){
            if(is_numeric($request->max_price))
                $max_price = $request->max_price*100;
        }
        $musts['meta.price']= [
            'range' => [
                'meta.price' => [
                    'gte'=>$min_price,
                    'lte'=>$max_price
                ]
            ]
        ];
        $filte = [
            "geo_distance" => [
                "distance" => "2000mi",
                "location" => [
                    "lat" => $lat,
                    "lon" => $lng
                ]
            ]
        ];
        if($request->has('photos_filter')&&$request->photos_filter==='true'){
            $filte['script'] =  ["script" => "doc['images'].values.length > 0"];
        }

        if($request->has('q')){
            $musts['title'] = [
                'match' => [
                    'title'=>$request->q
                ]
            ];
        }
        if($request->has('lat')&&$request->has('lng')){
            $lat = $request->lat;
            $lng = $request->lng;
            $input['lat']=$lat;
            $input['lng']=$lng;
            if($request->has('distance')){
                $distance = $request->distance;
            }else{
                $distance = '2000';
            }
            $filte = [
                "geo_distance" => [
                    "distance" => $distance."mi",
                    "location" => [
                        "lat" => $lat,
                        "lon" => $lng
                    ]
                ]
            ];
        }


        foreach ($fields as $field){

            if($field->type==='integer'){
                $filters = $field->filters;
                $ranges = array();
                foreach ($filters as $filter){
                    $ranges[] = ['from'=>$filter->from_int,'to'=>$filter->to_int];
                }
                $agg = ['range'=>['field'=>'meta.'.$field->slug,'ranges'=>$ranges]];;

            }else if($field->type==='list'){
                $agg=['terms'=>['field'=>'meta.'.$field->slug.'.keyword','size'=>1000000]];
            }
            $aggs[$field->slug]=$agg;


            if(isset($input[$field->slug])){
                $field = Field::where('slug', $field->slug)->first();
                if ($field === null) {


                } else {
                    if ($field->type === 'integer') {
                        $frange = Filter::where('key', $input[$field->slug])->first();
                        if ($frange !== null) {
                            $ran = [
                                'range' => [
                                    'meta.' . $field->slug => [
                                        'gte' => $frange->from_int,
                                        'lt' => $frange->to_int
                                    ]
                                ]
                            ];


                            $musts[$field->slug] = $ran;

                        }
                    }
                    if ($field->type === 'list') {
                        $fil = ['term' => ['meta.' . $field->slug . '.keyword' => ['value' => $input[$field->slug]]]];
                        $musts[$field->slug] = $fil;
                    }
                }
            }

        }


        $aggretations=array();

        foreach ($input as $key=>$value){
            $fd = Field::where('slug', $key)->first();
            if($fd!==null&&$fd->type!=='select') {
                $submusts = $musts;
                unset($submusts[$key]);
                $params = [
                    'index' => 'adverts',
                    'type' => 'advert',
                    'body' => [
                        'size' => 0,
                        'query' => [
                            'bool' => [
                                'must' => array_values($submusts),
                                'filter' => $filte
                            ]
                        ],
                        'aggs' => [$key => $aggs[$key]]

                    ]
                ];
                $response = $this->client->search($params);

                foreach ($response['aggregations'] as $a => $b) {
                    $aggretations[$a] = $b;
                }
                unset($aggs[$key]);
            }
        }

        $page = $request->page ? $request->page : 1;
        if($page>100)
        {
            $page=100;
        }
        $pagesize = 50;
        $sort = [
            [
                "created_at"=> ["order"=> "desc"]
            ],
            [
                "_geo_distance"=> [
                    "location" => [
                        "lat" =>  52.5,
                        "lon" => 1.2
                    ],
                    "order"=> "asc",
                    "unit"=> "km",
                    "distance_type"=> "plane"
                ]
            ]
        ];
        if($request->has('sort')){
            $skey = $request->sort;
            if($skey==='distance'){
                $lat = $request->lat;
                $lng = $request->lng;
                $sort = [

                    [
                        "_geo_distance"=> [
                            "location" => [
                                "lat" =>  $lat,
                                "lon" => $lng
                            ],
                            "order"=> "asc",
                            "unit"=> "km",
                            "distance_type"=> "plane"
                        ]
                    ],
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]
                ];
            }
            else if($skey==='price_highest_first'){
                $sort =[
                    [
                        "meta.price"=> ["order"=> "desc"]
                    ],
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]
                ];
            }
            else if($skey==='price_lowest_first'){
                $sort =[
                    [
                        "meta.price"=> ["order"=> "asc"]
                    ],
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]

                ];
            }
        }



        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => ($page-1)*$pagesize,
                'size'=>$pagesize,
                'query' => [
                    'bool' => [
                        'must' => array_values($musts),
                        'filter' => $filte
                    ]
                ],
                "sort"=> $sort

            ]
        ];
        if(count($aggs)>0){
            $params['body']['aggs']=$aggs;
        }


        $response = $this->client->search($params);
        if(isset($response['aggregations']))
            foreach ($response['aggregations'] as $a=>$b){
                $aggretations[$a]=$b;
            }
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $total= $response['hits']['total'];
        $max = (int)($total/$pagesize);
        $max++;
        if($max>100){
            $max=100;
        }

        $breads = array();
        $start = $category;
        while ($start!==null){
            $breads[]=$start;
            $start=$start->parent;
        }

        $breads=array_reverse($breads);
        array_pop($breads);
        if($max<5){
            $pages = range(1,$max);
        }
        else if($page<4){
            $pages = range(1,5);
        }
        else if($page>$max-2){
            $pages = range($max-4,$max);
        }
        else{
            $pages = range($page-2,$page+2);
        }
        if(isset($this->children[$any])){
            $chs=$this->children[$any];
        }else{
            $chs = [];
        }






        $filters=array();
        $parts= explode('?',$request->url());
        $all = $input;
        unset($all['page']);
        $pageurl = $parts[0].'?'.http_build_query($all);


        foreach ($aggretations as $key => $aggretation) {
            $field = Field::where('slug', $key)->first();
            $buckets = $aggretation['buckets'];
            $values = array();
            foreach ($buckets as $bucket) {
                $field_val = FieldValue::where('slug', $bucket['key'])->first();
                if ($field_val === null) {
                    if (!isset($bucket['from'])) {
                        $fval = new FieldValue;
                        $fval->field_id = $field->id;
                        $fval->slug = $bucket['key'];
                        $fval->save();
                    } else {
                        $filter = Filter::where('from_int', $bucket['from'])->where('to_int', $bucket['to'])->first();
                        $filter->count = $bucket['doc_count'];
                        if(isset($input[$key])&&$input[$key]===$filter->key){
                            $filter->selected = 1;

                        }else{
                            $cinput = $input;
                            $cinput[$key]=$filter->key;
                            $filter->url = $parts[0].'?'.http_build_query($cinput);
                            $filter->selected = 0;
                        }
                        $values[] = $filter;
                    }


                } else {
                    if(isset($input[$key])&&$input[$key]===$field_val->slug){
                        $field_val->selected = 1;

                    }else{
                        $cinput = $input;
                        $cinput[$key]=$field_val->slug;
                        $field_val->url = $parts[0].'?'.http_build_query($cinput);
                        $field_val->selected = 0;
                    }

                    $field_val->count = $bucket['doc_count'];
                    $values[] = $field_val;
                }

            }
            $field->vals = $values;
            if(count($values)>0)
            $filters[] = $field;

        }
        $base=Category::where('parent_id',0)->get();
        $sorts = Field::where('slug','sort')->first()->filters;
        $prices = Field::where('slug','price')->first()->filters;
        $distances = [1=>'Default',2=>'+ 1 miles',3=>'+ 3 miles',5=>'+ 5 miles',10=>'+ 10 miles',15=>'+ 15 miles',30=>'+ 30 miles',50=>'+ 50 miles',75=>'+ 75 miles',100=>'+ 100 miles',1000=>'Nationwide'];
        return ['pageurl'=>$pageurl,'sorts'=>$sorts,'prices'=>$prices,'distances'=>$distances,'url'=>$request->url(),'input'=>$input,'lat'=>$lat,'lng'=>$lng,'max'=>$max,'pages'=>$pages,'total'=>$total,'page'=>$page,'category'=>$category,'products'=>$products,'breads'=>$breads,'last'=>$any,'base'=>$base,'chs'=>$chs,'filters'=>$filters];
    }
    public function search(Request $request,$any){
        $category = Category::where('slug',$any)->first();
        $params = $this->filter($request,$category);
        return View('market.listing',$params);
    }

}
