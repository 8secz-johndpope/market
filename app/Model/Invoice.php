<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 30/11/2017
 * Time: 16:41
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Invoice extends Model
{
    public function items(){
        return $this->hasMany('App\Model\InvoiceItem');
    }
    public function amount(){
          $total = 0;
            foreach ($this->items as $item){
                $total += $item->amount;
            }
            return $total/100;

    }
}