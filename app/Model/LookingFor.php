<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 29/11/2017
 * Time: 15:27
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class LookingFor extends Model
{
	public $timestamps = false;
	public function locationsPreferred()
	{
		return $this->hasMany('App\Model\Location');
	}
	public function jobTypes()
	{
		return $this->belongsToMany('App\Model\Field', 'looking_for_contract_type', 'looking_for_id','field_id')->withPivot('id');
	}
	public function sectors()
	{
		return $this->hasMany('App\Model\Category');
	}
	public function profile(){
        return $this->belongsTo('App\Model\Profile');
    }
}