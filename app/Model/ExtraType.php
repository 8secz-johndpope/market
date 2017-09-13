<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 07/09/2017
 * Time: 13:49
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class ExtraType extends Model
{
    public function prices($category,$lat,$lng)
    {

        $locations = Location::where('min_lat','<',$lat)->where('max_lat','>',$lat)->where('min_lng','<',$lng)->where('max_lng','>',$lng)->get();
        //return $locations;
        foreach ($locations as $location){
            if(count($location->children)===0){
                $sloc = $location;
                break;
            }else{
                $sloc = $location;
            }
        }

        $current = Category::find($category);
        while($current!==null){
            $sprice = $sloc->prices()->where('category_id',$current->id)->first();
            if($sprice===null){
                $current=$current->parent;
            }else{
                break;
            }
        }
        $cat = Category::find($category);
        $cats[] = $cat;
        $current=$cat;
        while($current->parent!==null)
            $cats[] = $current->parent;

        $current = $sloc;
        $locs[] = $sloc;
        while ($current->parent!==null)
            $locs[] = $current->parent;

        $catids = array_map(function($a){
            return $a->id;
        },$cats);
        $locids = array_map(function($a){
            return $a->id;
        },$locs);

        $prices = $this->hasMany('App\Model\ExtraPrice')->get();
        $all = array();
        foreach ($prices as $price){
            $user = Auth::user();
            $packs = $user->packs()->where('type',$price->key)->whereIn('category_id', $catids)->whereIn('location_id', $locids)->get();
            if(count($packs)>0){
                $price->price = 0;
            }else{
                $price->price = $sprice->{$price->key};
            }

            $all[] = $price;
        }
        return $all;
    }
    public function price($category,$lat,$lng)
    {
        $locations = Location::where('min_lat','<',$lat)->where('max_lat','>',$lat)->where('min_lng','<',$lng)->where('max_lng','>',$lng)->get();
        foreach ($locations as $location){
            if(count($location->children)===0){
                $sloc = $location;
                break;
            }else{
                $sloc = $location;
            }
        }

        $current = Category::find($category);
        while($current!==null){
            $sprice = $sloc->prices()->where('category_id',$current->id)->first();
            if($sprice===null){
                $current=$current->parent;
            }else{
                break;
            }

        }

        $cat = Category::find($category);
        $cats[] = $cat;
        $current=$cat;
        while($current->parent!==null)
            $cats[] = $current->parent;

        $current = $sloc;
        $locs[] = $sloc;
        while ($current->parent!==null)
            $locs[] = $current->parent;

        $catids = array_map(function($a){
            return $a->id;
        },$cats);
        $locids = array_map(function($a){
            return $a->id;
        },$locs);

        $price = $this->hasMany('App\Model\ExtraPrice')->first();

        $user = Auth::user();
        $packs = $user->packs()->where('type',$price->key)->whereIn('category_id', $catids)->whereIn('location_id', $locids)->get();
        if(count($packs)>0){
            $price->price = 0;
        }else{
            $price->price = $sprice->{$price->key};
        }

        return $price;
    }
}