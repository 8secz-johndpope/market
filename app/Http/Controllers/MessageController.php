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

use Ramsey\Uuid\Uuid;

class MessageController extends BaseController
{
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }
    public function messages(Request $request){
        $client = new Client();
        $user = Auth::user();

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
            $room->sender_id=$user->id;
            $room->save();
        }


        $room->users()->save($user);
        $room->users()->save($advert->user);

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
        return ['mid'=>$message->id,'msg'=>'sent'];

    }
    public function all_messages(Request $request){
        $user = Auth::user();
        $rooms = $user->rooms()->pluck('room_id')->toArray();
        $messages = Message::whereIn('room_id',$rooms)->get();
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