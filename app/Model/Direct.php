<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 21/12/2017
 * Time: 18:40
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Direct extends Model
{
    public function room()
    {
        return $this->belongsTo('App\Model\Room');
    }
    public function user1()
    {
        return $this->belongsTo('App\User','u1');
    }
    public function user2()
    {
        return $this->belongsTo('App\User','u2');
    }
}