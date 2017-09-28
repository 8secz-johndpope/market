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
    public function param($param){
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic
        ];
        $response = $this->client->get($params);

        return $response['_source'][$param];
    }

    public function meta($param){
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic
        ];
        $response = $this->client->get($params);

        if(isset($response['_source']['meta'][$param]))
        return $response['_source']['meta'][$param];
        else
            return '';
    }
    public function featured_expires(){
        $milliseconds = round(microtime(true) * 1000);
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic
        ];
        $response = $this->client->get($params);
        if(isset($response['_source']['featured_expires']))
        {
            $diff = $response['_source']['featured_expires']-$milliseconds;
            return ((int)($diff/(24*60*60000))+1).' left';
        }else{
            return false;
        }

    }
    public function urgent_expires(){
        $milliseconds = round(microtime(true) * 1000);
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic
        ];
        $response = $this->client->get($params);
        if(isset($response['_source']['urgent_expires']))
        {
            $diff = $response['_source']['urgent_expires'] - $milliseconds;
            return ((int)($diff/(24*60*60000))+1).' left';
        }else{
            return false;
        }

    }
    public function spotlight_expires(){
        $milliseconds = round(microtime(true) * 1000);
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic
        ];
        $response = $this->client->get($params);
        if(isset($response['_source']['spotlight_expires']))
        {
            $diff = $response['_source']['spotlight_expires']-$milliseconds;
            return ((int)($diff/(24*60*60000))+1).' left';
        }else{
            return false;
        }

    }
    public function posted(){
        $milliseconds = round(microtime(true) * 1000);
        $params = [
            'index' => 'adverts',
            'type' => 'advert',
            'id' => $this->elastic
        ];
        $response = $this->client->get($params);
        $diff = $milliseconds-$response['_source']['created_at'];
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

}