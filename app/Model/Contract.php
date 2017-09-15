<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 15/09/2017
 * Time: 12:19
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    public function packs(){
        return $this->hasMany('App\Model\ContractPack');
    }
}