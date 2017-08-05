<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 11:12
 */

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{
    public function create(){
        $user = \App\User::find(1);

 //Creating a token without scopes...
        $token = $user->createToken('Token Name')->accessToken;
        return $token;
    }
    public function profile()
    {
        // Get the currently authenticated user...
        $user = Auth::user();

// Get the currently authenticated user's ID...
        $id = Auth::id();
        return ["yes"=>"no",'user'=>$user];
    }

}