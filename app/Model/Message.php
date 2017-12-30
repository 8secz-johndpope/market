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
    public function toUser()
    {
        return $this->belongsTo('App\User','to_msg');
    }
    public function room()
    {
        return $this->belongsTo('App\Model\Room');
    }
    public function invoice()
    {
        return $this->belongsTo('App\Model\Invoice');
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
    public function stringDateTime(){
        $milDate = strtotime($this->created_at) * 1000;
        $currentDate =  date_create();
        $dYearCreated = intval(date('z',strtotime($this->created_at)));
        $dYearCurrent = intval($currentDate->format('z'));
        $interval = date_diff(date_create($this->created_at), $currentDate);
        if($dYearCreated == $dYearCurrent){
            return date('H:i',strtotime($this->created_at));
        }
        else if(($dYearCreated + 1) == $dYearCurrent){
            return 'Yesterday';
        }
        else if($interval->d > 0 && $interval->d < 5){
            return date('l',strtotime($this->created_at));
        }
        return date('d/m/Y',strtotime($this->created_at));
    }
}