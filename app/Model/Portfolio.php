<?php
/**
 * User: Mauricio
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Portfolio extends Model
{
	public $timestamps = false;

	public function images(){
		return $this->morphMany('App\Model\Image', 'imagetable');
	}
}