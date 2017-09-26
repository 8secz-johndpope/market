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
        return ExtraPrice::where('id',$this->extra_price_id)->first();
    }


    public function order()
    {
        return $this->belongsTo('App\Model\Order');
    }

    public function price()
    {
        $price = Price::price($this->order->category->id,$this->order->location->id);
        if(Pack::has_packs($this->type()->key,$this->order->category->id,$this->order->location->id)) {
            return 0;
        }else{
            return ($price->{$this->type()->key})/100;
        }
    }
    public function pack()
    {
        return Pack::pack($this->type()->key,$this->order->category->id,$this->order->location->id);
    }
}