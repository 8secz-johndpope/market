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
		return $this->hasMany('App\model\Location');
	}
	public function jobTypes()
	{
		return $this->hasToMany('App\Model\Field', 'looking_for_contract_type');
	}
	public function sectors()
	{
		return $this->hasToMany('App\model\Category');
	}
	public function profile(){
        return $this->belongsTo('App\Profile');
    }
}