<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 01/09/2017
 * Time: 11:43
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Favorite extends Model
{
    public function advert(){
        return $this->belongsTo('App\Model\Advert');
    }
}