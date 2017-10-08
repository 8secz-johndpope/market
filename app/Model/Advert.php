<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 15:24
 */
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Advert extends  BaseModel
{
    public $dict=null;
    public function offers()
    {
        return $this->hasMany('App\Model\Offer');
    }
    public function interests()
    {
        return $this->hasMany('App\Model\Interest');
    }
    public function favorites()
    {
        return $this->hasMany('App\Model\Favorite');
    }
    public function applications()
    {
        return $this->hasMany('App\Model\Application');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function fetch(){
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic
        ];
        $response = $this->client->get($params);
        $this->dict = $response['_source'];
    }
    public function make_inactive(){
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic,
            'body' => [
                'doc' => [
                    'inactive' => 1
                ]
            ]

        ];
        $response = $this->client->update($params);
    }
    public function param($param){
       if($this->dict===null)
           $this->fetch();

        return $this->dict[$param];
    }
    public function has_param($param){
        if($this->dict===null)
            $this->fetch();
        return isset($this->dict[$param]);
    }

    public function first_image(){
        if($this->dict===null)
            $this->fetch();
        if(count($this->dict['images'])>0)
            return $this->dict['images'][0];
        else
            return 'noimage.png';
    }
    public function meta($param){


        if(isset($this->dict['meta'][$param]))
        return $this->dict['meta'][$param];
        else
            return '';
    }
    public function featured_expires(){
        $milliseconds = round(microtime(true) * 1000);
        if($this->dict===null)
            $this->fetch();
        if(isset($this->dict['featured_expires']))
        {
            $diff = $this->dict['featured_expires']-$milliseconds;
            if($diff<0)
                return false;
            return ((int)($diff/(24*60*60000))+1);
        }else{
            return false;
        }

    }
    public function urgent_expires(){
        $milliseconds = round(microtime(true) * 1000);
        if($this->dict===null)
            $this->fetch();
        if(isset($this->dict['urgent_expires']))
        {
            $diff = $this->dict['urgent_expires'] - $milliseconds;
            if($diff<0)
                return false;
            return ((int)($diff/(24*60*60000))+1);
        }else{
            return false;
        }

    }
    public function spotlight_expires(){
        $milliseconds = round(microtime(true) * 1000);
        if($this->dict===null)
            $this->fetch();
        if(isset($this->dict['spotlight_expires']))
        {
            $diff = $this->dict['spotlight_expires']-$milliseconds;
            if($diff<0)
                return false;
            return ((int)($diff/(24*60*60000))+1);
        }else{
            return false;
        }

    }
    public function posted(){
        $milliseconds = round(microtime(true) * 1000);
        if($this->dict===null)
            $this->fetch();
        $diff = $milliseconds-$this->dict['created_at'];
        if($diff<60*1000){
            $posted = 'Just Now';
        }
        else if($diff<60*60*1000){
            $posted = (int)($diff/60000).'m ago';
        }
        else if($diff<24*60*60*1000){
            $posted = (int)($diff/(60*60000)).'h ago';
        }else{
            $posted = (int)($diff/(24*60*60000)).'d ago';
        }
        return $posted;
    }
    public function first_created(){
        $milliseconds = round(microtime(true) * 1000);

        if($this->dict===null)
            $this->fetch();
        $milliseconds2 = round(strtotime($this->created_at) * 1000);

        $diff = $milliseconds-$milliseconds2;
        if($diff<60*1000){
            $posted = 'Just Now';
        }
        else if($diff<60*60*1000){
            $posted = (int)($diff/60000).' minutes ago';
        }
        else if($diff<24*60*60*1000){
            $posted = (int)($diff/(60*60000)).' hours ago';
        }else{
            $posted = (int)($diff/(24*60*60000)).' days ago';
        }
        return $posted;
    }
    public function location(){
        if($this->dict===null)
            $this->fetch();
        return Location::where('res',$this->dict['location_id'])->first();
    }

}