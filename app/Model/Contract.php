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
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function total_before_discount(){
        return $this->packs->sum('amount')/100;
    }
    public function total_discount(){
        return ($this->discount/100)*$this->packs->sum('amount')/100;
    }
    public function total_after_discount(){
        return (1-$this->discount/100)*$this->packs->sum('amount')/100;
    }
    public function total_vat(){
        return 0.2*(1-$this->discount/100)*$this->packs->sum('amount')/100;
    }
    public function total_after_vat(){
        return 1.2*(1-$this->discount/100)*$this->packs->sum('amount')/100;
    }
    public function minimum_payment(){
        return $this->minimum/100;
    }
    public function deposit(){
        return 0.05*$this->total_after_vat();
    }
    public function monthly_payment(){
        return .95*$this->total_after_vat()/12;
    }
    public function days(){
        for($i=1;$i<=12;$i++){
            $days[] = date('d-m-Y',strtotime('+90 days +'.$i.' months'));
        }
        return $days;
    }
    public function fdays(){
        for($i=1;$i<=12;$i++){
            $days[] = date('Y-m-d H:i:s',strtotime('+90 days +'.$i.' months'));
        }
        return $days;
    }
    public function payments(){
        return $this->hasMany('App\Model\Payment');
    }
    public function future_payments(){
        foreach ($this->fdays() as $day){
            $payment = new Payment;
            $payment->charge_at = $day;
            $payment->contract_id = $this->id;
            $payment->amount = (int)$this->monthly_payment()*100;
            $payment->reference = strtoupper(uniqid());
            $payments[] = $payment;
        }
        return $payments;
    }
}