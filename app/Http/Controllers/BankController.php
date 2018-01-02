<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 02/01/2018
 * Time: 18:59
 */

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BankController extends BaseController
{
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }
    public function dashboard(Request $request){
        $user=Auth::user();
        return view('bank.dashboard',['user'=>$user]);
    }
    public function send(Request $request){
        $user=Auth::user();
        return view('bank.send',['user'=>$user]);
    }
    public function send_money(Request $request){
        $user=Auth::user();
        $other = User::find($request->id);
        
        return redirect('/bank/dashboard');
    }
    public function transfer_balance(Request $request,$id){
        $user=Auth::user();
        $other = User::find($id);
        return view('bank.transfer',['user'=>$user,'other'=>$other]);
    }
}