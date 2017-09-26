<?php
/**
 * Created by PhpStorm.
 * User: sumra
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
}