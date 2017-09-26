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
    public function prices($category,$location)
    {
        $sprice = Price::price($category,$location);
       // return $locids;
        $prices = $this->hasMany('App\Model\ExtraPrice')->get();
        $all = array();
        foreach ($prices as $price){


            if(Pack::has_packs($price->key,$category,$location)){
                $price->price = 0;
            }else{
                $price->price = $sprice->{$price->key};
            }

            $all[] = $price;
        }
        return $all;
    }
    public function price($category,$location)
    {
        $sprice = Price::price($category,$location);


        $price = $this->hasMany('App\Model\ExtraPrice')->first();

        if(Pack::has_packs($price->key,$category,$location)){
            $price->price = 0;
        }else{
            $price->price = $sprice->{$price->key};
        }

        return $price;
    }
}