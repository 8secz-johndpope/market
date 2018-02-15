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
		return $this->hasToMany('App\model\Location');
	}
	public function jobTypes()
	{
		return $this->hasToMany('App\model\Field');
	}
	public function sectors()
	{
		return $this->hasToMany('App\model\Category');
	}
	public function profile(){
        return $this->belongsTo('App\Profile');
    }
}