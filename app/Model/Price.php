<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 31/08/2017
 * Time: 14:11
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Price extends  Model
{
    public function location()
    {
        return $this->hasOne('App\Model\Location');
    }

    public function category()
    {
        return $this->hasOne('App\Model\Category');
    }
}