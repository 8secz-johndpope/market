<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 14/07/2017
 * Time: 18:28
 */

namespace App\Http\Controllers;
//6Le7jzMUAAAAAMxPpgAuCziF-HIcL63FBbvxn770
//6LfzjTMUAAAAAPvQbTC0I6m9Ilfpd8Q3ife2Fejn

use App\Mail\InviteFriend;
use App\Model\Advert;
use App\Model\Category;
use App\Model\Field;
use App\Model\FieldValue;
use App\Model\Filter;
use App\Model\Location;
use App\Model\Postcode;
use App\Model\Price;
use App\Model\Relation;
use App\Model\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Model\Categories;
use App\Model\Invoice;
use App\Model\InvoiceItem;
use App\Model\Business;
use Illuminate\Support\Facades\Mail;

class MarketController extends BaseController
{
    public function more(Request $request,$id){
    $category = Category::find($id);
    if(count($category->children)>0){
        $j = 0;
        $base = Category::where('parent_id',0)->get();

        $all=array();
        foreach ($base as $cat) {
            $cat->class = "category-$j";
            $cat->children= $cat->mchildren;
            $all[]=$cat;
            $j++;
        }
        return view('market.more',['base'=>$base,'category'=>$category,'input'=>[],'location'=>Location::find(0)]);
    }else{
        return redirect($category->slug);
    }
}
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
    public function gitpull(Request $request){
        exec(' /home/anil/gitpull 2>&1',$output);
       return $output;
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
            'id' => $advert->elastic,
            'body' => [
                'script' => 'ctx._source.views += 1'

            ]
        ];
        $this->client->update($params);

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic
        ];
        $response = $this->client->get($params);
        if(!$response['_source']['username'])
        $response['_source']['username']=$advert->user->name;

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

        $user=User::find(104);
        $acc = new InviteFriend();
        $acc->referral_code=$user->referral_code;
        $acc->name = $user->name;
        Mail::to($user)->send($acc);


        /*
        $fields=FieldValue::all();
        foreach ($fields as $field){
            $field->title=ucwords(str_replace('-',' ',$field->slug));
            $field->save();
        }
        $price = new Price;
        $price->location_id=1931;
        $location=$price->location;
        $price->category_id=0;
        return count($location->postcodes);

        $locations = Location::all();

        foreach ($locations as $location) {
            if($location->parent===null){

            }

            else{
                $location->ends = $location->res + ($location->res/$this->leading($location->res)) - 1;
                $location->save();
            }


            else if($location->parent->id===0){
                $location->res1= $location->id * 100000000000;
                $location->save();
            }
            else if($location->parent->parent->id===0){
                $count = count(Location::where('parent_id',$location->parent->id)->whereBetween('id',[$location->parent->children()->first()->id,$location->id])->get());
                $location->res1 = $location->parent->res1  + ($count)*1000000000;
                $location->save();
            }
            else if($location->parent->parent->parent->id===0){
                $count = count(Location::where('parent_id',$location->parent->id)->whereBetween('id',[$location->parent->children()->first()->id,$location->id])->get());

                $location->res1 = $location->parent->res1 + ($count)*1000000;
                $location->save();
            }
            else if($location->parent->parent->parent->parent->id===0){
                $count = count(Location::where('parent_id',$location->parent->id)->whereBetween('id',[$location->parent->children()->first()->id,$location->id])->get());

                $location->res1 = $location->parent->res1 + ($count)*10000;
                $location->save();
            }
            else if($location->parent->parent->parent->parent->parent->id===0){
                $count = count(Location::where('parent_id',$location->parent->id)->whereBetween('id',[$location->parent->children()->first()->id,$location->id])->get());

                $location->res1 = $location->parent->res1 + ($count)*100;
                $location->save();
            }
            else if($location->parent->parent->parent->parent->parent->parent->id===0){
                $count = count(Location::where('parent_id',$location->parent->id)->whereBetween('id',[$location->parent->children()->first()->id,$location->id])->get());

                $location->res1 = $location->parent->res1 + ($count)*1;
                $location->save();
            }


        }
*/
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
        if(isset($response['suggest']['search-suggest'][0]['options'][0]['text'])) {
            $text = $response['suggest']['search-suggest'][0]['options'][0]['text'];
        }else{
            $text = $term;
        }
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
        $locations = Location::where('title','like',$term.'%')->limit(10)->get();
        $cats = [];
        foreach ($locations as $a){
            $cats[]= ['value'=>$a->title,'category' => $a->title,'slug' => $a->slug,'data'=>$a->id, 'location'=>$a,'type'=>'location','parent'=>$a->parent];
        }
       // $a = Postcode::where('hash',crc32(strtoupper($term)))->first();
        $locations = Postcode::where('active',1)->where('postcode','like',$term.'%')->limit(10)->get();

        foreach ($locations as $a){
            $cats[]= ['value'=>$a->postcode.', '.$a->location->title,'category' => $a->postcode,'slug' => strtolower($a->postcode),'data'=>$a->location->id,'location'=>$a->location,'type'=>'postcode'];

        }

        return ['text'=>$term,'suggestions'=>$cats];

    }
    public function psuggest(Request $request)
    {

        $term = $request->q;
        $cats = [];

        // $a = Postcode::where('hash',crc32(strtoupper($term)))->first();
        $locations = Postcode::where('active',1)->where('postcode','like',$term.'%')->limit(10)->get();

        foreach ($locations as $a){
            $cats[]= ['value'=>$a->postcode.', '.$a->location->title,'category' => $a->postcode,'slug' => strtolower($a->postcode),'data'=>$a->location->id];

        }

        return ['text'=>$term,'suggestions'=>$cats];

    }
    public function autosuggest(Request $request)
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
        if(isset($response['suggest']['search-suggest'][0]['options'][0]['text'])) {
            $text = $response['suggest']['search-suggest'][0]['options'][0]['text'];
        }else{
            $text = $term;
        }
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
                    return ['value'=>strtolower($text),'category' => $category];
            }, $bts);
            return ['text'=>$text,'suggestions'=>$cats];





    }
    public  function id(Request $request,$id){
        return $this->categories[$id];
    }
    public function categories(Request $request){


        return Category::all();

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



            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size' => 10000,
                    'query' => [
                        'bool' => [
                            "must" => ['term' => [
                                'phone' => '07788778877'
                            ]]
                        ]
                    ]

                ]
            ];
            $response = $this->client->search($params);
            $products = $response['hits']['hits'];

            foreach ($products as $product) {

                        $params = [
                            'index' => 'adverts',
                            'type' => 'advert',
                            'id' => $product['_id'],
                            'body' => [
                                "script" => "ctx._source.remove('phone')"
                            ]
                        ];
                        //  $advert = Advert::where('sid',(int)$product['source_id'])->first();
                        // $advert->user_id=(int)$product['user_id'];
                        //$advert->save();

// Update doc at /my_index/my_type/my_id
                        $response = $this->client->update($params);






            }
        

/*
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size' => 10000,
                'query' => [
                    'bool' => [
                        "must" => ['range'=>["location_id"=>['lte'=>4000]]]
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
            $location = Location::find($product['location_id']);
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $product['id'],
                'body' => [
                    'doc' => [
                        'location_id' => $location->res

                    ]
                ]
            ];

// Update doc at /my_index/my_type/my_id
            $response = $this->client->update($params);
        }
        */
/*
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
*/
            return ['a'=>'b'];
        }

    public function updates(Request $request){

        $locations = Location::whereRaw('res!=res1')->get();
      //  return $locations;
        foreach ($locations as $location){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size' => 10000,
                    'query' => [
                        "term" => ["location_id"=>$location->res]
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
            print count($products);
            foreach ($products as $product) {

                        $params = [
                            'index' => 'adverts',
                            'type' => 'advert',
                            'id' => $product['id'],
                            'body' => [
                                'doc' => [
                                    'location_id' => $location->res1,
                                ]
                            ]
                        ];

// Update doc at /my_index/my_type/my_id
                        $response = $this->client->update($params);
                        print_r($response);


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

        $advert= Advert::find($sid);
        if($advert===null){
            $advert= Advert::where('sid',$sid)->first();

        }
        if($advert->category_id===0){
            $advert->category_id=$cat;
            $advert->save();
        }
        $similar = $advert->similar();
        $similarUnder =  $advert->similarUnderPrice();
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic
        ];
        $response = $this->client->get($params);


        $product=$response['_source'];

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $advert->elastic,
            'body' => [
                    'script' => 'ctx._source.views += 1'

            ]
        ];
        $this->client->update($params);



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
            if($field!==null&&$key!=='price' && $key!='key_features' && $key !='property_floorplan' && $key != 'property_tenure'){
                if(is_numeric($value)){
                    if($key === 'available_date'){
                        //TODO compare with today and write NOW
                        $field->value = date('d F Y', $value / 1000);
                    }
                    else{
                        $field->value = $value;
                    }
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
        $parents = array();
        $category = $advert->category;
        if(isset($category)){
            $rec = $category;
            while ($rec->parent_id!=-1){
                $rec = $rec->parent;
                $parents[] = $rec;
            }
            $parents=array_reverse($parents);
        }
        /*$params = [
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
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);*/
        $products = $advert->similar();
        $view = 'market.product';
        //Changed of view for property view
        $srn = false;
        if($request->has('srn'))
            $srn=true;

        if($advert->category->is_property()){
            $view = 'market.property'; 
        }
        elseif($advert->category->can_apply()){
            $view = 'market.job';
            $base = Category::where('parent_id',0)->get();
            $next = $advert->nextAdvert();
            $prev = $advert->prevAdvert();
            return View($view, ['srn'=>$srn,'advert'=>$advert,'product'=>$product,'products'=>$products,'image'=>$image,'images'=>$images,'counts'=>range(1,count($images)),'metas'=>$metas,'parents'=>$parents,'category'=>$category,'lat'=>$latlng[0],'lng'=>$latlng[1], 'similar' => $similar, 'similarUnder' => $similarUnder, 'input' => [], 'location'=>Location::find(0), 'base' => $base, 'nextAdvert' => $next, 'prevAdvert' => $prev]);
        }
        elseif($advert->category->can_ship() || ($advert->category_id >= 7010000000 && $advert->category_id <= 7029999999)){
            $view = 'market.for-sale';
        }
        elseif($advert->category_id >= 5000000000 && $advert->category_id <= 7999999999){
            $view = 'market.community';
        }
        elseif($advert->category_id >= 1050000000 && $advert->category_id <= 1059999999){
            $advert->priceType = $this->priceType($product);
            $view = 'market.cars';
        }
        return View($view, ['srn'=>$srn,'advert'=>$advert,'product'=>$product,'products'=>$products,'image'=>$image,'images'=>$images,'counts'=>range(1,count($images)),'metas'=>$metas,'parents'=>$parents,'category'=>$category,'lat'=>$latlng[0],'lng'=>$latlng[1], 'similar' => $similar, 'similarUnder' => $similarUnder]);
    }
    private  function haversineGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $latDelta = $latTo - $latFrom;
        $lonDelta = $lonTo - $lonFrom;

        $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
                cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
        return 0.000621371*$angle * $earthRadius;
    }
    public function can_deliver(Request $request,$id){
        $advert=Advert::find($id);
        $postcode = Postcode::where('postcode',strtoupper(str_replace(' ','',$request->postcode)))->first();
        $distance = $this->haversineGreatCircleDistance($advert->postcode->lat,$advert->postcode->lng,$postcode->lat,$postcode->lng);
        $max = $advert->meta('distance');
        if($distance<=$max){
            return ['can'=>true,'distance'=>$distance];
        }
        else{
            return ['can'=>false,'distance'=>$distance];
        }

    }
    public function index(Request $request){
        //$base = Category::where('parent_id',0)->get();
        //Need  chande de response is not search client
        $mustnot = [['exists'=>['field'=>'inactive']],['exists'=>['field'=>'draft']],['exists'=>['field'=>'sold']]];

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
                        'must_not'=>[['exists'=>['field'=>'inactive']],['exists'=>['field'=>'draft']]],

                        'must'=>['exists'=>['field'=>'meta']],
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
        $sids = array_map(function ($a) { return $a['source_id']; },$products);

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => 0,
                'size'=> 24,
                'query' =>
                    ['bool'=>[
                        'must_not'=>[['exists'=>['field'=>'inactive']],['exists'=>['field'=>'draft']],['terms'=>['source_id'=>$sids]]],


                    ]],
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
        $categories = Category::all();
        foreach ($categories as $category){
            if(count($category->children)===0){
                if(!$category->can_apply())
                echo $category->slug.'<br>';
            }
        }
        return '';
    }
    public function lleaves(Request $request){
        $categories = Location::all();
        foreach ($categories as $category){
            if(count($category->children)===0){
                echo $category->slug.'<br>';
            }
        }
        return '';
    }


    public function error(Request $request){
        return ['msg'=>'No route found'];
    }
    public function query(Request $request){

        $category = Category::find($request->category);
        if(!$request->has('location_id'))
        $location=Location::find(0);
        else
            $location=Location::find($request->location_id);

        return $this->filter($request,$category,$location);

    }
    public function spotlight(Request $request){
        $mustnot = [['exists'=>['field'=>'inactive']],['exists'=>['field'=>'draft']]];
        $milliseconds = round(microtime(true) * 1000);
        if($request->has('id'))
        $location=Location::find($request->id);
        else
            $location=Location::find(0);
        $musts['location_id']= [
            'range' => [
                'location_id' => [
                    'gte'=>$location->res,
                    'lte'=>$location->ends
                ]
            ]
        ];
        $fmusts = $musts;
        $fmusts['spotlight'] = ['term'=>['spotlight'=>1]];
        $fmusts['spotlight_expires'] = ['range'=>['spotlight_expires'=>['gte'=>$milliseconds]]];

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>15,
                'query' => [
                    'bool' => [
                        'must' => array_values($fmusts),
                        'must_not' => $mustnot
                        /*     'filter' => $filte */
                    ]
                ],
                "sort"=> [["spotlight_count"=> ["order"=> "asc"]]]
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
            $a['_source']['featured_x']=1;
            $a['_source']['_id'] = $a['_id'];
            return $a['_source'];
        },$response['hits']['hits']);
        return ['adverts'=>$featured];
    }
    public function aggs(Request $request){
        $location = Location::find($request->location_id);
        $musts['location_id']= [
            'range' => [
                'location_id' => [
                    'gte'=>$location->res,
                    'lte'=>$location->ends
                ]
            ]
        ];

        $aggs=array();

            $ranges = array();
            foreach (Category::all() as $cat){
                $ranges[] = ['from'=>$cat->id,'to'=>$cat->ends];
            }
        $aggs['category']=['range'=>['field'=>'category','ranges'=>$ranges]];
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size' => 0,
                'query' => [
                    'bool' => [
                        'must' => array_values($musts),
                        /*    'filter' => $filte */
                    ]
                ],
                'aggs' => ['category' => $aggs['category']]

            ]
        ];
        if($location->id===0 || $location->parent_id===0 ){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size' => 0,
                    'query' => [
                        'bool' => [
                            'must' => array_values($musts),
                            /*    'filter' => $filte */
                        ]
                    ],
                    'aggs' => ['category' => $aggs['category']]

                ]
            ];
        }else{
            $center = (($location->min_lat+$location->max_lat)/2).','.(($location->min_lng+$location->max_lng)/2);
            $distance = Location::haversineGreatCircleDistance($location->min_lat,$location->min_lng,$location->max_lat,$location->max_lng)+$request->distance;
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size' => 0,
                    'query' => [
                        'bool' => [
                                'filter' => ['geo_distance'=>['distance'=>$distance.'mi','location'=>$center]]
                        ]
                    ],
                    'aggs' => ['category' => $aggs['category']]

                ]
            ];

        }
        $response = $this->client->search($params);
        $buckets = $response['aggregations']['category']['buckets'];
        foreach ($buckets as $bucket) {
            $cat = Category::find($bucket['from']);
            $cat->count = number_format( $bucket['doc_count']);
            $categories[$cat->id] = $cat->count ;
        }
        return $categories;

    }
    public function total(Request $request){
        $location = Location::find(0);
        $musts['location_id']= [
            'range' => [
                'location_id' => [
                    'gte'=>$location->res,
                    'lte'=>$location->ends
                ]
            ]
        ];


        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size' => 0,
                'query' => [
                    'bool' => [
                        'must' => array_values($musts),
                        /*    'filter' => $filte */
                    ]
                ]

            ]
        ];
        $response = $this->client->search($params);

        return ['total'=>number_format($response['hits']['total'])];

    }
    public function filter($request,$category,$location){
        $lat = ($location->min_lat+$location->max_lat)/2;
        $lng = ($location->min_lng+$location->max_lng)/2;
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

        $musts['category']= [
            'range' => [
                'category' => [
                    'gte'=>$category->id,
                    'lte'=>$category->ends
                ]
            ]
        ];

        $mustnot = [['exists'=>['field'=>'inactive']],['exists'=>['field'=>'draft']],['exists'=>['field'=>'sold']]];
        $musts['location_id']= [
            'range' => [
                'location_id' => [
                    'gte'=>$location->res,
                    'lte'=>$location->ends
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
                'match_phrase' => [
                    'title'=>$request->q
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
                                'must_not' => $mustnot
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
        $pagesize = 25;
        $sort = [
            [
                "created_at"=> ["order"=> "desc"]
            ],
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
            ]
        ];
        if($request->has('sort')){
            $skey = $request->sort;
            if($skey==='distance'){

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
                        'must_not' => $mustnot
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
            if($a['_source']['category'] == 1050000000){
                $a['_source']['price_type'] = $this->priceType($a['_source']);
            }
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
                $cat->count = number_format( $bucket['doc_count']);
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
                    $loc->count = number_format( $bucket['doc_count']);
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
                        $filter->count = number_format( $bucket['doc_count']);
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

                    $field_val->count = number_format(  $bucket['doc_count']);
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
        $fmusts['featured_expires'] = ['range'=>['featured_expires'=>['gte'=>$milliseconds]]];

        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>3,
                'query' => [
                    'bool' => [
                        'must' => array_values($fmusts),
                        'must_not' => $mustnot
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
            $a['_source']['featured_x']=1;
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

        foreach ($products as $fet){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'id' => $fet['_id'],
                'body' => [
                    'script' => 'ctx._source.list_views += 1'
                ]
            ];

// Update doc at /my_index/my_type/my_id
            $this->client->update($params);
        }
        $distances = [1=>'Default',2=>'+ 1 miles',3=>'+ 3 miles',5=>'+ 5 miles',10=>'+ 10 miles',15=>'+ 15 miles',30=>'+ 30 miles',50=>'+ 50 miles',75=>'+ 75 miles',100=>'+ 100 miles',1000=>'Nationwide'];
        return ['location'=>$location,'lparents'=>$lparents,'pageurl'=>$pageurl,'sorts'=>$sorts,'prices'=>$prices,'distances'=>$distances,'url'=>$request->url(),'input'=>$input,'max'=>$max,'pages'=>$pages,'total'=>$total,'page'=>$page,'category'=>$category,'products'=>$products,'breads'=>$breads,'last'=>$any,'base'=>$base,'chs'=>$chs,'filters'=>$filters,'categories'=>$categories,'parents'=>$parents,'locs'=>$locs];
    }
    public function search(Request $request,$any){
        return redirect('/'.$any.'/uk');

    }
    public function notfound(){
        return View('notfound');
    }
    public function lsearch(Request $request,$any,$loc){
        $category = Category::where('slug',$any)->first();
        if($category===null){
            return View('notfound');
        }
        $postcode=null;
        //check if it is listing for template and set loc with london
        $location = Location::where('slug',$loc)->first();
        if($location===null) {
            $postcode = Postcode::where('postcode', strtoupper($loc))->first();

            if ($postcode === null) {
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
        if($postcode===null)
            $params['type']='location';
        else
        {
            $params['type']='postcode';
            $params['postcode']=$postcode;
        }
        $milliseconds = round(microtime(true) * 1000);
        $params['milli']=$milliseconds;
/*
        $adverts = [];
        $products = $params['products'];
        foreach ($products as $product){
            $advert = Advert::find($product['source_id']);
            if ($advert === null) {
                $advert = Advert::where('sid', $product['source_id'])->first();
            }
            $advert->dict=$product;
            $adverts[]=$advert;
        }

        $params['adverts']=$adverts;
*/
        //return View('market.listings',$params);

        return View('market.listingsrow',$params);
    }
    public function hellosign(Request $request){
        return " Hello API Event Received";
    }
    public function userads(Request $request, $id){
        $sids = array();
        if (Auth::check()) {
            // The user is logged in...
            $user = $request->user();
            // $favorites = $user->favs;
            $favorites = $user->favorites;
            foreach ($favorites as $favorite){
                $sids[] = $favorite->sid;
            }
        }
        return view('market.profile',['advertiser'=>User::find($id), 'sids'=> $sids]);
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
    public function gads(Request $request){
        $adverts = Advert::where('user_id',0)->where('covered',0)->orderBy('id','desc')->limit(1000)->get();
        $ids = [];
        foreach ($adverts as $advert){
            $ids[]=$advert->sid;
            $advert->covered=1;
            $advert->save();
        }

        return $ids;
    }
    public function ast(Request $request,$p,$q){
        $advert= Advert::where('sid',$p)->first();
        if($advert->elastic===null)
            return ['c'=>'d'];
        if($advert->user===null){
            return ['c'=>'d'];

        }
        $rem = Advert::where('sid',$q)->first();
        if($rem!==null&&$advert->user!==null){
            $rem->user_id=$advert->user->id;
            $rem->save();
        }

        return ['a'=>'b'];
    }
    public function allfields(Request $request){
        $fields = Field::all();
        foreach ($fields as $field)
            echo "'".$field->slug."',";
    }
    public function agent(Request $request, $id){
        $user = User::find($id);
        $advertsForsale = $user->adverts_category(306000000);
        $advertsForRent = $user->adverts_category(307000000);
        $avgPriceSale = 0;
        $avgPriceRent = 0;
        foreach ($advertsForsale as $advert) {
            $avgPriceSale += $advert->price();
        }
        foreach ($advertsForRent as $advert) {
            $price = $advert->price();
            if($advert->meta('price_frequency') === 'pw'){
                $price = $price * 4; 
            }
            $avgPriceRent += $price;
        }
        if($avgPriceSale > 0){
            $avgPriceSale = $avgPriceSale / count($advertsForsale);
        }
        if($avgPriceRent > 0){
            $avgPriceRent = $avgPriceRent / count($advertsForRent);
        }
        $postcode = null;
        if(isset($user->business)){
            $postcode = $user->business->address->zip;
        }
        return view('market.agent', ['user'=>User::find($id), 'postcode' => $postcode, 'advertsForsale' => $advertsForsale, 'avgPriceSale' => $avgPriceSale, 'advertsForRent' => $advertsForRent, 'avgPriceRent' => $avgPriceRent]);
    }
    public function company(Request $request, $id){
        $user = User::find($id);
        $advertsForsale = $user->adverts_category(306000000);
        $advertsForRent = $user->adverts_category(307000000);
        $avgPriceSale = 0;
        $avgPriceRent = 0;
        foreach ($advertsForsale as $advert) {
            $avgPriceSale += $advert->price();
        }
        foreach ($advertsForRent as $advert) {
            $price = $advert->price();
            if($advert->meta('price_frequency') === 'pw'){
                $price = $price * 4; 
            }
            $avgPriceRent += $price;
        }
        if($avgPriceSale > 0){
            $avgPriceSale = $avgPriceSale / count($advertsForsale);
        }
        if($avgPriceRent > 0){
            $avgPriceRent = $avgPriceRent / count($advertsForRent);
        }
        $postcode = null;
        if(isset($user->business)){
            $postcode = $user->business->address->zip;
        }
        return view('market.company', ['user'=>User::find($id), 'postcode' => $postcode, 'advertsForsale' => $advertsForsale, 'avgPriceSale' => $avgPriceSale, 'advertsForRent' => $advertsForRent, 'avgPriceRent' => $avgPriceRent]);
    }
    public function downloadApps(Request $request){
        return view('market.downloadapp');
    }
    public function profile(Request $request, $id){
        return view('templates-profiles.profilecv');
    }
    public function payLogout(Request $request,$id){
        //$user = Auth::user();
        $invoice = Invoice::find($id);
        $user = $invoice->message->toUser;
        $seller = $invoice->message->user;
        //$stripe_id = $user->stripe_id;
        //$customer = \Stripe\Customer::retrieve($stripe_id);

        /*try{
            $cards = \Stripe\Customer::retrieve($stripe_id)->sources->all(array(
                'limit' => 10, 'object' => 'card'));
            $card = $customer->sources->retrieve($customer->default_source);
            $cards = $cards['data'];

        }catch (\Exception $exception){
            $cards = [];
            $card=null;
        }*/

        $gateway = new \Braintree\Gateway(array(
            'accessToken' => env('PAYPAL_ACCESS_TOKEN'),
        ));
        $clientToken = $gateway->clientToken()->generate();

        return view('home.pay-logout',['invoice'=>$invoice, 'seller' => $seller,'token' => $clientToken,'user'=>$user]);
    }
    public function makeContact(Request $request, $id){
        $user = User::find($id);
        return view('market.make-contact', ['user' => $user]);
    }
    public function companiesTemplate(Request $request, $id){
        $view = 'market.companies-template1';
        if($id === 'uber')
            $view = 'market.companies-template2';
        return view($view);
    }
    public function office(Request $request, $id, $office_id){
        $view = 'market.office-template1';
        if($id === 'uber' && $office_id === 'london')
            $view = 'market.office1-template2';
        elseif($id === 'uber' && $office_id === 'uber')
            $view = 'market.office2-template2';
        return view($view);
    }
    public function people(Request $request, $id, $people_id){
        $view = 'market.office-template1';
        if($id === 'uber' && $people_id === 'brian')
            $view = 'market.people1-template2';
        elseif($id === 'uber' && $people_id === 'swathy')
            $view = 'market.people2-template2';
        elseif($id === 'uber' && $people_id === 'jess')
            $view = 'market.people3-template2';
        return view($view);
    }
    public function companyJobs(Request $request, $id){
        $view = 'market.company-jobs';
        $category = Category::where('slug','jobs')->first();
        if($category===null){
            return View('notfound');
        }
        $postcode=null;
        //check if it is listing for template and set loc with london
        $location = Location::where('slug','london')->first();
        if($location===null) {
            $postcode = Postcode::where('postcode', strtoupper($loc))->first();

            if ($postcode === null) {
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
        if($postcode===null)
            $params['type']='location';
        else
        {
            $params['type']='postcode';
            $params['postcode']=$postcode;
        }
        $milliseconds = round(microtime(true) * 1000);
        $params['milli']=$milliseconds;
        return view($view, $params);
    }
    public function templateContact(Request $request){
        return view('market.template-contact');
    }
    public function templateJob(Request $request, $id){
        $view = 'market.template-job';
        if($id === 'safe-lead-uki'){
            $view = 'market.template-job-safety-lead-uki';
        }
        else if($id === 'associate-counsel-uk-ireland'){
            $view = 'market.template-job-associate-counsel-uk-ireland';
        }
        else if($id === 'head-of-compliance-uk-ireland'){
            $view = 'market.template-job-head-of-compliance-uk-ireland';
        }
        else if($id === 'senior-community-operations-manager-ubereats-uki'){
            $view = 'market.template-job-senior-community-operations-manager-ubereats-uki';
        }
        else if($id === 'enterprise-account-executive-uber-eats'){
            $view = 'market.template-job-enterprise-account-executive-uber-eats';
        }
        else if($id === 'head-of-public-policy-uk-ireland-northern-europe'){
            $view = 'market.template-job-head-of-public-policy-uk-ireland-northern-europe';
        }
        else if($id === 'public-policy-senior-associate-uk-ireland-021135'){
            $view = 'market.template-job-public-policy-senior-associate-uk-ireland-021135';
        }
        else if($id === 'senior-counsel-uki'){
            $view = 'market.template-job-senior-counsel-uki';
        }
        
        return view($view);
    }
    public function profileTemplate(Request $request, $type){
        $profileTypes = ['general', 'social-childcare', 'sub-contractor'];
        $view = "";
        if($profileTypes[0] == $type){
            $view = 'templates-profiles.general'; 
        }
        else if($profileTypes[1] == $type){
            $view = 'templates-profiles.childcare'; 
        }
        else if($profileTypes[2] == $type){
            $view = 'templates-profiles.profilecv';
        }
        return view($view);
    }
    public function priceType($product){
        if(array_key_exists('vehicle_model',$product['meta'])){
            $musts=array();
            $noMusts = array();
            $musts['meta.vehicle_model']= [
                'match' => [
                    'meta.vehicle_model' => $product['meta']['vehicle_model']
                ]
            ];
            $musts['meta.vehicle_registration_year']= [
                'match' => [
                    'meta.vehicle_registration_year' => $product['meta']['vehicle_registration_year']
                ]
            ];
            $noMusts['description'] =[
                'match' => ['description' => 'finance']
            ];
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => array_values($musts),
                            'must_not' => array_values($noMusts)
                       /*     'filter' => $filte */
                        ]
                    ]/*,
                    "sort"=> $sort*/
                ]
            ];
            $response = $this->client->search($params);
            $totalModel = $response['hits']['total'];
            if($totalModel > 10){
                $musts['meta.price']= [
                    'range' => [
                        'meta.price' => [
                            'lte'=> $product['meta']['price'] + 50000
                        ]
                    ]
                ];
                $params = [
                    'index' => 'adverts',
                    'type' => 'advert',
                    'body' => [
                        'query' => [
                            'bool' => [
                                'must' => array_values($musts),
                                'must_not' => array_values($noMusts)
                           /*     'filter' => $filte */
                            ]
                        ]/*,
                        "sort"=> $sort*/
                    ]
                ];
                $response = $this->client->search($params);
                $totalLow = $response['hits']['total'];
                if($totalLow == 1)
                    return 'price_reduced';
                elseif($totalLow < 50)
                    return 'great_price';
                elseif($totalLow < 100)
                    return 'good_price';
                else
                    return 'normal-price';
                /*var_dump($totalLow);
                $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
                return $products;*/
            }
        }
        return 'normal-price';
    }
    public function testPrices(){
        $product = array();
        $meta = array();
        $meta['vehicle_model'] = 'focus';
        $meta['vehicle_registration_year'] = '2015';
        $meta['price'] = 115000;
        $product['meta'] = $meta;
        return $this->priceType($product);

    }
    public function exploreCompanies(Request $request){
        $companies = Business::paginate(12);
        $sectors = Category::find(4000000000)->children;
        return view('market.explore-companies', ['companies' => $companies, 'sectors' => $sectors]);
    }
    public function companies(Request $request){
        $firstCompanies = Business::paginate(6);
        return view('market.companies', ['firstCompanies' => $firstCompanies]);
    }
    public function companiesSearch(Request $request, $letter=null){
        $title = 'Employers';
        $firstCompanies = Business::limit(10);
        if($letter != null){
            $companies = Business::where('name', 'REGEXP', '^['.$letter.']')->paginate(16);
        }elseif(isset($request->q)){
            $companies = Business::where('name', 'LIKE', '%'.$request->q.'%')->paginate(16);
        }
        else
            $companies = Business::paginate(16);

        return view('market.companies', ['firstCompanies' => $firstCompanies, 'companies' => $companies, 'letter' => $letter, 'q' => $request->q, 'title' => $title]);
    }
    public function recruiterSearch(Request $request, $letter=null){
        $firstCompanies = Business::paginate(12);
        $title = 'Recruiters';
        if($letter != null){
            $companies = Business::where('name', 'REGEXP', '^['.$letter.']')->paginate(16);
            $request->q = null;
        }elseif(isset($request->q)){
            $companies = Business::where('name', 'LIKE', '%'.$request->q.'%')->paginate(16);  
        }
        else
            return $this->companies($request);
        return view('market.companies', ['firstCompanies' => $firstCompanies, 'companies' => $companies, 'letter' => $letter, 'q' => $request->q, 'title' => $title]);
    }
}
