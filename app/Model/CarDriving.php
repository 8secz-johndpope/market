<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class CarDriving extends Model
{
	public $timestamps = false;

	public function hasCar(){
		return $this->has_car;
	}
	public function hasLicence(){
		return $this->has_licence;
	}
}