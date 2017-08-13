<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 11:12
 */

namespace App\Http\Controllers;

use App\Model\Advert;
use App\Model\Category;
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

        $advert =  new Advert;
        $advert->save();
        $body=$request->body;
        $body['source_id']=$advert->id;
        $params = [
            'index' => 'tests',
            'type' => 'test',
            'body' => $body
        ];
        $response = $this->client->index($params);

        $advert->elastic=$response['_id'];
        $advert->save();

        return ['body'=>$body,'response'=>$response];
    }
    public function ccreate(Request $request){
        $body=$request->json()->all();
        $category=Category::where('slug',$body['slug'])->first();
        if($category===null){
            $category=new Category;
            $category->slug=$body['slug'];
            $category->save();

        }
        $body['category']=$category->id;
        $advert=Advert::where('sid','=',(int)$body['source_id'])->first();
        if($advert!==null){
            return ['a'=>'b'];
        }

        $advert =  new Advert;

        $advert->sid=(int)$body['source_id'];
        $advert->save();
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => $body
        ];
        $response = $this->client->index($params);
        $advert->elastic=$response['_id'];
        $advert->save();
        return ['response'=>$response];
    }
    public function register(Request $request){
        if(!$request->has('email'))
            return ['msg'=>"Email can't be blank"];
        if(!$request->has('password'))
            return ['msg'=>"Password can't be blank"];
        if(!$request->has('name'))
            return ['msg'=>"Name can't be blank"];
        $user = User::where('email',$request->email)->first();
        if($user!==null){
            return ['msg'=>'Email is already registered'];
        }
        $user = new User;
        $user->more(['email'=>$request->email,'name'=>$request->name,'password'=> bcrypt($request->password)]);
        $user->save();
        return ['msg'=>'success'];
    }

}