<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 02/01/2018
 * Time: 18:59
 */

namespace App\Http\Controllers;
use App\Model\MoneyRequest;
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
    public function request(Request $request){
        $user=Auth::user();
        return view('bank.request',['user'=>$user]);
    }
    public function withdraw(Request $request){
        $user=Auth::user();
        try{
            $accounts = \Stripe\Account::retrieve($user->stripe_account)->external_accounts->all(array(
                'limit'=>3, 'object' => 'bank_account'));
            $accounts=$accounts['data'];
        }catch (\Exception $exception){
            $accounts = [];
        }
        return view('bank.withdraw',['user'=>$user,'accounts'=>$accounts]);
    }
    public function withdraw_money(Request $request){
        $user=Auth::user();
        $bank = $request->account;
        $amount = (int)($request->amount * 90);
        $transaction = new Transaction();
        $transaction->amount = $request->amount*100;
        $transaction->user_id = $user->id;
        $transaction->description = "Bank Account Withdrawal";
        $transaction->direction = 0;
        $transaction->save();
        \Stripe\Transfer::create(array(
            "amount" => $amount,
            "currency" => "gbp",
            "destination" => $user->stripe_account
        ));

        \Stripe\Stripe::setApiKey($user->sk_key);
        try {
            \Stripe\Payout::create(array(
                "amount" => $amount,
                "currency" => "gbp",
                "destination" => $bank
            ));


        } catch (\Exception $e) {
            return [
                'success' => false,
                'res'=>$e,
                'result' => 'error withdrawing'
            ];
        }
        return redirect('/wallet/dashboard');
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
            $transaction->amount = (int)($request->amount*90);;
            $transaction->user_id = $other->id;
            $transaction->description = "Transfer from ".$user->name;
            $transaction->direction = 1;
            $transaction->save();
        }
        return redirect('/wallet/dashboard');
    }
    public function request_money(Request $request){
        $user=Auth::user();
        $other = User::find($request->id);

        $amount = (int)($request->amount*100);
        $money_request = new MoneyRequest();
        $money_request->amount = $amount;
        $money_request->user_id = $user->id;
        $money_request->other_id = $other->id;
        $money_request->save();
        $money_request->users()->save($user);
        $money_request->users()->save($other);

        return redirect('/wallet/dashboard');
    }
    public function transfer_balance(Request $request,$id){
        $user=Auth::user();
        $other = User::find($id);
        return view('bank.transfer',['user'=>$user,'other'=>$other]);
    }
    public function request_balance(Request $request,$id){
        $user=Auth::user();
        $other = User::find($id);
        return view('bank.rtransfer',['user'=>$user,'other'=>$other]);
    }
    public function pay_request(Request $request,$id){
        $user=Auth::user();
        $money_request = MoneyRequest::find($id);
        if($user->balance()>$money_request->amount){
            $transaction = new Transaction();
            $transaction->amount = $money_request->amount;
            $transaction->user_id = $user->id;
            $transaction->description = "Transfer to ".$money_request->user->name;
            $transaction->direction = 0;
            $transaction->save();

            $transaction = new Transaction();
            $transaction->amount = (int)($money_request->amount*90);;
            $transaction->user_id = $money_request->user->id;
            $transaction->description = "Transfer from ".$money_request->other->name;
            $transaction->direction = 1;
            $transaction->save();
            $money_request->status=1;
            $money_request->save();
        }
        return redirect('/wallet/dashboard');
    }
}