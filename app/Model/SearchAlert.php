<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 13/10/2017
 * Time: 20:56
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SearchAlert extends Model
{
    public $timestamps=false;

    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function location(){
        return $this->belongsTo('App\Model\Location');
    }
}