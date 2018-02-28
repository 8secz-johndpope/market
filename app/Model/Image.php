<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 14/10/2017
 * Time: 21:01
 */

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function imagetable(){
    	return $this->morphTo();
    }
}