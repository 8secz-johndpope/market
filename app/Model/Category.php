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

<<<<<<< HEAD
=======
    /**
     * This function return all descendants of a category
     * @return [Colletion] with the children and its descendants
     */
    public function getAllDescendants(){
        if($this->children()->count() == 0){
            return null;
        }
        else{
            /*$categories = Categories::getInstance()->getCategories();
            foreach($categories as $cat){
                if($cat->parent_id == $this->id){
                    if(isset($this->children))
                        $this->children = array();
                    array_push($this->children, $cat);
                }
            }*/
            $descendants = $this->children()->get();
            //$categories = Categories::getInstance()->getCategories();
            foreach ($descendants as $child) {
                $child->children = $child->getAllDescendants();
            }
        }
        return $descendants;
    }
>>>>>>> ae75c38353ddef7f0c3146344d16880d69b2e5e2
    public function parent(){
        return $this->belongsTo('App\Model\Category');
    }
    public function fields(){
        return $this->belongsToMany('App\Model\Field');
    }
}