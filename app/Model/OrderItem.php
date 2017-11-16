<?php
/**
 * Created by PhpStorm.
 * User: Anil
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
    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function location(){
        return $this->belongsTo('App\Model\Location');
    }

    public function advert(){
        return $this->belongsTo('App\Model\Advert');
    }

    public function order()
    {
        return $this->belongsTo('App\Model\Order');
    }

    public function price()
    {
        $price = Price::price($this->category->id,$this->location->id);
        if(Pack::has_packs($this->type->key,$this->category->id,$this->location->id)) {
            return 0;
        }else{
            return ($price->{$this->type->key})/100;
        }
    }
    public function pack()
    {
        return Pack::pack($this->type->key,$this->category->id,$this->location->id);
    }
}