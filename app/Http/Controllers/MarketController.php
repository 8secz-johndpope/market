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
use App\Model\Location;
use App\Model\Postcode;
use App\Model\Price;
use App\Model\Relation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
    public  function ufields(Request $request){
        $categories = Category::where('id','>=',0)->where('id','<=',899999999)->get();
        foreach ($categories as $category){
            $category->fields()->syncWithoutDetaching([10]);
        }

        return 'done';
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
    public function advert(Request $request,$id){
        // $advert = Advert::find($request->source_id);
        $advert = Advert::find($id);
        if ($advert === null) {
            $advert = Advert::where('sid', $request->id)->first();
        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic
        ];
        $response = $this->client->get($params);


        return ['advert' => $response['_source']];

    }
    public function leading($num){
        if($num%10!==0){
            return $num;
        }else{
            return $this->leading($num/10);
        }
    }
    public function locs(Request $request){
        $locations = Location::all();

        foreach ($locations as $location) {
            if($location->parent===null){

            }
            else{
                $location->ends = $location->res + ($location->res/$this->leading($location->res)) - 1;
                $location->save();
            }
            /*
            else if($location->parent->id===0){
                $location->res= $location->id * 100000000000;
                $location->save();
            }
            else if($location->parent->parent->id===0){
                $location->res = $location->parent->res  + ($location->id-$location->parent->children()->first()->id+1)*1000000000;
                $location->save();
            }
            else if($location->parent->parent->parent->id===0){
                $location->res = $location->parent->res + ($location->id-$location->parent->children()->first()->id+1)*1000000;
                $location->save();
            }
            else if($location->parent->parent->parent->parent->id===0){
                $location->res = $location->parent->res + ($location->id-$location->parent->children()->first()->id+1)*10000;
                $location->save();
            }
            else if($location->parent->parent->parent->parent->parent->id===0){
                $location->res = $location->parent->res + ($location->id-$location->parent->children()->first()->id+1)*100;
                $location->save();
            }
            else if($location->parent->parent->parent->parent->parent->parent->id===0){
                $location->res = $location->parent->res + ($location->id-$location->parent->children()->first()->id+1)*1;
                $location->save();
            }
            */
        }
    }
    public function loc(Request $request){
        /*
        $locations = Location::where('max_lng',0)->get();
        foreach ($locations as $location){
            $text = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=$location->slug+UK&key=AIzaSyA3U46iw-NKjDuNR2XjEeQJFB3sXfnKuo0");
            $json = json_decode($text,true);

            if(isset($json['results'][0]['geometry']['viewport'])) {
                print_r($json['results'][0]['geometry']['viewport']);
                $location->min_lat = $json['results'][0]['geometry']['viewport']['southwest']['lat'];
                $location->min_lng = $json['results'][0]['geometry']['viewport']['southwest']['lng'];
                $location->max_lat = $json['results'][0]['geometry']['viewport']['northeast']['lat'];
                $location->max_lng = $json['results'][0]['geometry']['viewport']['northeast']['lng'];
                $location->save();
            }else{
               // print_r($json);
               // exit;
            }
        }

*/
/*
        $i=1;
        foreach(file('/home/anil/market/public/loc_rel') as $line) {
            // loop with $line for each line of yourfile.txt
            $parts = explode(',',trim($line));
            $parent = Location::where('slug',$parts[0])->first();
            $child = Location::where('slug',$parts[1])->first();
            if($parent->id>5000){
                $parent->id=$i;
                $i++;
            }
            if($child->id>5000){
                $child->id=$i;
                $i++;
            }

            if($child->id!==$parent->id){
                $child->parent_id = $parent->id;
                $child->save();
            }


            echo  $line.'<br>';
        }
*/

      //  $locations = Location::where('parent_id',0)->get();
        $locations = Location::whereRaw('id%1000000000=0')->get();//where('id','>',100000)->whereRaw('id%1000=0')->whereRaw('id%1000000!=0')->whereRaw('id%1000000000!=0')->get();
        foreach ($locations as $location){

            $children = $location->children;
           // $location->id=$location->id*1000000000000;
          //  $location->save();
            $i = 1;
            foreach ($children as $child){
              //  $child->parent_id=$location->id;
                //$child->save();
                $newid = $location->id+$i*1000000;
                Location::where('parent_id',$child->id)->update(['parent_id'=>$newid]);
                $child->id = $newid;
                $child->save();
                $i++;
            }
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
                return ['value'=>strtolower($text).' in <span class="bold-category">'.$category->title.'</span>','category' => $category->title,'slug' => $category->slug,'data'=>$category->id,'val'=>strtolower($text)];
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
    public function lsuggest(Request $request)
    {

        $term = $request->q;
        $locations = Location::where('title','like',$term.'%')->get();
        $cats = [];
        foreach ($locations as $a){
            $cats[]= ['value'=>$a->title,'category' => $a->title,'slug' => $a->slug,'data'=>$a->id];
        }
       // $a = Postcode::where('hash',crc32(strtoupper($term)))->first();
        $locations = Postcode::where('active',1)->where('postcode','like',$term.'%')->get();

        foreach ($locations as $a){
            $cats[]= ['value'=>$a->postcode,'category' => $a->postcode,'slug' => strtolower($a->postcode),'data'=>$a->id];

        }
        return ['text'=>$term,'suggestions'=>$cats];

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
    public function locations(Request $request){
        $base = Location::where('parent_id',0)->get();
        $categories = Location::all();
        $maps=array();
        foreach ($categories as $category){
            $category->children=$category->children;
            $maps[$category->id]=$category;
        }
        $maps['a']=Location::find(0);
        return ['base'=>$base,'locations'=>$maps];

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
                        'bool' => [
                            "must_not" => ['exists'=>['field'=>'location_id']]
                        ]
                    ]
                ]
            ];
      //  $milliseconds = round(microtime(true) * 1000);
      //  $days_7 = $milliseconds + 7*24*3600*1000;
        $response = $this->client->search($params);
            $products = array_map(function ($a) {
                $ans = $a['_source'];
                $ans['id'] = $a['_id'];
                return $ans;
            }, $response['hits']['hits']);
            foreach ($products as $product) {
                if(isset($product['location'])) {
                    $location = $product['location'];
                    $parts = explode(',', $location);
                    $lat = (float)$parts[0];
                    $lng = (float)$parts[1];
                    $loc = Location::where('min_lat','<=',$lat)->where('max_lat','>=',$lat)->where('min_lng','<=',$lng)->where('max_lng','>=',$lng)->orderBy('product')->first();
                    if($loc!==null) {
                        $params = [
                            'index' => 'adverts',
                            'type' => 'advert',
                            'id' => $product['id'],
                            'body' => [
                                'doc' => [
                                    'location_id' => $loc->res,
                                ]
                            ]
                        ];

// Update doc at /my_index/my_type/my_id
                        $response = $this->client->update($params);
                        print_r($response);
                    }
                }

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
        return View('welcome',['base' => $all, 'spotlight' => $products]);
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
	    $image = 'noimage.png';
        if(count($product['images'])>0){
            $image = $product['images'][0];
            $images = array_slice($product['images'],1);
        }else{
            $images = [];
        }

        $latlng = $product['location'];
        $latlng=explode(',',$latlng);

        $meta = $product['meta'];
        $metas = array();
        foreach ($meta as $key => $value){
            $field = Field::where('slug',$key)->first();
            if($field!==null&&$key!=='price'){
                if(is_numeric($value)){
                    $field->value = $value;
                }else{
                    $fval = FieldValue::where('slug',$value)->first();
                    if($fval!==null){
                        $field->value = $fval->title;
                    }else{
                        $field->value = $value;
                    }
                }
                $metas[]=$field;
            }
        }
        $category= Category::find($product['category']);

        $rec = $category;
        while ($rec->parent_id!=-1){
            $rec = $rec->parent;
            $parents[] = $rec;
        }
        $parents=array_reverse($parents);
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
                            'gte'=>$category->id,
                            'lte'=>$category->ends
                        ]
                    ]]
                    ]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);


        return View('market.product',['product'=>$product,'products'=>$products,'image'=>$image,'images'=>$images,'counts'=>range(1,count($images)),'metas'=>$metas,'parents'=>$parents,'category'=>$category,'lat'=>$latlng[0],'lng'=>$latlng[1]]);
    }
    public function index(Request $request){
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
                'query' =>
                    ['bool'=>[

                        'should'=>[['term'=>['spotlight'=>1]]],
                        "minimum_should_match" => -2,
      "boost" => 1.0

                    ]],
                "sort"=> [
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]]


            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => 0,
                'size'=> 24,
                'query' => ['match_all'=>(object)[]],
                "sort"=> [
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]]


            ]
        ];
        $response = $this->client->search($params);
       $alls = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $products=array_merge($products,$alls);

        return view('home',['base' => $all, 'spotlight' => $products,'input'=>[],'lat'=>0.00,'lng'=>0.00,'category'=>Category::find(0),'location'=>Location::find(0)]);
       // return redirect('all');
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
        $location=Location::find(0);
        return $this->filter($request,$category,$location);

    }
    public function filter($request,$category,$location){
        if($request->has('min_lat')){
            $location->min_lat = (double)$request->min_lat;
            $location->min_lng =(double) $request->min_lng;
            $location->max_lat = (double)$request->max_lat;
            $location->max_lng =(double) $request->max_lng;
        }
            $any = $category->slug;
        $fields = $category->fields()->where('can_filter',1)->get();
        $input = $request->all();

        $aggs=array();

        if(count($category->children)>0){
            $ranges = array();
            foreach ($category->children as $cat){
                $ranges[] = ['from'=>$cat->id,'to'=>$cat->ends];
            }
            $aggs['category']=['range'=>['field'=>'category','ranges'=>$ranges]];
        }
        if(count($location->children)>0){
            $ranges = array();
            foreach ($location->children as $cat){
                $ranges[] = ['from'=>$cat->res,'to'=>$cat->ends];
            }
            $aggs['location_id']=['range'=>['field'=>'location_id','ranges'=>$ranges]];
        }

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
        $musts['lat']= [
            'range' => [
                'lat' => [
                    'gte'=>$location->min_lat,
                    'lte'=>$location->max_lat
                ]
            ]
        ];
        $musts['lng']= [
            'range' => [
                'lng' => [
                    'gte'=>$location->min_lng,
                    'lte'=>$location->max_lng
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
                "distance" => "50mi",
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
            /*
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
            */
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
                            /*    'filter' => $filte */
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
                   /*     'filter' => $filte */
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
                $aggretations[$a]=$b;}
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


        $categories = array();
        $parents = array();
        if(count($category->children)>0) {
            $buckets = $aggretations['category']['buckets'];
            foreach ($buckets as $bucket) {
                $cat = Category::find($bucket['from']);
                $cat->count = $bucket['doc_count'];
                if ($cat->parent_id == $category->id)
                    $categories[] = $cat;
            }
        }
        $locs = array();

        if(count($location->children)>0) {
            $buckets = $aggretations['location_id']['buckets'];
            foreach ($buckets as $bucket) {
                $loc = Location::where('res',$bucket['from'])->first();
                if($loc!==null){
                    $loc->count = $bucket['doc_count'];
                    if ($loc->parent_id == $location->id)
                        $locs[] = $loc;
                }

            }
        }
        $rec = $category;
        while ($rec->parent_id!=-1){
            $rec = $rec->parent;
            $parents[] = $rec;
        }
        $rec = $location;
        $lparents=array();
        while($rec->parent_id!=-1){
            $rec = $rec->parent;
            $lparents[]=$rec;
        }
        $parents=array_reverse($parents);
        $lparents=array_reverse($lparents);
        unset($aggretations['category']);
        unset($aggretations['location_id']);

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

        $fmusts = $musts;
        $fmusts['featured'] = ['term'=>['featured'=>1]];
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>2,
                'query' => [
                    'bool' => [
                        'must' => array_values($fmusts),
                   /*     'filter' => $filte */
                    ]
                ],
                "sort"=> [["featured_count"=> ["order"=> "asc"]]]
            ]
        ];
        $response = $this->client->search($params);

        $featured = array_map(function ($a) use ($milliseconds){
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
            $a['_source']['_id'] = $a['_id'];
            return $a['_source'];
            },$response['hits']['hits']);

        foreach ($featured as $fet){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $fet['_id'],
                'body' => [
                    'script' => 'ctx._source.featured_count += 1'
                ]
            ];

// Update doc at /my_index/my_type/my_id
              $this->client->update($params);
        }

/*
        $fmusts = $musts;
        $fmusts['urgent'] = ['term'=>['urgent'=>1]];
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>1,
                'query' => [
                    'bool' => [
                        'must' => array_values($fmusts),
                        'filter' => $filte
                    ]
                ],
                "sort"=> [["urgent_count"=> ["order"=> "asc"]]]
            ]
        ];
        $response = $this->client->search($params);

        $urgent = array_map(function ($a) use ($milliseconds) {
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
            $a['_source']['_id'] = $a['_id'];
            return $a['_source']; },$response['hits']['hits']);
        foreach ($urgent as $fet){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $fet['_id'],
                'body' => [
                    'script' => 'ctx._source.urgent_count += 1'
                ]
            ];

// Update doc at /my_index/my_type/my_id
            $this->client->update($params);
        }
*/
        $products = array_merge($featured,$products);

        $distances = [1=>'Default',2=>'+ 1 miles',3=>'+ 3 miles',5=>'+ 5 miles',10=>'+ 10 miles',15=>'+ 15 miles',30=>'+ 30 miles',50=>'+ 50 miles',75=>'+ 75 miles',100=>'+ 100 miles',1000=>'Nationwide'];
        return ['location'=>$location,'lparents'=>$lparents,'pageurl'=>$pageurl,'sorts'=>$sorts,'prices'=>$prices,'distances'=>$distances,'url'=>$request->url(),'input'=>$input,'lat'=>$lat,'lng'=>$lng,'max'=>$max,'pages'=>$pages,'total'=>$total,'page'=>$page,'category'=>$category,'products'=>$products,'breads'=>$breads,'last'=>$any,'base'=>$base,'chs'=>$chs,'filters'=>$filters,'categories'=>$categories,'parents'=>$parents,'locs'=>$locs];
    }
    public function search(Request $request,$any){
        $category = Category::where('slug',$any)->first();
        if($category===null){
            return View('notfound');
        }
        $location = Location::find(0);
        $params = $this->filter($request,$category,$location);
        if (Auth::check()) {
            // The user is logged in...
            $user = $request->user();
           // $favorites = $user->favs;
            $favorites = $user->favorites;
            $sids = array();
            foreach ($favorites as $favorite){
                $sids[] = $favorite->sid;
            }
            $params['sids']=$sids;
        }else{
            $params['sids']=[];
        }
        //return View('market.listings',$params);
        return View('market.listingsrow',$params);
    }
    public function notfound(){
        return View('notfound');
    }
    public function lsearch(Request $request,$any,$loc){
        $category = Category::where('slug',$any)->first();
        if($category===null){
            return View('notfound');
        }

        $location = Location::where('slug',$loc)->first();
        if($location===null) {
            $postcode = Postcode::where('postcode', strtoupper($loc))->first();

            if ($postcode === null) {
                return View('notfound');
            }else{
                $location = $postcode->location;
            }
        }
        $params = $this->filter($request,$category,$location);
        if (Auth::check()) {
            // The user is logged in...
            $user = $request->user();
            // $favorites = $user->favs;
            $favorites = $user->favorites;
            $sids = array();
            foreach ($favorites as $favorite){
                $sids[] = $favorite->sid;
            }
            $params['sids']=$sids;
        }else{
            $params['sids']=[];
        }
        //return View('market.listings',$params);
        return View('market.listingsrow',$params);
    }
    public function hellosign(Request $request){
        return " Hello API Event Received";
    }
    public function searchform(Request $request){
        $loc = $request->slug;
        $cat = $request->search_category;
        $q = $request->q;
        if(strlen($q)==0)
        {
            return redirect('/'.$cat.'/'.$loc);
        }
        return redirect('/'.$cat.'/'.$loc.'?q='.$q);
    }
    public function wrong(Request $request){
        $postcodes = Postcode::where('active',1)->where('location_id',0)->limit(10000)->get();
      //  $postcodes = [Postcode::find(2148380)];
        foreach ($postcodes as $postcode){
            $location = Location::where('min_lat','<=',$postcode->lat)->where('max_lat','>=',$postcode->lat)->where('min_lng','<=',$postcode->lng)->where('max_lng','>=',$postcode->lng)->orderBy('product')->first();
            if($location!==null) {
                echo $postcode->id . '<br>';
                echo $location->title . '<br>';
                $postcode->location_id = $location->id;
                $postcode->save();
            }

        }

        return ['a'=>'b'];
    }
}
