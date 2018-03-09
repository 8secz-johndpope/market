<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 01/09/2017
 * Time: 12:09
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Application extends Model
{
    const STATUS = array('Pending', 'Rejected', 'Cancel', 'Interview', 'Accepted');
    public function cover(){
        return $this->belongsTo('App\Model\Cover');
    }

    public function advert(){
        return $this->belongsTo('App\Model\Advert');
    }
    public function cv(){
        return $this->belongsTo('App\Model\Cv');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
}