<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 29/11/2017
 * Time: 15:27
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class LookingFor extends Model
{
	public $timestamps = false;
	public function locationsPreferred()
	{
		return $this->hasMany('App\Model\Location');
	}
	public function jobTypes()
	{
		return $this->belongsToMany('App\Model\FieldValue', 'looking_for_contract_type');
	}
	public function sectors()
	{
		return $this->belongsToMany('App\Model\Category', 'looking_for_sectors');
	}
	public function profile(){
        return $this->belongsTo('App\Model\Profile');
    }
    public function getSectors(){
    	$sectorsPreferred = array();
    	$subSectorPreferred = $this->sectors;
        foreach($subSectorPreferred as $sector){
            if(!array_key_exists($sector->parent_id, $sectorsPreferred)){
                $sectorsPreferred[$sector->parent_id] = $sector->parent;
            }
        }
        return $sectorsPreferred;
    }
}