<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 12/08/2017
 * Time: 15:10
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends  BaseModel
{
    public $timestamps = false;
    public function children()
    {
        return $this->hasMany('App\Model\Category','parent_id')->orderBy('title');
    }

    public function mchildren()
    {
        return $this->hasMany('App\Model\Category','parent_id')->orderBy('title')->limit(7);
    }

    public function parent(){
        return $this->belongsTo('App\Model\Category');
    }
    public function fields(){
        return $this->belongsToMany('App\Model\Field')->orderBy('order_by');
    }
    public function filters(){
        return $this->belongsToMany('App\Model\Filter');
    }
    public function getCanFilterFields(){
        $parent = $this;
        if($this->can_apply()){
            $parent = Category::find(4000000000);    
        }
        return $parent->fields()->where('can_filter',1)->get();
    }
    public function has_price(){
        $price = CategoryField::where('category_id',$this->id)->where('field_id',10)->first();
        if($price)
            return true;
        else
            return false;
    }
    public function can_ship(){

        $forsale = Category::find(2000000000);

        if($this->id>=$forsale->id&&$this->id<=$forsale->ends)
            return true;
        else
            return false;
    }
    public function is_property_for_sale(){
        return $this->id===3060000000;
    }
    public function can_apply(){

        $jobs = Category::find(4000000000);

        if($this->id>=$jobs->id&&$this->id<=$jobs->ends)
            return true;
        else
            return false;
    }
    public function can_rent(){
        $rents = Category::find(3070000000);
        return $this->id == $rents->id;
    }
    public static function job_leaves(){
            $all=Category::where('id','>',4000000000)->where('id','<',5000000000)->orderBy('title')->get();
            $jobs=[];
            foreach ($all as $job){
                if(count($job->children)===0)
                    $jobs[]=$job;
            }
            return $jobs;
    }

    public function is_parent($id){
        if($this->id<=$id&&$this->ends>=$id){
            return true;
        }else{
            return false;
        }
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
    public function pstring(){
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
        return $parentstring;
    }
    public  function count(){

        $musts=array();
        $musts['category']= [
            'range' => [
                'category' => [
                    'gte'=>$this->id,
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
    public function is_property() {
        $property = Category::find(3000000000);

        if($this->id>=$property->id&&$this->id<=$property->ends)
            return true;
        else
            return false;
    }
}