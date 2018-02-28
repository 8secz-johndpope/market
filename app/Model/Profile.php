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
	public function availibility(){
		return $this->hasOne('App\Model\Availibility');
	}
	public function socialcareTasksHelp(){
		return $this->belongsToMany('App\Model\SocialcareTaskHelp', 'profile_socialcare_task_help')->withPivot('value');
	}
	public function socialCareTaskHelp($idTask){
		return $this->socialcareTasksHelp()->where('socialcare_task_help_id', $idTask)->first();
	}
	public function socialcareServicesOffered(){
		return $this->belongsToMany('App\Model\SocialcareServiceOffered');
	}
	public function socialcareServiceOffered($idServiceOffered){
		return $this->socialcareServicesOffered()->	where('socialcare_service_offered_id', $idServiceOffered)->first();
	}
	public function carAndDriving(){
		return $this->hasOne('App\Model\CarDriving');
	}
	public function languages(){
		return $this->hasMany('App\Model\ProfileLanguage');
	}
	public function additionalInfo(){
		return $this->hasOne('App\Model\ProfileAdditionalInfo');
	}
	public function publications(){
		return $this->hasMany('App\Model\Publication');
	}
	public function portfolio(){
		return $this->hasOne('App\Model\Portfolio');
	}
}