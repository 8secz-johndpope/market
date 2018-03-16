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
        $params = array();
        if($request->has('candidate_status')){
            $params['status'] = $request->candidates_status;
        }
        if($request->has('candidate_keywords')){
            $params['keywords'] = $request->keywords;
        }
        return $params;
        if(count($params) > 0){
            $aux = $this->getCandidatesByQuery($params);
        }
        else{
            $aux = $user->candidates;
        }
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
    public function viewApplications(Request $request,$id)
    {
        $user = Auth::user();
        return view('home.portals.view_applications',['job'=>Advert::find($id),'user'=>$user]);
    }
    public function getCandidatesByQuery(array $params = []){
        $user = Auth::user();
        $query = $user->candidates();
        if(array_key_exists('status', $params)){
            $query->where('status_employer', $params['status']);
        }
        $query = $query->get();
        if(array_key_exists('keywords', $params)){
           $query = $query->filter(function($value, $key) use($params){
                return stripos($value->advert->param('title'), $params['keywords'],0) !== false;
           });
        }
        return $query;
    }
}
?>