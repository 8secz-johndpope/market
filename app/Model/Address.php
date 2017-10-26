<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 13/08/2017
 * Time: 17:59
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Address extends  Model
{
    public $timestamps = false;
    public function zip()
    {
        return $this->belongsTo('App\Model\Postcode');
    }

}