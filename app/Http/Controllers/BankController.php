<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 02/01/2018
 * Time: 18:59
 */

namespace App\Http\Controllers;
use App\Model\Transaction;
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

        $amount = (int)($request->amount*100);
        if($user->balance()>$amount){
            $transaction = new Transaction();
            $transaction->amount = $amount;
            $transaction->user_id = $user->id;
            $transaction->description = "Transfer to ".$other->name;
            $transaction->direction = 0;
            $transaction->save();

            $transaction = new Transaction();
            $transaction->amount = $amount;
            $transaction->user_id = $other->id;
            $transaction->description = "Transfer from ".$user->name;
            $transaction->direction = 1;
            $transaction->save();
        }


        return redirect('/wallet/dashboard');
    }
    public function transfer_balance(Request $request,$id){
        $user=Auth::user();
        $other = User::find($id);
        return view('bank.transfer',['user'=>$user,'other'=>$other]);
    }
}