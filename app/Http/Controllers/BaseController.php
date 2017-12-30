<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 14/07/2017
 * Time: 18:35
 */

namespace App\Http\Controllers;
use App\Model\FieldValue;
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

            'http://127.0.0.1:9200'        // SSL to localhost
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
            if($usr->id!==$user->id&&$usr->notifications===1)
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
    public function notify_invoice($invoice){


        Redis::publish(''.$invoice->message->from_msg, json_encode($invoice->message));
        foreach ($invoice->message->user->android as $token){
            $this->android($token,$invoice->title,'Invoice',$invoice);
        }
        foreach ($invoice->message->user->ios as $token){
            $this->ios($token,$invoice->title,'Invoice',$invoice);
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
        $g = $client->request('POST', env('APP_URL').':8080/push', [
            'json' => ['to' => $token->token , 'priority'=>'high','data'=>$data,'notification'=>['title'=>$title,'body'=>$user->name.': '.$message,'sound'=>'mySound']]
        ]);
        $g = json_decode($g->getBody(), true);
    }
    public function ios_call($token,$data)
    {
      //  $token='34f5094fc0754bfb7d0fb594dcae54d6069000e2ebcd54f2f3c4ba44fdc50b67';
// Put your private key's passphrase here:
$passphrase = '1234'; //for ck.pem
      //  $passphrase = 'abcd'; // for ck2.pem
// Put your alert message here:

        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', '/home/anil/market/storage/private/ck.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
// Open a connection to the APNS server
        $fp = stream_socket_client(
            'ssl://gateway.sandbox.push.apple.com:2195', $err,
            $errstr, 60, STREAM_CLIENT_CONNECT|STREAM_CLIENT_PERSISTENT, $ctx);
        if (!$fp)
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        echo 'Connected to APNS' . PHP_EOL;
// Create the payload body
        $body['aps'] = $data;

// Encode the payload as JSON
        $payload = json_encode($body);
// Build the binary notification
        $msg = chr(0) . pack('n', 32) . pack('H*', $token->token) . pack('n', strlen($payload)) . $payload;
// Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;
// Close the connection to the server
        fclose($fp);

    }
    public function slugify($str){
        $str = str_replace('&','and',$str);
        $str = str_replace(' ','-',$str);
        $str = strtolower($str);
        return $str;
    }
    public function deslugify($str){
        $str = str_replace('and','&',$str);
        $str = str_replace('-',' ',$str);
        $str = ucwords($str);
        return $str;
    }

}
