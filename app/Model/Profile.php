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
		return $this->hasOne('App\model\LookingFor');
	}
}