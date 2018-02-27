<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ProfileLanguage extends Model
{
	public $timestamps = false;

	public function language(){
		return $this->belongsTo('App\Model\Language');
	}
}