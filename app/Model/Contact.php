<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 22/12/2017
 * Time: 18:05
 */

namespace App\Model;
use App\User;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function is_user(){
        if($this->uid>0)
            return true;
        $user = User::where('email',$this->email)->first();
        if($user!==null){

            $this->uid = $user->id;
            $this->save();
            return true;
        }
        $user = User::where('phone',$this->phone)->first();
        if($user!==null) {
            $this->uid = $user->id;
            $this->save();
            return true;
        }

        return false;
    }
    public function uid(){
        $user = User::find($this->uid);
        if($user!==null)
            return $user->id;

        return 0;
    }
    public function u(){
        $user = User::find($this->uid);
        if($user!==null)
            return $user;
        return 0;
    }
}