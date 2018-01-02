<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 02/01/2018
 * Time: 18:59
 */

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class BankController extends BaseController
{
    public function dashboard(Request $request){
        $user=Auth::user();
        return view('bank.dashboard',['user'=>$user]);
    }
}