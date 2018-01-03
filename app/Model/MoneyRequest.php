<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 03/01/2018
 * Time: 18:37
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class MoneyRequest extends Model
{

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function other()
    {
        return $this->belongsTo('App\User');
    }
}