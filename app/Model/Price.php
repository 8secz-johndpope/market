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
        return $this->belongsTo('App\Model\Location');
    }

    public function category()
    {
        return $this->belongsTo('App\Model\Category');
    }
    public static function price($category,$location){
        $cat = Category::find($category);
        $sloc = Location::find($location);

        $cats[] = $cat;
        $current=$cat;
        while($current->parent!==null){
            $cats[] = $current->parent;
            $current = $current->parent;
        }


        $current = $sloc;
        $locs[] = $sloc;
        while ($current->parent!==null){
            $locs[] = $current->parent;
            $current=$current->parent;
        }


        $catids = array_map(function($a){
            return $a->id;
        },$cats);
        $locids = array_map(function($a){
            return $a->id;
        },$locs);

        return Price::whereIn('category_id', $catids)->whereIn('location_id', $locids)->orderBy('id','desc')->first();
    }
    public static function mprice($category,$location){
        $cat = Category::find($category);
        $sloc = Location::find($location);

        $prices = Price::all();
        $mprice = Price::find1(1);
        foreach ($prices as $price){
            if($cat->is_parent($price->category->id)&&$sloc->is_parent($price->location->id)){
                if($price->urgent>$mprice->urgent)
                    $mprice=$price;
            }
        }
        return $mprice;
    }
}