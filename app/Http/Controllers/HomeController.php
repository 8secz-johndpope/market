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


        $base=Catagory::where('parent_id',0)->get();
        foreach ($base as $cat) {
            # code...
            $i=0;
            $cat->class="category-$i";
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
        }
        return view('home',['base' => $base]);
    }
}
