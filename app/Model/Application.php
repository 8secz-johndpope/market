<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 01/09/2017
 * Time: 12:09
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Application extends Model
{
    public function cover(){
        return $this->belongsTo('App\Model\Cover');
    }
}