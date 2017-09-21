<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 18/08/2017
 * Time: 16:25
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function items(){
        return $this->hasMany('App\Model\OrderItem');
    }
    public function address(){
        return $this->belongsTo('App\Model\Address');
    }
    public function buyer(){
        return $this->belongsTo('App\User');
    }
    public function seller(){
        return $this->belongsTo('App\User');
    }
    public function contract(){
        return $this->belongsTo('App\Model\Contract');
    }
    public function invoice(){
        return $this->belongsTo('App\Model\Payment');
    }
    public function amount(){
        if($this->type==='bump')
            return $this->amount ;
        else if($this->type==='contract')
            return $this->contract->deposit();
        else if($this->type==='invoice')
            return $this->invoice->amount/100;
    }
    public function amount_in_pence(){
        if($this->type==='bump')
            return (int)($this->amount * 100);
        else if($this->type==='contract')
            return (int)($this->contract->deposit()*100);
        else if($this->type==='invoice')
            return $this->invoice->amount;

    }
}