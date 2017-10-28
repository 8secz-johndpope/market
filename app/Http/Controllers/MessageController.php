<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 1:24 PM
 */

namespace App\Http\Controllers;
use App\Model\Advert;
use App\Model\Message;
use App\Model\Room;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

use Ramsey\Uuid\Uuid;

class MessageController extends BaseController
{
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }
    public function messages(Request $request){
        $user = Auth::user();

        return view('home.messages',['cur'=>$user->rooms()->first(),'user'=>$user]);

        /*

        $client = new Client();

        $g = $client->request('POST', 'https://fire.sumra.net/groups', [
            'form_params' => ['id'=>$user->id]
        ]);
        ///var_dump($g);
        //exit;
        $g = json_decode($g->getBody(),true);
        if(count($g)>0){
            usort($g,function ($a, $b)
            {
                if ($a['modified_at'] == $b['modified_at']) {
                    return 0;
                }
                return ($a['modified_at'] < $b['modified_at']) ? 1 : -1;
            });
            $r = $client->request('POST', 'https://fire.sumra.net/groupmessages', [
                'form_params' => ['rid'=>$g[0]['rid'],"time"=>0]
            ]);
            $r = json_decode($r->getBody(),true);

            return view('home.messages',['r'=>$r,'g'=>$g,'rid'=>$g[0]['rid'],'user'=>$user]);
        }
        else
            return view('home.messages',['r'=>[],'g'=>[],'rid'=>'nomessages','user'=>$user]);
        */
    }
    public function gmessages(Request $request,$rid){
        $client = new Client();
        $user = Auth::user();
        $r = $client->request('POST', 'https://fire.sumra.net/groupmessages', [
            'form_params' => ['rid'=>$rid,"time"=>0]
        ]);

        $g = $client->request('POST', 'https://fire.sumra.net/groups', [
            'form_params' => ['id'=>$user->id]
        ]);
        ///var_dump($g);
        //exit;
        $r = json_decode($r->getBody(),true);
        $g = json_decode($g->getBody(),true);
        usort($g,function ($a, $b)
        {
            if ($a['modified_at'] == $b['modified_at']) {
                return 0;
            }
            return ($a['modified_at'] < $b['modified_at']) ? 1 : -1;
        });
        //return $g;
        return view('home.messages',['r'=>$r,'g'=>$g,'rid'=>$rid,'user'=>$user]);
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
    public function send(Request $request){
        if($request->has('g-recaptcha-response')) {
            $user = Auth::user();
            $advert = Advert::find($request->id);
            $client = new Client();
            $g = $client->request('POST', 'https://fire.sumra.net/creategroup', [
                'form_params' => ['advert_id' => $advert->sid, 'users' => [$user->id, $advert->user_id], 'title' => $advert->param('title'), 'image' => $advert->first_image(), 'id' => $user->id]
            ]);
            $g = json_decode($g->getBody(), true);
            $k = $client->request('POST', 'https://fire.sumra.net/groupmessage', [
                'form_params' => ['from' => $user->id, 'message' => $request->message, 'rid' => $g['rid'], 'type' => 'text']
            ]);
            $advert->replies++;
            $advert->save();

            return redirect('/user/manage/messages/' . $g['rid']);
        }else{
            return redirect('/user/reply/' . $request->id);
        }

    }
    public function fsend(Request $request){
        $user = Auth::user();
        $advert = Advert::find($request->id);
        if($advert===null){
            $advert = Advert::where('sid',$request->id)->first();
        }
        $client = new Client();
        $g = $client->request('POST', 'https://fire.sumra.net/creategroup', [
            'form_params' => ['advert_id'=>$advert->sid,'users'=>[$user->id,$advert->user_id],'title'=>$advert->param('title'),'image'=>$advert->first_image(),'id'=>$user->id]
        ]);
        $g = json_decode($g->getBody(),true);
        $k = $client->request('POST', 'https://fire.sumra.net/groupmessage', [
            'form_params' => ['from'=>$user->id,'message'=>$request->message,'rid'=>$g['rid'],'type'=>'text']
        ]);
        $advert->replies++;
        $advert->save();

        return ['rid'=>$g['rid'],'msg'=>'sent'];

    }
    public function create_message(Request $request){
        $uuid = Uuid::uuid1();
        $mid = Uuid::uuid1();;

        $user = Auth::user();
        $advert = Advert::find($request->id);
        if($advert===null){
            $advert = Advert::where('sid',$request->id)->first();
        }
        $room = Room::where('advert_id',$advert->id)->where('sender_id',$user->id)->first();
        if($room===null){
            $room = new Room;
            $room->advert_id = $advert->id;
            $room->image=$advert->first_image();
            $room->rid=$uuid;
            $room->title=$advert->param('title');
            $room->sender_id=$user->id;
            $room->save();
            $room->users()->save($user);
            $room->users()->save($advert->user);
        }




        $message = new Message;
        $message->message=$request->message;
        $message->rid=$uuid;
        $message->mid=$mid;
        $message->from_msg=$user->id;
        $message->to_msg=$advert->user_id;
        $message->room_id=$room->id;
        $message->url='';
        $message->save();
        $message->insertion_time=$message->created_at;
        $message->save();
        $advert->replies++;
        $advert->save();

        Redis::publish(''.$advert->user_id, json_encode(['message' => $request->message]));

        return ['room_id'=>$room->id,'msg'=>'sent','mid'=>$message->id];

    }

    public function normal_message(Request $request){
        $uuid = Uuid::uuid1();
        $mid = Uuid::uuid1();;

        $user = Auth::user();
        $room = Room::find($request->id);
        $advert=$room->advert;

        $message = new Message;
        $message->message=$request->message;
        $message->rid=$uuid;
        $message->mid=$mid;
        $message->from_msg=$user->id;
        $message->to_msg=$advert->user_id;
        $message->room_id=$room->id;
        if($request->has('url')){
            $message->url=$request->url;
        }

        $message->save();
        $message->insertion_time=$message->created_at;
        $message->save();
        Redis::publish(''.$advert->user_id, json_encode(['message' => $request->message]));

        return ['mid'=>$message->id,'msg'=>'sent'];

    }
    public function room(Request $request,$id){
        $room =  Room::find($id);
        $room->users=$room->users()->pluck('user_id')->toArray();
        return $room;
    }
    public function call(Request $request){

        return ['msg'=>'sent'];
    }
    public function push(Request $request){
        $uuid = Uuid::uuid1();

        $user = Auth::user();
        $advert = Advert::find($request->id);
        if($advert===null){
            $advert = Advert::where('sid',$request->id)->first();
        }
        $room = Room::where('advert_id',$advert->id)->where('sender_id',$user->id)->first();
        $passphrase = '1234';
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
        $body['aps'] = array(
            'content-available' => 1,
            'roomName' => $room->title,
            'username' => $user->name,
            'alert' => 'great',
            'sound' => 'default'
        );
        $body['UUID']=$uuid;
        $body['handle']=$user->name;
        $body['hasVideo']='1';
// Encode the payload as JSON
        $payload = json_encode($body);
// Build the binary notification
        $token='';
        $msg = chr(0) . pack('n', 32) . pack('H*', $token) . pack('n', strlen($payload)) . $payload;
// Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result)
            echo 'Message not delivered' . PHP_EOL;
        else
            echo 'Message successfully delivered' . PHP_EOL;
// Close the connection to the server
        fclose($fp);
        return ['great'=>'yes','res'=>$result];
    }
    public function android(Request $request){
        $client = new Client([
            'headers' => [
                'Content-Type'=> 'application/json',
                'Authorization'=> 'key=AAAAxvu2uio:APA91bEv0upMJEfZC1Bv_kSH03KpsbZKP4zph4p8NXT0FO5Ihc2kLmtEUBHQ2rUoI0PXY2hyD70N3TjK2H4ARZP1hgffgJ8TeUCSMxRQNE9ADNR7zLNiMTNjajgiHHc795LAbs6akZD3'
            ]
        ]);

        $g = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'json' => ['to' => 'cFX7C7fVoHA:APA91bE4gCqSZ6YynKZd98Ar8ZoI8ST1HBToikZjTk1Q0xyT6qOvm06kg8inGioJ7P9MCYrATTUQNmurmQAq3wCtheaH9yb2COtNSR4SDUD2l-h5uuS9idhPHJBRpvU0_5K5lFAoyXmh', 'priority'=>'high','data','1','notification'=>['title'=>'title','body'=>'message','sound'=>'mySound']]
        ]);
        $g = json_decode($g->getBody(), true);

        return ['great'=>'yes','res'=>$g];
    }
    public function all_messages(Request $request){
        $user = Auth::user();
        $rooms = $user->rooms()->pluck('room_id')->toArray();
        if($request->has('time')){
            $x=date('Y-m-d H:i:s',$request->time);
            $messages = Message::where('created_at','>=',$x)->whereIn('room_id',$rooms)->get();

        }else{
            $messages = Message::whereIn('room_id',$rooms)->get();

        }

         return $messages;

    }

        public function rsend(Request $request){
        if($request->has('g-recaptcha-response')){
            $user = Auth::user();
            $client = new Client();
            $g = $client->request('POST', 'https://fire.sumra.net/groupmessage', [
                'form_params' => ['from'=>$user->id,'message'=>$request->message,'rid'=>$request->rid,'type'=>'text']
            ]);

        }

        return redirect('/user/manage/messages/'.$request->rid);

    }


}