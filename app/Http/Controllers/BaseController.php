<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:35
 */

namespace App\Http\Controllers;
use Cassandra;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $site_settings;
    protected $client;

    public function __construct()
    {
        $hosts = [

            'http://145.239.66.50:9200'        // SSL to localhost
        ];
        $this->client = \Elasticsearch\ClientBuilder::create()           // Instantiate a new ClientBuilder
        ->setHosts($hosts)      // Set the hosts
        ->build();              // Build the client object


    }
    public function notify($room,$message){
        $user = Auth::user();
        if(!$message->type)
            $message->type='text';
        foreach ($room->users as $usr){
            if($usr->id!==$user->id)
            {
                Redis::publish(''.$usr->id, json_encode($message));
                foreach ($usr->android as $token){
                    $this->android($token,$room,$message,$message);
                }
            }
        }
    }

    public function android($token,$room,$message,$data){
        $client = new Client([
            'headers' => [
                'Content-Type'=> 'application/json',
                'Authorization'=> 'key=AAAAxvu2uio:APA91bEv0upMJEfZC1Bv_kSH03KpsbZKP4zph4p8NXT0FO5Ihc2kLmtEUBHQ2rUoI0PXY2hyD70N3TjK2H4ARZP1hgffgJ8TeUCSMxRQNE9ADNR7zLNiMTNjajgiHHc795LAbs6akZD3'
            ]
        ]);
        //$tk='cFX7C7fVoHA:APA91bE4gCqSZ6YynKZd98Ar8ZoI8ST1HBToikZjTk1Q0xyT6qOvm06kg8inGioJ7P9MCYrATTUQNmurmQAq3wCtheaH9yb2COtNSR4SDUD2l-h5uuS9idhPHJBRpvU0_5K5lFAoyXmh';
        $g = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'json' => ['to' => $token->token , 'priority'=>'high','data'=>$data,'notification'=>['title'=>$room->title,'body'=>$message->message,'sound'=>'mySound']]
        ]);
        $g = json_decode($g->getBody(), true);

        //return ['great'=>'yes','res'=>$g];
    }


}
