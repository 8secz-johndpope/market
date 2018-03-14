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
        $aux = $user->candidates;
        $candidates = collect();
        foreach ($aux as $application) {
            $candidate = Application::find($application->id);
            $candidates->put($application->id, $candidate);
        }
        $totalUnreadCandidates = $user->unreadCandidates->count();
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        return view('home.portals.applications',['jobs'=>$user->jobs,'user'=>$user, 'balance' => $balance, 'myInvitations' => $myInvitations, 'invitationStatus' => $invitationStatus, 'applicationStatus' => $applicationStatus, 'jobsNewCandidates' => $jobsNewCandidates, 'candidates' => $candidates, 'totalUnreadCandidates' => $totalUnreadCandidates]);
    }
    public function jobsWithNewCandidates(){
        $user = Auth::user();
        $myJobs = $user->jobs;
        $jobsWithNewCandidates =  $myJobs->filter(function(Advert $value, $key){
            return $value->unReadApplications->count() > 0;
        });
        return $jobsWithNewCandidates;

    }
}
?>