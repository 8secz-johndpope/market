<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 31/08/2017
 * Time: 14:11
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Price extends  BaseModel
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

        $price = Price::whereIn('category_id', $catids)->whereIn('location_id', $locids)->orderBy('id','desc')->first();
        if($price===null)
            return Price::lprice($location);
    }
    public static function lprice($location){
        $westminister = Location::find(1931);
        $location=Location::find($location);
        $part = $location->ratio()/$westminister->ratio();
        $max = Price::find(19);
        $max->urgent = (int)($part*$max->urgent);
        $max->spotlight = (int)($part*$max->spotlight);
        $max->featured = (int)($part*$max->featured);
        $max->featured_3 = (int)($part*$max->featured_3);
        $max->featured_14 = (int)($part*$max->featured_14);
        if($max->urgent<100){
            $max->urgent=100;
        }
        if($max->spotlight<300){
            $max->spotlight=300;
        }
        if($max->featured<200){
            $max->featured=200;
        }
        if($max->featured_3<100){
            $max->featured_3=100;
        }
        if($max->featured_14<300){
            $max->featured_14=300;
        }
        return $max;
    }

        public static function mprice($category,$location){
        $cat = Category::find($category);
        $sloc = Location::find($location);

        $prices = Price::all();
        $mprice = Price::find(17);
        //$all=array();
        foreach ($prices as $price){
            if(($price->category->is_parent($cat->id)||$cat->is_parent($price->category->id))&&($sloc->is_parent($price->location->res)||$price->location->is_parent($sloc->res))){
                if($price->urgent>$mprice->urgent)
                    $mprice=$price;
            }
        }
        return $mprice;
    }
    public  function count(){
        $category = Category::find($this->category_id);
        $location = Location::find($this->location_id);
        $musts=array();
        $musts['category']= [
            'range' => [
                'category' => [
                    'gte'=>$category->id,
                    'lte'=>$category->ends
                ]
            ]
        ];

        $musts['location_id']= [
            'range' => [
                'location_id' => [
                    'gte'=>$location->res,
                    'lte'=>$location->ends
                ]
            ]
        ];
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'body' => [
                'size'=>0,
                'query' => [
                    'bool' => [
                        'must' => array_values($musts),
                        /*     'filter' => $filte */
                    ]
                ],
            ]
        ];
        $response = $this->client->search($params);
        $total= $response['hits']['total'];
        return $total;
    }
}