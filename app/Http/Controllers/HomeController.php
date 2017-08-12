<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    Const MAX_CHILDREN = 9;
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


        return view('home',['categories'=>$this->categories,'parents'=>$this->parents,'children'=>$this->getFirstChildren($this-
            >children),'catids'=>$this->catids, 'base' => $this->base, 'last' => '']);
    }
    public function getNameCategory(String $index){
        return $categories[$name]["title"];
    }
    public function getFirstChildren(String $category){
        $i = 0;
        $firstChildren = array();
        foreach ($categories[$category] as $child) {
            $firstChildren[$child] = $categories[$child]["title"];
            if(i == 9)
                break;
        }
        return $firstChildren
    }
}
