<?php
/**
 * User: Mauricio
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class QualificationType extends Model
{
	public $timestamps = false;

	public function grades(){
		return $this->belongsToMany('App\Model\Grade', 'type_grades', 'type_id');
	}
}