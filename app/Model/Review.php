<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 01/09/2017
 * Time: 17:01
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends  Model
{
    public function author(){
        return $this->belongsTo('App\User');
    }

}