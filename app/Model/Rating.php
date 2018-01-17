<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 17/01/2018
 * Time: 20:07
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function author(){
        return $this->belongsTo('App\User');
    }
}