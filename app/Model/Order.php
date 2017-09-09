<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 18/08/2017
 * Time: 16:25
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items(){
        return $this->hasMany('App\Model\OrderItem');
    }
    public function address(){
        return $this->hasMany('App\Model\Address');
    }
}