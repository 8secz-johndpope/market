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
    public function total_before_discount(){
        return $this->packs->sum('amount')/100;
    }
    public function total_after_discount(){
        return (1-$this->discount/100)*$this->packs->sum('amount')/100;
    }
    public function total_after_vat(){
        return 1.2*(1-$this->discount/100)*$this->packs->sum('amount')/100;
    }
    public function minimum_payment(){
        return $this->minimum/100;
    }
}