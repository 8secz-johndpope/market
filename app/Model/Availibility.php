<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Availibility extends Model
{
	public $timestamps = false;

	public function avialibilityTime(){
		return $this->hasMany('App\Model\AvailibilityTime')->groupBy('time');
	}
}