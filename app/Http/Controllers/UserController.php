<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 11:12
 */

namespace App\Http\Controllers;


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
        return "yes";
    }

}