<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Category;
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
    public function post(Request $request)
    {
        $categories = Category::where('parent_id',0)->get();

        return view('home.post',['categories'=>$categories]);
    }
    public  function newad(Request $request){

        return $request->json()->all();
        $categories = Category::where('parent_id',0)->get();

        return view('home.post',['categories'=>$categories]);
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
}
