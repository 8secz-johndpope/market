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
    /**
     * [getBase description]
     * @return [type] [description]
     */
    public static function getBase(){
        return self::where('parent_id',0)->get();
    }
    /**
     * [firstChildren description]
     * @param  int    $max
     * @return [type]      [description]
     */
    public function firstChildren(int $max){
        return $this->children()->limit($max)->get();
    }

    /**
     * [getAllDescendants description]
     * @return [type] [description]
     */
    public function getAllDescendants(){
        $descendants = $this->children()->get();
        if($descendants){
            //TODO 
        }
        return $descendants
    }
    public function parent(){
        return $this->belongsTo('App\Model\Category');
    }
    public function fields(){
        return $this->belongsToMany('App\Model\Field');
    }
}