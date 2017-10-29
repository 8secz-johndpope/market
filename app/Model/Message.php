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
}