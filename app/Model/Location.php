<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 10/09/2017
 * Time: 12:51
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends  Model
{
    public $timestamps = false;
    public function children()
    {
        return $this->hasMany('App\Model\Location','parent_id');
    }
    public function parent(){
        return $this->belongsTo('App\Model\Location');
    }
}