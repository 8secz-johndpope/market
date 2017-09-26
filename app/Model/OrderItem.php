<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 07/09/2017
 * Time: 19:52
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    public function type()
    {
        return $this->belongsTo('App\Model\ExtraPrice');
    }

    public function order()
    {
        return $this->belongsTo('App\Model\ExtraType');
    }

    public function price()
    {
        $price = Price::price($this->order->category,$this->order->location);
        if(Pack::has_packs($this->type->key,$this->order->category,$this->order->location)) {
            return 0;
        }else{
            return ($price->{$this->type->key})/100;
        }
    }
}