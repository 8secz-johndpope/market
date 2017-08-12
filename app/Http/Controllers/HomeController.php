<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Catagory;
class HomeController extends BaseController
{
    const MAX_CHILDREN = 10;
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


        $base=Catagory::where('parent_id',0)->get();
        foreach ($base as $cat) {
            # code...
            $i=0;
            $cat->class="category-$i";
            if(count($cat->children) < 10)
                $cat->children = array_slice($cat->children, 0, 10);
            /*foreach ($cat->children as $child) {
                # code...
                # i
                if($i<10){
                    $child->class='visible-class';
                }else{
                    $child->class='invisible-class';
                }
               $i++; 
            }*/
            $i++;
        }
        return view('home',['base' => $base]);
    }
}
