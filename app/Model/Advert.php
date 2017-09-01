<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 05/08/2017
 * Time: 15:24
 */
namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class Advert extends  Model
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

}