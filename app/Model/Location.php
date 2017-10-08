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
    public function prices(){
        return $this->belongsToMany('App\Model\Price');
    }
    public function is_parent($id){
        if($this->res<=$id&&$this->ends>=$id){
            return true;
        }else{
            return false;
        }
    }
    public function string(){
        $parents = array();
        $cur = $this;
        while ($cur->parent!==null){
            $parents[]=$cur->parent;
            $cur=$cur->parent;
        }
        $titles =  array_map(function ($a) {
            return $a->title;
        }, $parents);
        $titles =  array_reverse($titles);
        $parentstring = implode(' > ',$titles);
        return $parentstring.' > '.$this->title;
    }
}