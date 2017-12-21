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
}