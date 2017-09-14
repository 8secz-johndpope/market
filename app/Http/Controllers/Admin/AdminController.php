<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/09/2017
 * Time: 19:23
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;

class AdminController extends BaseControllerController
{
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }
    public function packs(Request $request){
        $prices = Price::all();
        return view('home.packs',['prices'=>$prices]);
    }
    public function pricegroup(Request $request){
        $prices = Price::all();
        $categories = Category::where('parent_id',0)->get();
        $locations = Location::where('parent_id',0)->get();

        return view('home.pricegroup',['prices'=>$prices,'categories'=>$categories,'locations'=>$locations]);
    }
    public function add_pricegroup(Request $request){
        $price = new Price;
        $price->category_id = $request->category;
        $price->location_id = $request->location;
        $price->standard = $request->standard*100;
        $price->spotlight = $request->spotlight*100;
        $price->urgent = $request->urgent*100;
        $price->featured = $request->featured*100;
        $price->featured_3 = $request->featured_3*100;
        $price->featured_14 = $request->featured_14*100;
        $price->bump = $request->bump*100;
        $price->save();
        return ['msg'=>'done'];

    }
}