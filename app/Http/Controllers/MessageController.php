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
        if(!$user->access_token){
            $token = $user->createToken('Message Token')->accessToken;

            $user->access_token=$token;
            $user->save();
        }


        return view('home.messages',['cur'=>$user->rooms()->first(),'user'=>$user,'leftclass'=>'left-div-noroom','rightclass'=>'right-div-noroom']);
    }
    public function gmessages(Request $request,$rid){
        $user = Auth::user();
        $room=Room::find($rid);
        if($room===null){
            return redirect('/user/manage/messages');

        }
        if(!$user->access_token){
            $token = $user->createToken('Message Token')->accessToken;

            $user->access_token=$token;
            $user->save();
        }

        return view('home.messages',['cur'=>$room,'user'=>$user,'leftclass'=>'left-div-room','rightclass'=>'right-div-room']);
    }

    public function reply(Request $request,$id){
        $user = Auth::user();
        $advert = Advert::find($id);
        if($advert===null)
        {
            $advert=Advert::where('sid',$id)->first();
        }
        $room = Room::where('advert_id',$advert->id)->where('sender_id',$user->id)->first();
        if($room!==null){
            return redirect('/user/manage/messages/' . $room->id);
        }

        return view('home.reply',['advert'=>$advert,'user'=>$user]);

    }
    public function send(Request $request){
        if($request->has('g-recaptcha-response')) {
            $user = Auth::user();
            $advert = Advert::find($request->id);



            $room = Room::where('advert_id',$advert->id)->where('sender_id',$user->id)->first();
            if($room===null){
                $room = new Room;
                $room->advert_id = $advert->id;
                $room->image=$advert->first_image();
                $room->title=$advert->param('title');
                $room->sender_id=$user->id;
                $room->save();
                $room->users()->save($user);
                if($user->id!==$advert->user_id)
                $room->users()->save($advert->user);
            }




            $message = new Message;
            $message->message=$request->message;
            $message->from_msg=$user->id;
            $message->to_msg=$advert->user_id;
            $message->room_id=$room->id;
            $message->url='';
            $message->save();

            $advert->replies++;
            $advert->save();

        $this->notify($room,$message);

            return redirect('/user/manage/messages/' . $room->id);
        }else{
            return redirect('/user/reply/' . $request->id);
        }

    }
public function notify($room,$message){
    $user = Auth::user();

    foreach ($room->users as $usr){
        if($usr->id!==$user->id)
        {
            $data=['id'=>$message->id,'message' => $message->message,'mtype'=>'text','time'=>$message->updated_at,'from'=>$message->user->id,'room_id'=>$room->id];
            Redis::publish(''.$usr->id, json_encode($data));
            foreach ($usr->android as $token){
                $this->android($token,$room,$message,$data);
            }
        }
    }
}
    public function create_message(Request $request){

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
            $room->title=$advert->param('title');
            $room->sender_id=$user->id;
            $room->save();
            $room->users()->save($user);
            if($user->id!==$advert->user_id)
                $room->users()->save($advert->user);
            $advert->replies++;
            $advert->save();
        }




        $message = new Message;
        $message->message=$request->message;
        $message->from_msg=$user->id;
        $message->to_msg=$advert->user_id;
        $message->room_id=$room->id;
        $message->url='';
        $message->save();


        $this->notify($room,$message);




        return ['room_id'=>$room->id,'msg'=>'sent','mid'=>$message->id];

    }

    public function normal_message(Request $request){


        $user = Auth::user();
        $room = Room::find($request->id);
        $advert=$room->advert;

        $message = new Message;
        $message->message=$request->message;
        $message->from_msg=$user->id;
        $message->to_msg=$advert->user_id;
        $message->room_id=$room->id;
        if($request->has('url')){
            $message->url=$request->url;
        }

        $message->save();


        $this->notify($room,$message);

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
        $token='a879a49e68119a290d8be9a020f3dceef8ee01dba0f711c84865b61a2580056d4';
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

            $room = Room::find($request->rid);

            $advert=$room->advert;

            $message = new Message;
            $message->message=$request->message;
            $message->from_msg=$user->id;
            $message->to_msg=$advert->user_id;
            $message->room_id=$room->id;
            if($request->has('url')){
                $message->url=$request->url;
            }

            $message->save();


            $this->notify($room,$message);



        }

        return redirect('/user/manage/messages/'.$request->rid);

    }


}