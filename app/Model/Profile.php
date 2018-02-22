<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 29/11/2017
 * Time: 15:27
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Profile extends Model
{
	public function looking_for()
	{
		return $this->hasOne('App\Model\LookingFor');
	}
	public function work_experiences(){
		return $this->hasMany('App\Model\WorkExperience');
	}
	public function cv(){
		return $this->hasOne('App\Model\Cv');
	}
	public function cover(){
		return $this->hasOne('App\Model\Cover');
	}
	public function employmentStatus(){
		return $this->hasOne('App\Model\EmploymentStatus');
	}
}