<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 12/08/2017
 * Time: 15:10
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends  Model
{
    public $timestamps = false;
    public function children()
    {
        return $this->hasMany('App\Model\Category','parent_id');
    }
    public function mchildren()
    {
        return $this->hasMany('App\Model\Category','parent_id')->limit(10);
    }
    public function parent(){
        return $this->belongsTo('App\Model\Category');
    }
    public function fields(){
        return $this->belongsToMany('App\Model\Field');
    }
}