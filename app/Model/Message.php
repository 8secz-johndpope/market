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
        $dYearCreated = date('z',strtotime($this->created_at));
        $interval = date_diff(date_create($this->created_at), $currentDate);
        var_dump($dYearCreated);
        var_dump($interval->days);
        $diff = (date_timestamp_get($currentDate) * 1000) - $milDate;
        $diffOneDay = 24*3600*1000;
        if($diff < $diffOneDay){
            return date('H:i',strtotime($this->created_at));
        }
        /*else if($diffOneDay < $diff && ($diffOneDay * 2) > $diff){*/
        else if($interval->days > 1){
            return 'Yesterday';
        }
        /*else if(($diffOneDay*2) < $diff && ($diffOneDay * 5) > $diff){*/
        else if($interval->days > 5){
            return date('l',strtotime($this->created_at));
        }
        return date('d/m/Y',strtotime($this->created_at));;
    }
}