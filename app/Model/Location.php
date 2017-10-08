<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 10/09/2017
 * Time: 12:51
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Location extends  BaseModel
{
    public $timestamps = false;
    public function children()
    {
        return $this->hasMany('App\Model\Location','parent_id');
    }
    public function postcodes()
    {
        return $this->hasMany('App\Model\Postcode')->where('active',1);
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
    public function product(){
        return ($this->max_lat-$this->min_lat)*($this->max_lng-$this->min_lng);
    }
    public function string(){
        if($this->id===0)
            return $this->title;
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
    public  function count(){
        $musts=array();


        $musts['location_id']= [
            'range' => [
                'location_id' => [
                    'gte'=>$this->res,
                    'lte'=>$this->ends
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
    public function ratio(){
        return $this->count()/count($this->postcodes);
    }
}