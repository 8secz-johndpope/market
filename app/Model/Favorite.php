<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 01/09/2017
 * Time: 11:43
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Favorite extends Model
{
    public function favorites($user_id){
        return $this->belongsTo('App\Model\Advert',$user_id);
    }
}