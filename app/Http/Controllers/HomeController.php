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
    public function index()
    {
        $base=$this->baseAndFirstChildren();
        //Need chande de response is not search client
        $response = $this->client->search($params);
        $products = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        var_dump($products);
        die;
        return view('home',['base' => $base]);
    }
    
    public function baseAndFirstChildren(){
        $base = Category::where('parent_id',0)->get();
        $j = 0;
        foreach ($base as $cat) {
            $cat->class = "category-$j";
            if($cat->children()->count() > self::MAX_CHILDREN)
                $cat->hasMore = true;
            $cat->children= $cat->children()->limit(self::MAX_CHILDREN)->get();
            $j++;
        }
        return $base;
    }
}
