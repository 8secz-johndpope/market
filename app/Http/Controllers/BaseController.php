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
use Pushok\AuthProvider;
use Pushok\Client as PClient;
use Pushok\Notification;
use Pushok\Payload;
use Pushok\Payload\Alert;
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
                $message->room = $message->room;
                Redis::publish(''.$usr->id, json_encode($message));
                foreach ($usr->android as $token){
                    $this->android($token,$room->title,$message->message,$message);
                }
                foreach ($usr->ios as $token){
                    $this->ios($token,$room->title,$message->message,$message);
                }
            }
        }
    }



    public function notify_sale($sale){


                Redis::publish(''.$sale->advert->user_id, json_encode($sale));
                foreach ($sale->advert->user->android as $token){
                    $this->android($token,$sale->advert->param('title'),'Order Received',$sale);
                }
                foreach ($sale->advert->user->ios as $token){
                    $this->ios($token,$sale->advert->param('title'),'Order Received',$sale);
                }

    }

    public function android($token,$title,$message,$data){
        $user = Auth::user();

        $client = new Client([
            'headers' => [
                'Content-Type'=> 'application/json',
                'Authorization'=> 'key=AAAAxvu2uio:APA91bEv0upMJEfZC1Bv_kSH03KpsbZKP4zph4p8NXT0FO5Ihc2kLmtEUBHQ2rUoI0PXY2hyD70N3TjK2H4ARZP1hgffgJ8TeUCSMxRQNE9ADNR7zLNiMTNjajgiHHc795LAbs6akZD3'
            ]
        ]);
        //$tk='cFX7C7fVoHA:APA91bE4gCqSZ6YynKZd98Ar8ZoI8ST1HBToikZjTk1Q0xyT6qOvm06kg8inGioJ7P9MCYrATTUQNmurmQAq3wCtheaH9yb2COtNSR4SDUD2l-h5uuS9idhPHJBRpvU0_5K5lFAoyXmh';
        $g = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'json' => ['to' => $token->token , 'priority'=>'high','data'=>$data,'notification'=>['title'=>$title,'body'=>$user->name.': '.$message,'sound'=>'mySound']]
        ]);
        $g = json_decode($g->getBody(), true);

        //return ['great'=>'yes','res'=>$g];
    }
    public function android_call($token,$data){
        $user = Auth::user();

        $client = new Client([
            'headers' => [
                'Content-Type'=> 'application/json',
                'Authorization'=> 'key=AAAAxvu2uio:APA91bEv0upMJEfZC1Bv_kSH03KpsbZKP4zph4p8NXT0FO5Ihc2kLmtEUBHQ2rUoI0PXY2hyD70N3TjK2H4ARZP1hgffgJ8TeUCSMxRQNE9ADNR7zLNiMTNjajgiHHc795LAbs6akZD3'
            ]
        ]);
        //$tk='cFX7C7fVoHA:APA91bE4gCqSZ6YynKZd98Ar8ZoI8ST1HBToikZjTk1Q0xyT6qOvm06kg8inGioJ7P9MCYrATTUQNmurmQAq3wCtheaH9yb2COtNSR4SDUD2l-h5uuS9idhPHJBRpvU0_5K5lFAoyXmh';
        $g = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'json' => ['to' => $token->token , 'priority'=>'high','data'=>$data]
        ]);
        $g = json_decode($g->getBody(), true);

        //return ['great'=>'yes','res'=>$g];
    }
    public function ios($token,$title,$message,$data){
        $user = Auth::user();

        $client = new Client([
            'headers' => [
                'Content-Type'=> 'application/json',
                'Authorization'=> 'key=AAAAxvu2uio:APA91bEv0upMJEfZC1Bv_kSH03KpsbZKP4zph4p8NXT0FO5Ihc2kLmtEUBHQ2rUoI0PXY2hyD70N3TjK2H4ARZP1hgffgJ8TeUCSMxRQNE9ADNR7zLNiMTNjajgiHHc795LAbs6akZD3'
            ]
        ]);
        //$tk='cFX7C7fVoHA:APA91bE4gCqSZ6YynKZd98Ar8ZoI8ST1HBToikZjTk1Q0xyT6qOvm06kg8inGioJ7P9MCYrATTUQNmurmQAq3wCtheaH9yb2COtNSR4SDUD2l-h5uuS9idhPHJBRpvU0_5K5lFAoyXmh';
        $g = $client->request('POST', 'https://sumra.net:8080/push', [
            'json' => ['to' => $token->token , 'priority'=>'high','data'=>$data,'notification'=>['title'=>$title,'body'=>$user->name.': '.$message,'sound'=>'mySound']]
        ]);
        $g = json_decode($g->getBody(), true);
    }

}
