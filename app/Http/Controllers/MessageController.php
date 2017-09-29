<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 1:24 PM
 */

namespace App\Http\Controllers;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use Illuminate\Http\Request;


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
        //return $g;
        return view('home.messages',['r'=>$r,'g'=>$g]);
    }

}