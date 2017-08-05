<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 11:12
 */

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{
    public function login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user =  Auth::user();

            //Creating a token without scopes...
            $token = $user->createToken('Token Name')->accessToken;
            return ['token'=>$token];
        }else{
            return ['msg'=>"Invalid Credentials"];
        }
    }
    public function profile()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

// Get the currently authenticated user's ID...
        $id = Auth::id();
        return ["yes"=>"no",'user'=>$user];
    }

    public function create(Request $request){

        $body=$request->body;

        return $body;


    }
    public function register(Request $request){
        if(!$request->has('email'))
            return ['msg'=>"Email can't be blank"];
        if(!$request->has('password'))
            return ['msg'=>"Password can't be blank"];
        if(!$request->has('name'))
            return ['msg'=>"Name can't be blank"];
        $user = new User;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->name=$request->name;
        $customer = \Stripe\Customer::create(array(
            'email' => $user->email
        ));
        $account = \Stripe\Account::create(array(
            "type" => "custom",
            "country" => "GB",
            "email" => $user->email
        ));
        $user->stripe_id = $customer->id;
        $user->stripe_account=$account->id;
        $user->pk_key=$account->keys->publishable;
        $user->sk_key=$account->keys->secret;
        $user->save();
        return ['msg'=>'success'];
    }

}