<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 18/08/2017
 * Time: 16:25
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

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
    public function category(){
        return $this->belongsTo('App\Model\Category');
    }
    public function location(){
        return $this->belongsTo('App\Model\Location');
    }
    public function invoice(){
        return $this->belongsTo('App\Model\Payment','payment_id');
    }
    public function amount(){
        $user = Auth::user();
        if($this->type==='bump')
        {
            $total = 0;
            foreach ($this->items as $item){
                $total += $item->price();
            }
            return $total;
        }
        else if($this->type==='contract')
        {
            if($user->contract===null)
                return $this->contract->deposit();
            else
                return $this->contract->deposit()+$user->contract->settlement_amount()/100;
        }

        else if($this->type==='invoice')
            return $this->invoice->amount/100;
    }
    public function amount_in_pence(){
        $user = Auth::user();
        if($this->type==='bump')
        {
            $total = 0;
            foreach ($this->items as $item){
                $total += $item->price();
            }
            return $total*100;
        }
        else if($this->type==='contract')
        {
            if($user->contract===null)
                return (int)($this->contract->deposit()*100);
            else
                return 100*$this->contract->deposit()+$user->contract->settlement_amount();
        }

        else if($this->type==='invoice')
            return $this->invoice->amount;

    }
}