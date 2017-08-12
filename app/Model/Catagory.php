<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 12/08/2017
 * Time: 15:10
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Catagory extends  Model
{
    public $timestamps = false;
    public function children()
    {
        return $this->hasMany('App\Model\Catagory','parent');
    }
    public function parent(){
        return $this->hasOne('App\Model\Catagory','parent');
    }

}