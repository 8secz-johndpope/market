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
        return $this->belongsTo('App\Model\Address');
    }
    public function buyer(){
        return $this->hasMany('App\User');
    }
    public function seller(){
        return $this->hasMany('App\User');
    }
}