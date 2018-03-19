<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Application;
use App\Model\Advert;
use App\Model\ApplicationRequest;
use App\Model\Profile;
use App\Model\LookingFor;
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
        $aux = $user->candidates;
        $jobs = $user->jobs;
        if($request->page === 'candidates'){
            if($request->has('candidate_status')){
                $params['status'] = $request->candidate_status;
            }
            if($request->has('candidate_keywords')){
                $params['keywords'] = $request->candidate_keywords;
            }
            if(count($params) > 0){
                $aux = $this->getCandidatesByQuery($params);
            } 
        }
        elseif($request->page === 'jobs'){
           if($request->has('jobs_status')){
                $params['status'] = $request->jobs_status;
            }
            if($request->has('jobs_keywords')){
                $params['keywords'] = $request->jobs_keywords;
            }
            if(count($params) > 0){
                $jobs = $this->getJobsByQuery($params);
            }
        }
        $candidates = collect();
        foreach ($aux as $application) {
            $candidate = Application::find($application->id);
            $candidates->put($application->id, $candidate);
        }
        $totalUnreadCandidates = $user->unreadCandidates->count();
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        return view('home.portals.applications',['jobs'=>$jobs,'user'=>$user, 'balance' => $balance, 'myInvitations' => $myInvitations, 'invitationStatus' => $invitationStatus, 'applicationStatus' => $applicationStatus, 'jobsNewCandidates' => $jobsNewCandidates, 'candidates' => $candidates, 'totalUnreadCandidates' => $totalUnreadCandidates, 'tab' => $request->page, 'jobStatus' => $jobStatus, 'candidatesStatus' => $request->candidate_status, 'candidatesKeywords' => $request->candidate_keywords, 'jobsStatus' => $request->jobs_status, 'jobsKeywords' => $request->jobs_keywords, ]);
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
    public function markViewAll(Request $request){
        $ids = $request->candidates;
        foreach($ids as $id){
            $application = $this->markViewApplication($id);
            $application->save();
        }
        return back()->with('status', 'The applications were marked as viewed successfully');
    }
    public function rejectAll(Request $request){
        $ids = $request->candidates;
        foreach($ids as $id){
            $application = $this->rejectApplication($id);
            $application->save();
        }
        return back()->with('status', 'The applications were rejected successfully');
    }
    public function interviewAll(Request $request){
        $ids = $request->candidates;
        foreach($ids as $id){
            $application = $this->callInterview($id);
            $application->save();
        }
        return back()->with('status', 'The applications changed the status successfully');
    }
    public function acceptAll(Request $request){
        $ids = $request->candidates;
        foreach($ids as $id){
            $application = $this->acceptApplication($id);
            $application->save();
        }
        return back()->with('status', 'The applications changed the status successfully');
    }
    public function expireAll(Request $request){
        $ids = $request->select_jobs;
        foreach($ids as $id){
            $job = $this->expireJob($id);
            $job->save();
        }
        return back()->with('status', 'The jobs changed the status successfully');
    }
    public function getJobsByQuery(array $params = []){
        $user = Auth::user();
        $query = $user->jobs();
        if(array_key_exists('status', $params)){
            $query->where('status', $params['status']);
        }
        $query = $query->get();
        if(array_key_exists('keywords', $params)){
           $query = $query->filter(function($value, $key) use($params){
                return stripos($value->param('title'), $params['keywords'],0) !== false;
           });
        }
        return $query;
    }
    public function markViewApplication($id){
        $application = Application::find($id);
        $application->markView();
        return $application;
    }
    public function rejectApplication($id){
        $application = Application::find($id);
        $application->reject();
        return $application;
    }
    public function callInterview($id){
        $application = Application::find($id);
        $application->interview();
        return $application;
    }
    public function acceptApplication($id){
        $application = Application::find($id);
        $application->accept();
        return $application;
    }
    public function expireJob($id){
        $job = Advert::find($id);
        $job->expire();
        return $job;
    }
    public function searchCV(Request $request){
        $profiles = $this->getProfileByQuery($request);
        $user = Auth::user();
        $myJobs = $user->jobs;
        return view('home.recruiter.search_profile', ['profiles' => $profiles, 'user' => $user, 'myJobs' => $myJobs]);
    }
    public function applicationRequest(Request $request){
        try{
            $user = Auth::user();
            $requestApplication = $this->jobApplicationRequest($request->user_profile, $request->offer_job, $request->offer_message);
            $user->applicationInvitations()->save($requestApplication);
            return back()->with('status', 'The application request was sent correctly');
        }catch(\Exception $e){
            return $e;
        }
    }
    public function applicationRequestAll(Request $request){
        $user = Auth::user();
        foreach ($request->candidate_id as $idProfile) {
            $requestApplication = $this->jobApplicationRequest($idProfile, $request->offer_job, $request->offer_message);
            if($requestApplication == null){
                back()->with('error', 'Error, the job or profile selected are not valid');
            }
            $user->applicationInvitations()->save($requestApplication);
        }
        return back()->with('status', 'The application request was sent correctly');

    }
    public function jobApplicationRequest($idProfile, $idJob, $message){
        $profile = Profile::find($idProfile);
        $job = Advert::find($idJob);
        return $profile->makeApplicationRequest($job, $message);
    }
    public function getProfileByQuery(Request $request){
        $profiles = DB::table('profiles')
                            ->where('profiles.status', 1);
        if($request->has('type'))
            $profiles->where('profiles.type', $request->type);
        if($request->has('job_title') || $request->has('location')){
            $profiles->join('looking_fors', 'profiles.id', '=', 'looking_fors.profile_id');
        }
        if($request->has('job_title')){
            $profiles->where('looking_fors.job_title', 'like', '%'.$request->job_title.'%');
        }
        if($request->has('location')){
            $profiles->join('looking_for_location', 'looking_fors.id', '=', 'looking_for_location.looking_for_id')
                     ->where('looking_for_location.location_id', $request->location);
        }
        $idsProfiles = $profiles->select('profiles.id')->get();
        $colProfiles = collect();
        foreach ($idsProfiles as $profile) {
            $colProfiles->put($profile->id, Profile::find($profile->id));
        }
        return $colProfiles;
                           
    }
}
?>