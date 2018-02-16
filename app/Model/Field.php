<?php
/**
 * Created by PhpStorm.
 * User: Anil
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
    public function values() {
        return $this->hasMany('App\Model\FieldValue')->orderBy('title');
    }
    public function filters() {
        return $this->hasMany('App\Model\Filter');
    }
}