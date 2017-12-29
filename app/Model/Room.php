<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 3:06 AM
 */

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Room extends Model
{
    public function advert()
    {
        return $this->belongsTo('App\Model\Advert');
    }
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function messages()
    {
        $user = Auth::user();
        $room_user = RoomUser::where('room_id',$this->id)->where('user_id',$user->id)->first();
        return $this->hasMany('App\Model\Message')->where('id','>',$room_user->last_message_id);
    }
    public function is_visible(){
        $user = Auth::user();
        $room_user = RoomUser::where('room_id',$this->id)->where('user_id',$user->id)->first();
        if($room_user->last_message_id<$this->last_message()->id){
            return true;
        }else{
            return false;
        }
    }
    public function last_message(){
        $message = Message::where('room_id',$this->id)->orderby('id','desc')->first();
        return $message;
    }
    public function modify(){
        $this->toggle=!$this->toggle;
        $this->unread=1;
        $this->save();
    }
    public function read(){
        $this->unread=0;
        $this->save();
    }
    public function conv()
    {
        return $this->hasOne('App\Model\Direct');
    }
    public function other(){
        $user = Auth::user();
        if($this->direct===1){
            if($this->conv->u1===$user->id){
                return User::find($this->conv->u2);
            }else{
                return User::find($this->conv->u1);
            }
        }
        foreach ($this->users as $usr){
            if($usr->id!==$user->id){
                return $usr;
            }
        }
        return $user;
    }
    public function others(){
        $user = Auth::user();
        $names = [];

        foreach ($this->users as $usr){
            if($usr->id!==$user->id){
                $names[] = $usr->display_name;
            }
        }
        return implode(',',$names);
    }
    public function profile_image(){
        if($this->direct===1){
            return $this->other()->image;
        }else{
            return $this->image;
        }
    }
    public function otitle(){
        if($this->direct===1){
            return $this->other()->display_name;
        }else{
            return $this->title;
        }
    }
}