<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 20/08/2017
 * Time: 12:01
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    public $timestamps = false;
    public function categories(){
        return $this->belongsToMany('App\Model\Category');
    }
    public function values() {
        return $this->hasMany('App\Model\FilterValue');
    }
}