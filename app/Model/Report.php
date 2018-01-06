<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 01/09/2017
 * Time: 16:02
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function advert()
    {
        return $this->belongsTo('App\Model\Advert');
    }
}