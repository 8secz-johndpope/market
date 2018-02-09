<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 16/09/2017
 * Time: 19:39
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Business extends Model
{
    public function address(){
        return $this->belongsTo('App\Model\Address');
    }
    public function user(){
    	return $this->belongsTo('App\Model\User');
    }
}