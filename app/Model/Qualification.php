<?php
/**
 * User: Mauricio
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Qualification extends Model
{
	public $timestamps = false;

	public function type(){
		return $this->belongsTo('App\Model\QualificationType');
	}
	public function grade(){
		return $this->belongsTo('App\Model\Grade');
	}
}