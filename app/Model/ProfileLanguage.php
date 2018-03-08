<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ProfileLanguage extends Model
{
	public $timestamps = false;
	const LEVEL_TYPES = ['Basic', 'Intermediate', 'Fluent'];
	public function language(){
		return $this->belongsTo('App\Model\Language');
	}
	public function getLevel(){
		return self::LEVEL_TYPES[$this->level - 1];
	}
}