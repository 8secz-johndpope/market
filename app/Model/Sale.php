<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 26/10/2017
 * Time: 14:30
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    public function amount() {
        $advert = $this->advert;
        if($this->type===0)
        return $advert->amount()+$advert->delivery();
        else if($this->type===1){
            return $advert->amount()+$advert->shipping();
        }else{
            return $advert->amount();
        }
    }
    public function advert()
    {
        return $this->belongsTo('App\Model\Advert');
    }
}