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
    public function timestamp(){
        return date('H:i',strtotime($this->created_at));
    }
    public function day(){
        $current = strtotime(date("Y-m-d"));
        $yesterday = $current - 24*60*60;
        $msg = strtotime(date('Y-m-d',strtotime($this->created_at)));

        $diff = $msg-$current;
        if($diff<24*3600){
            return 'Today';
        }
        $diff = $msg-$yesterday;
        if($diff<24*3600*2){
            return 'Yesterday';
        }
        return date('D d M',strtotime($this->created_at));
    }
}