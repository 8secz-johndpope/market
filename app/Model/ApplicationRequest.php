<?php


namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class ApplicationRequest extends Model
{
	const STATUS = array('New', 'Viewed', 'Accepted' ,'Rejected');

	public function __construct()
    {
        parent::__construct();
        $this->status = 0;
    }
	public function advert(){
		return $this->belongsTo('App\Model\Advert');
	}
	public function employer(){
		return $this->belongsTo('App\User', 'user_id');
	}
	public function getStatus(){
		return self::STATUS[$this->status];
	}
	public function candidate(){
		return $this->belongsTo('App\User', 'candidate_id');
	}
	public function decline(){
		$this->status = 3;
	}
	public function apply($profile, $cv){
		$this->status = 2;
		return $this->advert->apply($profile, $cv);
	}
}