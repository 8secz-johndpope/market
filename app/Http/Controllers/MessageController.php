<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 1:24 PM
 */
use Illuminate\Http\Request;

namespace App\Http\Controllers;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;


class MessageController extends BaseController
{
    public function test(Request $request){
        $client = new Client();
        $r = $client->request('POST', 'https://fire.sumra.net/allmessages', [
            'body' => ['id'=>104]
        ]);
        return $r;
    }

}