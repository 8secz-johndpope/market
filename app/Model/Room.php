<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 3:06 AM
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


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
        return $this->hasMany('App\Model\Message');
    }
    public function last_message(){
        $message = Message::where('room_id',$this->id)->orderby('id','desc')->first();
        return $message;
    }
}