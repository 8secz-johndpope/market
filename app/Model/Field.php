<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 12/08/2017
 * Time: 17:08
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Field extends  Model
{
    public function categories(){
        return $this->belongsToMany('App\Model\Category');
    }
}