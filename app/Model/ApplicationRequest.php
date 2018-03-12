<?php


namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ApplicationRequest extends Model
{
	public function advert(){
		return $this->belongsTo('App\Model\Advert');
	}
}