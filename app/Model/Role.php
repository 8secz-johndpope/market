<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/09/2017
 * Time: 19:35
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}