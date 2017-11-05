<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 28/10/2017
 * Time: 13:15
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Message extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','from_msg');
    }
    public function previous(){
        return Message::where('room_id',$this->room_id)->where('id','<',$this->id)->orderBy('id','desc')->first();
    }
    public function next(){
        return Message::where('room_id',$this->room_id)->where('id','>',$this->id)->first();
    }
    public function timestamp(){
        return date('H:i',strtotime($this->created_at));
    }
    public function day(){
        return date('D d M',strtotime($this->created_at));
    }
}