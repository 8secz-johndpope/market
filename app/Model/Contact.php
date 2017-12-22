<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 22/12/2017
 * Time: 18:05
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Contact extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}