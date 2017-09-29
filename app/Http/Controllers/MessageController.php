<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 1:24 PM
 */

namespace App\Http\Controllers;
use App\Model\Advert;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends BaseController
{
    public function messages(Request $request){
        $client = new Client();
        $r = $client->request('POST', 'https://fire.sumra.net/allmessages', [
            'form_params' => ['id'=>104]
        ]);

        $g = $client->request('POST', 'https://fire.sumra.net/groups', [
            'form_params' => ['id'=>104]
        ]);
        ///var_dump($g);
        //exit;
        $g = json_decode($g->getBody(),true);
        //return $g;
        return view('home.messages',['r'=>$r,'g'=>$g]);
    }
    public function reply(Request $request,$id){
        $user = Auth::user();
        $advert = Advert::find($id);
        if($advert===null)
        {
            $advert=Advert::where('sid',$id)->first();
        }
        return view('home.reply',['advert'=>$advert,'user'=>$user]);

    }

}