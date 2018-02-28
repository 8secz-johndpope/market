<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ProfileAdditionalInfo extends Model
{
	public $timestamps = false;

	public function hasChildren(){
		return ($this->has_children == 1) ? true : false;
	}
	public function isSmoker(){
		return ($this->is_smoker == 1) ? true : false;
	}
	public function hasFirstAid(){
		return ($this->has_first_aid == 1) ? true : false;
	}
}