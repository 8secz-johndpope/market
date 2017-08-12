<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:28
 */

namespace App\Http\Controllers;


use App\Model\Catagory;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
        foreach ($this->categories as $key=>$val){
            $cat = new Catagory;
            $cat->id=$val['id'];
            $cat->title=$val['title'];
            $cat->slug=$val['slug'];
            $cat->save();
        }
        return '';
    }
    public function fields(Request $request,$any){
        $id = $this->categories[$any]['id'];


        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>1,
                'query' => [
                    'term' => [
                        "category" => $id
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
        $fields=$products[0]['meta'];
        $counts=[];
        $mandatory=[];
        foreach ($fields as $key=>$val){
            $params = [
                'index' => 'adverts',
                'type' => 'advert',
                'body' => [
                    'size'=>1,
                    'query' => [
                        'bool'=>[
                            'must' => [
                                'term' => [
                                    "category" => $id
                                ],
                            ],
                            "must_not"=> [
                                [
                                    "exists"=> [
                                    "field"=> "meta.".$key
                                    ]
                                ]
                            ]
                        ]
                    ]

                ]
            ];
            $response = $this->client->search($params);
            $counts[$key]=$response['hits']['total'];
        }
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>1,
                'query' => [
                    'bool'=>[
                        'must' => [
                            [
                            ['term' => [
                                "category" => $id
                            ]],
                               [ "term"=> [
                                    "meta.price"=> -1
                                ]
                               ]
                            ]
                        ],
                        'must_not' => [

                        ]

                    ]
                ]

            ]
        ];
        $response = $this->client->search($params);
        $counts['price']=$response['hits']['total'];
        return $counts;
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

        $id = $this->categories[$cat]['id'];
        $min = $id;
        if($id%100000000===0){
            $max = $min + 99999999;
        }
        else if($id%1000000===0){
            $max = $min + 999999;
        }
        else if($id%10000===0){
            $max = $min + 9999;
        }
        else if($id%100===0){
            $max = $min + 99;
        }
        else {
            $max = $min;
        }

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
                            'gte'=>$min,
                            'lte'=>$max
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
    public function search(Request $request,$any){
        $id = $this->categories[$any]['id'];
        $min = $id;
        if($id%100000000===0){
            $max = $min + 99999999;
        }
        else if($id%1000000===0){
            $max = $min + 999999;
        }
        else if($id%10000===0){
            $max = $min + 9999;
        }
        else if($id%100===0){
            $max = $min + 99;
        }
        else {
            $max = $min;
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

        return View('market.listing',['max'=>$max,'pages'=>$pages,'total'=>$total,'page'=>$page,'catids'=>$this->catids,'catagories'=>$this->categories,'products'=>$products,'breads'=>$breads,'last'=>$any,'children'=>$this->children,'parents'=>$this->parents,'base'=>$this->base,'chs'=>$chs]);
    }

}
