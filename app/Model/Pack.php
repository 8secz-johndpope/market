<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 13/09/2017
 * Time: 16:52
 */

namespace App\Model;
use Illuminate\Support\Facades\Auth;

use Illuminate\Database\Eloquent\Model;

class Pack extends Model
{
    public static function has_packs($type,$category,$location){
        $user = Auth::user();
        if(!$user->contract||$user->contract->enabled===0)
        {
            return false;
        }
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
        $packs = $user->packs()->where('type',$type)->whereIn('category_id', $catids)->whereIn('location_id', $locids)->where('remaining','>',0)->get();
        if(count($packs)>0)
            return true;
        else
            return false;

    }
    public static function pack($type,$category,$location){
        $user = Auth::user();
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
        $pack = $user->packs()->where('type',$type)->whereIn('category_id', $catids)->whereIn('location_id', $locids)->where('remaining','>',0)->first();
       return $pack;

    }
    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function location(){
        return $this->belongsTo('App\Model\Location');
    }
    public function type(){
        return ExtraPrice::where('key',$this->type)->first();
    }
}