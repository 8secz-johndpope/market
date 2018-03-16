<?php
/**
 * Created by PhpStorm.
 * User: Anil
 * Date: 01/09/2017
 * Time: 12:09
 */

namespace App\Model;
use Illuminate\Database\Eloquent\Model;


class Application extends Model
{
    const STATUS_EMPLOYEE = array('Pending', 'Rejected', 'Withdrawn', 'Interview', 'Accepted');
    const STATUS_EMPLOYER = array('New', 'Viewed', 'Rejected', 'Withdrawn', 'Interview', 'Accepted');
    public function cover(){
        return $this->belongsTo('App\Model\Cover');
    }

    public function advert(){
        return $this->belongsTo('App\Model\Advert');
    }
    public function cv(){
        return $this->belongsTo('App\Model\Cv');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function getStatusEmployee(){
        return self::STATUS_EMPLOYEE[$this->status_employee];
    }
    public function getStatusEmployer(){
        return self::STATUS_EMPLOYER[$this->status_employer];
    }
    public function profile(){
        return $this->belongsTo('App\Model\Profile');
    }
    public function withdraw(){
        if(!$this->isReject()){
            $this->status_employer = 3;
            $this->status_employee = 2;
        }
    }
    public function markView(){
        $this->status_employer = 1;
    }
    public function reject(){
        if(!$this->isWithdrawn()){
            $this->status_employee = 1;
            $this->status_employer = 2;
        }
    }
    public function interview(){
        if(!$this->isReject() && !$this->isWithdrawn()){
            $this->status_employee = 3;
            $this->status_employer = 4;
        }
    }
    public function accept(){
        if(!$this->isReject() && !$this->isWithdrawn()){
            $this->status_employee = 4;
            $this->status_employer = 5;
        }
    }
    public function isReject(){
        return $this->status_employer == 2;
    }
    public function isWithdrawn(){
        return $this->status_employee == 2;   
    }
}