<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 15/09/2017
 * Time: 12:16
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ContractPack extends Model
{
    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function location(){
        return $this->belongsTo('App\Model\Location');
    }
}