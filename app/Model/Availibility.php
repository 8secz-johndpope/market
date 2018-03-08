<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Availibility extends Model
{
	public $timestamps = false;

	public function availibility_times(){
		return $this->hasMany('App\Model\AvailibilityTime');
	}
	public function availibility_time($idTime, $idDay){
		return $this->availibility_times()->where('time_id', '=', $idTime)->where('day_id', '=', $idDay)->first();
	}
	public function inHolidays(){
		return ($this->holidays == 1);
	}
	public function lastMinute(){
		return ($this->emergency == 1);
	}
	public function inNight(){
		return ($this->night == 1);
	}
}