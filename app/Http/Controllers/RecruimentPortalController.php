<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Application;
use App\Model\Advert;
use App\Model\ApplicationRequest;

class RecruimentPortalController extends BaseController
{
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        parent::__construct();
        $this->user = Auth::user();
    }
    public function applications(Request $request)
    {
        $user = Auth::user();
        $myInvitations = $user->applicationInvitations;
        $jobsNewCandidates = $this->jobsWithNewCandidates();
        $invitationStatus = ApplicationRequest::STATUS;
        $applicationStatus = Application::STATUS_EMPLOYER;
        $jobStatus = Advert::STATUS;
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        return view('home.portals.applications',['jobs'=>$user->jobs,'user'=>$user, 'balance' => $balance, 'myInvitations' => $myInvitations, 'invitationStatus' => $invitationStatus, 'applicationStatus' => $applicationStatus, 'jobsNewCandidates' => $jobsNewCandidates]);
    }
    public function jobsWithNewCandidates(){
        $user = Auth::user();
        $myJobs = $user->applicationInvitations;
        $jobsWithNewCandidates =  $myJobs->filter(function($value, $key){
            return $value->applications()->where('status_employer', 0)->count() > 0;
        });
        return $jobsWithNewCandidates;

    }
}
?>