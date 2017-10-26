<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 26/10/2017
 * Time: 14:30
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Sale extends Model
{
    public function amount() {
        return 10.00;
    }
}