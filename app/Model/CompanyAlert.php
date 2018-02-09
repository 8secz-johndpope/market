<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CompanyAlert extends Model
{
    public $timestamps=false;

    public function user(){
        return $this->belongsTo('App\Model\user');
    }
    public function business(){
        return $this->belongsTo('App\Model\Business');
    }
}