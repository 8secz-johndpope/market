<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 01/09/2017
 * Time: 19:47
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{

    public function nice_date(){
       return date("d-m-Y", strtotime($this->charge_at));
    }
    public function nice_amount(){
        return $this->amount/100;
    }
    public function contract(){
        return $this->belongsTo('App\Model\Contract');
    }
    public function vat(){
        return $this->amount/600;
    }
    public function before_vat(){
        return 5*$this->amount/600;
    }
}