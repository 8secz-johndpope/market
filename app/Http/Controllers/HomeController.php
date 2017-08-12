<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends BaseController
{
    const MAX_CHILDREN = 9;
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


        return view('home',['categories'=>$this->categories,'parents'=>$this->parents,'children'=>$this->getFirstChildren($this->children),'catids'=>$this->catids, 'base' => $this->base, 'last' => '']);
    }
    public function getNameCategory(String $index){
        return $categories[$name]["title"];
    }
    public function getFirstChildren(){
        $i = 0;
        $base = array();
        foreach ($this->base as $b) {
            $firstChildren = array();
            foreach ($this->children[$b] as $child) {
                if($i == self::MAX_CHILDREN)
                    break;
                $firstChildren[$child] = $this->categories[$child]["title"];
                $i++;
            }
            var_dump($firstChildren);
            $base[$b] = $firstChildren;
        }
        return $base;
    }
}
