<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 07/09/2017
 * Time: 13:49
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ExtraPrice extends  Model
{
    public function items()
    {
        return $this->hasMany('App\Model\OrderItem');
    }
    public $table = "extra_pricesx";

}