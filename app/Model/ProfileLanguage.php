<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ProfileLanguage extends Model
{
	public $timestamps = false;
	private static LEVEL_TYPES = ['Basic', 'Intermediate', 'Fluent'];
	public function language(){
		return $this->belongsTo('App\Model\Language');
	}
	public function getLevel(){
		return LEVEL_TYPES[$this->level - 1];
	}
}