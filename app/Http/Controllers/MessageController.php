<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 1:24 PM
 */

namespace App\Http\Controllers;
use App\Model\Advert;
use App\Model\Application;
use App\Model\Direct;
use App\Model\Message;
use App\Model\Room;
use App\Model\Sale;
use App\User;
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

    public function rooms(Request $request,$id){

        $user = Auth::user();
        $room = Room::find($id);
        //$room->modify();


        return view('home.rooms',['cur'=>$room,'user'=>$user,'leftclass'=>'left-div-noroom','rightclass'=>'right-div-noroom']);
    }
    public function msgs(Request $request,$id){

        $user = Auth::user();
        $room = Room::find($id);
        //$room->modify();


        return view('home.msgs',['cur'=>$room,'user'=>$user,'leftclass'=>'left-div-noroom','rightclass'=>'right-div-noroom']);
    }
    public function gmessages(Request $request,$rid){
        $user = Auth::user();
        $room=Room::find($rid);
        if($room->last_message()&&$room->last_message()->user->id!==$user->id && $room->unread == 1)
            $room->read();
        if($room===null){
            return redirect('/user/manage/messages');

        }
       // $room->modify();

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
    public function reqInvoice(Request $request,$id){
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
        return view('home.send_req_inv',['advert'=>$advert,'user'=>$user]);
    }
    public function contact_applicant(Request $request,$id){
        $user = Auth::user();
        $application = Application::find($id);

        $room = Room::where('advert_id',$application->advert_id)->where('sender_id',$application->user_id)->first();
        if($room!==null){
            return redirect('/user/manage/messages/' . $room->id);
        }

        return view('home.contact_applicant',['application'=>$application,'user'=>$user]);

    }

    public function contact_buyer(Request $request,$id){
        $user = Auth::user();
        $sale = Sale::find($id);
        $advert = $sale->advert;

        $room = Room::where('advert_id',$advert->id)->where('sender_id',$sale->user->id)->first();
        if($room!==null){
            return redirect('/user/manage/messages/' . $room->id);
        }

        return view('home.contact_buyer',['advert'=>$advert,'user'=>$user,'sale'=>$sale]);

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
                if($user->id!==$advert->user_id){
                    if($advert->user)
                    $room->users()->save($advert->user);
                    else
                        $room->users()->save(User::find(1));

                }

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
            $room->modify();
            $this->notify($room,$message);
            return redirect('/user/manage/messages/' . $room->id);
        }else{
            return redirect('/user/reply/' . $request->id);
        }
    }
    public function reqInvsend(Request $request){
        if($request->has('g-recaptcha-response')) {
            $user = Auth::user();
            if($user == null){
                return ['msg' => 'error_unautorized'];
            }
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
                if($user->id!==$advert->user_id){
                    if($advert->user)
                    $room->users()->save($advert->user);
                    else
                        $room->users()->save(User::find(1));

                }

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
            $room->modify();
            $this->notify($room,$message);
            return ['msg' => 'ok'];
        }else{
            return ['msg' => 'no captcha'];
        }
    }
    public function asend(Request $request){
        if($request->has('g-recaptcha-response')) {
            $user = Auth::user();
            $application = Application::find($request->id);
            $advert = $application->advert;


            $room = Room::where('advert_id',$application->advert_id)->where('sender_id',$application->user_id)->first();
            if($room===null){
                $room = new Room;
                $room->advert_id = $application->advert->id;
                $room->image=$application->advert->first_image();
                $room->title=$application->advert->param('title');
                $room->sender_id=$application->user->id;
                $room->save();
                $room->users()->save($application->user);
                if($user->id!==$application->user->id){
                        $room->users()->save($user);


                }

                $advert->replies++;
                $advert->save();
            }




            $message = new Message;
            $message->message=$request->message;
            $message->from_msg=$user->id;
            $message->to_msg=$application->user_id;
            $message->room_id=$room->id;
            $message->url='';
            $message->save();



            $room->modify();

            $this->notify($room,$message);

            return redirect('/user/manage/messages/' . $room->id);
        }else{
            return redirect('/user/areply/' . $request->id);
        }

    }
    public function bsend(Request $request){
        if($request->has('g-recaptcha-response')) {
            $user = Auth::user();
            $sale = Sale::find($request->id);
            $advert = $sale->advert;



            $room = Room::where('advert_id',$advert->id)->where('sender_id',$sale->user->id)->first();
            if($room===null){
                $room = new Room;
                $room->advert_id = $advert->id;
                $room->image=$advert->first_image();
                $room->title=$advert->param('title');
                $room->sender_id=$sale->user->id;
                $room->save();
                $room->users()->save($user);
                if($sale->user->id!==$advert->user_id)
                    $room->users()->save($sale->user);
                $advert->replies++;
                $advert->save();

            }




            $message = new Message;
            $message->message=$request->message;
            $message->from_msg=$user->id;
            $message->to_msg=$sale->user->id;
            $message->room_id=$room->id;
            $message->url='';
            $message->save();


            $room->modify();

            $this->notify($room,$message);

            return redirect('/user/manage/messages/' . $room->id);
        }else{
            return redirect('/user/breply/' . $request->id);
        }

    }
    public function buyer_send(Request $request){
            $user = Auth::user();
            $sale = Sale::find($request->id);
            $advert = $sale->advert;



            $room = Room::where('advert_id',$advert->id)->where('sender_id',$sale->user->id)->first();
            if($room===null){
                $room = new Room;
                $room->advert_id = $advert->id;
                $room->image=$advert->first_image();
                $room->title=$advert->param('title');
                $room->sender_id=$sale->user->id;
                $room->save();
                $room->users()->save($user);
                if($sale->user->id!==$advert->user_id)
                    $room->users()->save($sale->user);
                $advert->replies++;
                $advert->save();

            }




            $message = new Message;
            $message->message=$request->message;
            $message->from_msg=$user->id;
            $message->to_msg=$sale->user->id;
            $message->room_id=$room->id;
            $message->url='';
            $message->save();


            $room->modify();

            $this->notify($room,$message);
            return ['msg'=>'sent','room_id'=>$room->id,'mid'=>$message->id];

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
            if($user->id!==$advert->user_id){
                if($advert->user===null){
                    $room->users()->save(User::find(1));
                }else{

                    $room->users()->save($advert->user);
                }
            }
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
        $room->modify();

        $this->notify($room,$message);




        return ['room_id'=>$room->id,'msg'=>'sent','mid'=>$message->id];

    }
    public function create_room(Request $request)
    {
        $user = Auth::user();
        $to = $request->to;
        $other = User::find($to);
        $direct = Direct::where('u1',$user->id)->where('u2',$to)->first();
        if($direct===null){
            $direct = Direct::where('u2',$user->id)->where('u1',$to)->first();
        }
        if($direct===null){
            $room = new Room;
            $room->sender_id=$user->id;
            $room->direct=1;
            $room->save();
            $room->users()->save($user);
            if($user->id!==$other->id){
                $room->users()->save($other);
            }
            $direct=new Direct();
            $direct->u1 = $user->id;
            $direct->u2 = $other->id;
            $direct->room_id = $room->id;
            $direct->save();
        }else{
            $room=$direct->room;
        }

        $users = $room->users;
        $users = $users->map(function ($user){
            return ['id'=>$user->id,'name'=>$user->name,'image'=>$user->image];
        });
        return ['id'=>$room->id,'users'=>$users];
    }
    public function add_group(Request $request)
    {
        $user = Auth::user();

            $room = new Room;
            $room->sender_id=$user->id;
        $room->title=$request->title;
        $room->image = $request->image;
            $room->save();

            foreach ($request->users as $uid){
                $usr = User::find($uid);
                $room->users()->save($usr);
            }
            $room->users()->save($user);
        return redirect('/user/manage/messages/' . $room->id);

    }
    public function send_broadcast(Request $request)
    {
        $user = Auth::user();



        foreach ($request->users as $uid){
            $other = User::find($uid);
            $direct = Direct::where('u1',$user->id)->where('u2',$uid)->first();
            if($direct===null){
                $direct = Direct::where('u2',$user->id)->where('u1',$uid)->first();
            }
            if($direct===null){
                $room = new Room;
                $room->sender_id=$user->id;
                $room->direct=1;
                $room->save();
                $room->users()->save($user);
                if($user->id!==$other->id){
                    $room->users()->save($other);
                }
                $direct=new Direct();
                $direct->u1 = $user->id;
                $direct->u2 = $other->id;
                $direct->room_id = $room->id;
                $direct->save();
            }else{
                $room=$direct->room;
            }

            $message = new Message;
            $message->message=$request->message;
            $message->from_msg=$user->id;
                $message->to_msg=$other->id;
            $message->room_id=$room->id;

            $message->save();

            $room->modify();
            $this->notify($room,$message);
        }
        return redirect('/user/manage/messages/');

    }
    public function delete_chat(Request $request,$id)
    {
        $user = Auth::user();
        $room = Room::find($id);
        $room_user = RoomUser::where('room_id',$room->id)->where('user_id',$user->id)->first();
        $room_user->last_message_id = $room->last_message()->id;
        $room_user->save();
        return redirect('/user/manage/messages/');


    }
    public function direct_message(Request $request,$id)
    {
        $user = Auth::user();
        $to = $id;
        $other = User::find($to);
        $direct = Direct::where('u1',$user->id)->where('u2',$to)->first();
        if($direct===null){
            $direct = Direct::where('u2',$user->id)->where('u1',$to)->first();
        }
        if($direct===null){
            $room = new Room;
            $room->sender_id=$user->id;
            $room->direct=1;
            $room->save();
            $room->users()->save($user);
            if($user->id!==$other->id){
                $room->users()->save($other);
            }
            $direct=new Direct();
            $direct->u1 = $user->id;
            $direct->u2 = $other->id;
            $direct->room_id = $room->id;
            $direct->save();
        }else{
            $room=$direct->room;
        }
        return redirect('/user/manage/messages/' . $room->id);


    }

    public function direct_invoice(Request $request,$id)
    {
        $user = Auth::user();
        $to = $id;
        $other = User::find($to);
        $direct = Direct::where('u1',$user->id)->where('u2',$to)->first();
        if($direct===null){
            $direct = Direct::where('u2',$user->id)->where('u1',$to)->first();
        }
        if($direct===null){
            $room = new Room;
            $room->sender_id=$user->id;
            $room->direct=1;
            $room->save();
            $room->users()->save($user);
            if($user->id!==$other->id){
                $room->users()->save($other);
            }
            $direct=new Direct();
            $direct->u1 = $user->id;
            $direct->u2 = $other->id;
            $direct->room_id = $room->id;
            $direct->save();
        }else{
            $room=$direct->room;
        }
        return redirect('/room/invoice/create/' . $room->id);


    }

        public function normal_message(Request $request){


        $user = Auth::user();
        $room = Room::find($request->id);
        $advert=$room->advert;

        $message = new Message;
        $message->message=$request->message;
        $message->from_msg=$user->id;
        if($advert!==null)
        $message->to_msg=$advert->user_id;
        else
            $message->to_msg=0;
        $message->room_id=$room->id;
        if($request->has('url')){
            $message->url=$request->url;
        }
        if($request->has('type')){
            $message->url=$request->type;
        }
        $message->save();

        $room->modify();
        $this->notify($room,$message);
        $message->room = $message->room;

        return ['mid'=>$message->id,'msg'=>'sent','message'=>$message];

    }
    public function room(Request $request,$id){
        $room =  Room::find($id);
        $room->users=$room->users()->pluck('user_id')->toArray();
        return $room;
    }
    public function create_call(Request $request){
        $advert=Advert::find($request->id);
        $user = Auth::user();

        $room = Room::where('advert_id',$advert->id)->where('sender_id',$user->id)->first();
        if($room===null){
            $room = new Room;
            $room->advert_id = $advert->id;
            $room->image=$advert->first_image();
            $room->title=$advert->param('title');
            $room->sender_id=$user->id;
            $room->sender_id=$user->id;
            $room->save();
            $room->users()->save($user);
            if($user->id!==$advert->user_id){
                if($advert->user===null){
                    $room->users()->save(User::find(1));
                }else{

                    $room->users()->save($advert->user);
                }
            }
            $advert->replies++;
            $advert->save();
        }




        $message = new Message;
        $message->message='Call';
        $message->from_msg=$user->id;
        $message->to_msg=$advert->user_id;
        $message->room_id=$room->id;
        $message->url='';
        $message->save();
        $room->modify();

        foreach ($room->users as $usr) {
            if ($usr->id !== $user->id) {
                foreach ($usr->android as $token) {
                    $this->android_call($token, ['title' => $advert->param('title'), 'subtitle' => $usr->name, 'group' => $request->group, 'action' => 'call', 'video' => $request->video,'room_id'=>$room->id]);
                }
                foreach ($usr->voip as $token) {
                    $this->ios_call($token, ['title' => $advert->param('title'), 'subtitle' => $usr->name, 'group' => $request->group, 'action' => 'call', 'video' => $request->video,'room_id'=>$room->id]);
                }
            }
        }



        return ['msg'=>'sent','room_id'=>$room->id];
    }

    public function call(Request $request){
        $user = Auth::user();
        try{
            $room = Room::find($request->id);


            $advert=$room->advert;



            $message = new Message;
            $message->message='Call';
            $message->from_msg=$user->id;
            $message->to_msg=$advert->user_id;
            $message->room_id=$room->id;
            $message->url='';
            $message->save();
            $room->modify();

            foreach ($room->users as $usr) {
                if ($usr->id !== $user->id) {
                    foreach ($usr->android as $token) {
                        $this->android_call($token, ['title' => $advert->param('title'), 'subtitle' => $usr->name, 'group' => $request->group, 'action' => 'call', 'video' => $request->video,'room_id'=>$room->id]);
                    }
                    foreach ($usr->voip as $token) {
                        $this->ios_call($token, ['title' => $advert->param('title'), 'subtitle' => $usr->name, 'group' => $request->group, 'action' => 'call', 'video' => $request->video,'room_id'=>$room->id]);
                    }
                }
            }



            return ['msg'=>'sent','room_id'=>$room->id];
        }catch (\Exception $exception){
            return $exception;
        }

    }
    public function end_call(Request $request){
        $user = Auth::user();

        $room = Room::find($request->id);



        foreach ($room->users as $usr) {
            if ($usr->id !== $user->id) {
                foreach ($usr->android as $token) {
                    $this->android_call($token, [  'action' => 'end','room_id'=>$room->id]);
                }
            }
        }






        return ['msg'=>'sent'];
    }

    public function all_messages(Request $request){
        $user = Auth::user();
        $rooms = $user->rooms()->pluck('room_id')->toArray();
        if($request->has('time')){
            $x=date('Y-m-d H:i:s',$request->time);
            $messages = Message::where('created_at','>',$x)->whereIn('room_id',$rooms)->get();

        }else{
            $messages = Message::whereIn('room_id',$rooms)->get();

        }
        $msgs = [];
        foreach ($messages as $message){
            $message->room = $message->room;
            if($message->room->direct===1){
                $message->room->title = $message->room->otitle();
                $message->room->image = $message->room->profile_image();
            }

            $msgs[]=$message;
        }

         return $msgs;

    }
    public function all_rooms(Request $request){
        $user = Auth::user();
        return $user->rooms;
    }

        public function rsend(Request $request){
        if($request->has('g-recaptcha-response')){
            $user = Auth::user();

            $room = Room::find($request->rid);

            $advert=$room->advert;

            $message = new Message;
            $message->message=$request->message;
            $message->from_msg=$user->id;
            if($advert!==null)
            $message->to_msg=$advert->user_id;
            $message->room_id=$room->id;
            if($request->has('url')){
                $message->url=$request->url;
            }

            $message->save();

            $room->modify();
            $this->notify($room,$message);



        }

        return redirect('/user/manage/messages/'.$request->rid);

    }


}