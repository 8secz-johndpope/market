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

}