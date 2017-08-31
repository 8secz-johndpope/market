<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 31/08/2017
 * Time: 18:05
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Offer extends  Model
{
    public function user(){
        return $this->hasOne('App\User');
    }
}