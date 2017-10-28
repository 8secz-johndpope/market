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
}