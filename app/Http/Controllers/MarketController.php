<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:28
 */

namespace App\Http\Controllers;


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

        foreach ($this->oldcats as $old) {
            $id=$old['id'];
            $replace=$this->categories[$old['slug']]['id'];
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size' => 2000,
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
        }
        return '';
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
        echo json_encode($this->children);
        return '';
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

        $cat=$this->catids[$product['category']]['slug'];

        $catagory= Category::find($product['category']);


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
        $min = 0;
        $max = 999999999;
        $page = $request->page ? $request->page : 1;
        if($page>100)
        {
            $page=100;
        }
        $pagesize = 50;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => ($page-1)*$pagesize,
                'size'=>$pagesize,
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
        $total= $response['hits']['total'];
        $max = (int)($total/$pagesize);
        $max=$max+1;
        if($max>100){
            $max=100;
        }

        $breads = [];


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

        return View('market.listing',['max'=>$max,'pages'=>$pages,'total'=>$total,'page'=>$page,'catids'=>$this->catids,'catagories'=>$this->categories,'products'=>$products,'breads'=>$breads,'last'=>'','children'=>$this->children,'parents'=>$this->parents,'base'=>$this->base,'chs'=>$this->base]);
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
        $body = $request->json()->all();
        $page = isset($body['page']) ? $body['page'] : 1;
        $id = $body['category'];
        $category=Category::find($id);
        $fields = $category->fields;
        $aggs=array();
        foreach ($fields as $field){
            if($field->type==='integer'){
                $filters = $field->filters;
                $ranges = array();
                foreach ($filters as $filter){
                    $ranges[] = ['from'=>$filter->from_int,'to'=>$filter->to_int];
                }
                $aggs[$field->slug]=['range'=>['field'=>'meta.'.$field->slug,'ranges'=>$ranges]];
            }else{
                $aggs[$field->slug]=['terms'=>['field'=>'meta.'.$field->slug.'.keyword','size'=>1000000]];
            }
        }
        $pagesize = 25;
        $lat = isset($body['lat']) ? $body['lat'] : 52.5;
        $lng = isset($body['lng']) ? $body['lng'] : 1.2;
        $sort=[
            [
                "created_at"=> ["order"=> "desc"]
            ]
        ];

        if(isset($body['order_by'])){
            if($body['order_by']==='distance'){
                $sort=[
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
            else if($body['order_by']==='price_desc'){
                $sort=[

                    [
                        "meta.price"=> ["order"=> "desc"]
                    ],
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]
                ];
            }
            else if($body['order_by']==='price_asc'){
                $sort=[
                    [
                        "meta.price"=> ["order"=> "asc"]
                    ],
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]
                ];
            }
            else{
                $sort=[
                    [
                        "created_at"=> ["order"=> "desc"]
                    ]
                ];
            }
        }
        $q = '';
        if(isset($body['q'])){
            $q=$body['q'];
        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => ($page-1)*$pagesize,
                'size'=>$pagesize,
                'query' => [
                    'bool' => [
                      'must' => [
                          [
                              'range' => [
                                  'category' => [
                                      'gte'=>$category->id,
                                      'lte'=>$category->ends
                                  ]
                              ]
                          ]

                      ]
                    ]

                ],
                "sort"=> $sort,
                'aggs'=>$aggs
            ]
        ];
        if(isset($body['q'])){
            $params['body']['query']['bool']['must'][]=[
                'match' => [
                    'title'=>$body['q']
                ]
            ];
        }

        if(isset($body['distance'])&&isset($body['lat'])&&isset($body['lng'])){
            $params['body']['query']['bool']["filter"] = [
                "geo_distance" => [
                    "distance" => $body['distance'].'mi',
                    "location" => [
                        "lat" => $lat,
                        "lon" => $lng
                    ]
                ]
            ];
        }

        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);

        return ['total'=>$response['hits']['total'],'adverts'=>$products,'aggs'=>$response['aggregations']];

    }
    public function search(Request $request,$any){
        $category = Category::where('slug',$any)->first();
        $fields = $category->fields;
        $aggs=array();
        foreach ($fields as $field){
            if($field->type==='integer'){
                $filters = $field->filters;
                $ranges = array();
                foreach ($filters as $filter){
                    $ranges[] = ['from'=>$filter->from_int,'to'=>$filter->to_int];
                }
                $aggs[$field->slug]=['range'=>['field'=>'meta.'.$field->slug,'ranges'=>$ranges]];
            }else{
                $aggs[$field->slug]=['terms'=>['field'=>'meta.'.$field->slug.'.keyword','size'=>1000000]];
            }
        }
        $page = $request->page ? $request->page : 1;
        if($page>100)
        {
            $page=100;
        }
        $pagesize = 50;
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'from' => ($page-1)*$pagesize,
                'size'=>$pagesize,
                'query' => [
                    'range' => [
                      'category' => [
                          'gte'=>$category->id,
                          'lte'=>$category->ends
                      ]
                    ]
                ],
                "sort"=> [
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
                ],
                'aggs'=>$aggs
            ]
        ];
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $total= $response['hits']['total'];
        $max = (int)($total/$pagesize);
        $max++;
        if($max>100){
            $max=100;
        }

        $breads = array();
        $start=$any;
        while (isset($this->parents[$start])){
            $start=$this->parents[$start];
            array_unshift($breads,$start);
        }
        $pages = array();
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

        $aggretations = $response['aggregations'];
        $filters=array();
        foreach ($aggretations as $key=>$aggretation){
            $field = Field::where('slug',$key)->first();
            $buckets = $aggretation['buckets'];
            $values=array();
            foreach ($buckets as $bucket){
                $field_val = FieldValue::where('slug',$bucket['key'])->first();
                if($field_val===null){
                  //  $filter = Filter::where('from_int',$bucket['from'])->where('to_int',$bucket['to'])->first();
                   // $filter->count = $bucket['doc_count'];
                   // $values[]=$filter;
                }else{
                    $field_val->count = $bucket['doc_count'];
                    $values[]=$field_val;
                }

            }
            $field->vals = $values;
            $filters[] = $field;

        }

        return View('market.listing',['max'=>$max,'pages'=>$pages,'total'=>$total,'page'=>$page,'category'=>$category,'catagories'=>$this->categories,'products'=>$products,'breads'=>$breads,'last'=>$any,'children'=>$this->children,'parents'=>$this->parents,'base'=>$this->base,'chs'=>$chs,'filters'=>$filters]);
    }

}
