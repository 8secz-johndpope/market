<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 06/09/2017
 * Time: 16:42
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmailCode extends  Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }
}