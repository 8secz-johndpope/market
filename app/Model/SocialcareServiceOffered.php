<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class SocialcareServiceOffered extends Model
{
	public $timestamps = false;
	const SERVICES_OFFERED = array('Tutoring', 'Pet sitting', 'Housekeeping', 'Childcare');

	public function getService(){
		return self::SERVICES_OFFERED[$this->id];
	}
}