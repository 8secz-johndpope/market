<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Catagory;
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


        $base=Catagory::where('parent',0)->get();
        return view('base' => $base]);
    }
    public function getNameCategory(String $index){
        return $this->categories[$index]["title"];
    }
    public function getFirstChildren(){
        $base = array();
        foreach ($this->base as $b) {
            $i = 0;
            $firstChildren = array();
            foreach ($this->children[$b] as $child) {
                if($i == self::MAX_CHILDREN)
                    break;
                $firstChildren[$child] = $this->categories[$child]["title"];
                $i++;
            }
            $base[$b] = $firstChildren;
            $base[$b]['title'] = $this->getNameCategory($b);
        }
        return $base;
    }
}
