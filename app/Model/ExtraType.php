<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 07/09/2017
 * Time: 13:49
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ExtraType extends Model
{
    public function prices($category,$lat,$lng)
    {

        $locations = Location::where('min_lat','<',$lat)->where('max_lat','>',$lat)->where('min_lng','<',$lng)->where('max_lng','>',$lng)->get();
        return $locations;
        foreach ($locations as $location){
            if(count($location->children)===0){
                $sloc = $location;
                break;
            }
        }
        $category= Category::find($category);
        foreach ($sloc->prices as $price){

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
        $prices = $this->hasMany('App\Model\ExtraPrice')->get();
        $all = array();
        foreach ($prices as $price){
            $price->price = $sprice->{'$price->key'};
            $all[] = $price;
        }
        return $all;
    }
    public function price($category,$lat,$lng)
    {
        $locations = Location::where('min_lat','<',$lat)->where('max_lat','>',$lat)->where('min_lng','<',$lng)->where('max_lng','>',$lng)->get();
        return $locations;
        foreach ($locations as $location){
            if(count($location->children)===0){
                $sloc = $location;
                break;
            }
        }
        $category= Category::find($category);
        foreach ($sloc->prices as $price){

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
        $price = $this->hasMany('App\Model\ExtraPrice')->first();
        $price->price = $sprice->{'$price->key'};

        return $price;
    }
}