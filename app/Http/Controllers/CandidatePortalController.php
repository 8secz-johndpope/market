<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Application;
use App\Model\ApplicationRequest;
class CandidatePortalController extends BaseController
{
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }
    public function withdrawApplication(Request $request){
        $user = Auth::user();
        foreach($request->select_job as $id){
            $application = Application::find($id);
            $application->status = 2;
            $user->applications()->save($application);
        }
        return ['status' => 'Withdraw the applications successfully'];
    }
    public function candidatePortal(Request $request){
        $user = Auth::user();
        $tab = $request->tab;
        $params = array();
        if(isset($request->status)){
            $params['status'] = $request->status;
        }
        if(isset($request->keywords)){
            $params['keywords'] = $request->keywords;
        }
        if(count($params) > 0){
            $myApplications = $this->getApplicationsByQuery($params);
        }
        else{
            $myApplications = $user->liveApplications;
        }
        $latestApplications = $user->latestApplications;
        $applicationStatus = Application::STATUS;
        $requestStatus = ApplicationRequest::STATUS;
        $myRequests = $user->applicationRequests;
        return view('home.portals.cadidate', ['user' => $user, 'myApplications' => $myApplications, 'latestApplications' => $latestApplications, 'myRequests' => $myRequests, 'applicationStatus' => $applicationStatus, 'tab'=>$tab, 'statusFilter' => $request->status, 'keywordsFilter' => $request->keywords, 'requestStatus' => $requestStatus]);
    }
    public function getApplicationsByQuery(array $params = []){
        $user = Auth::user();
        $query = $user->applications();
        if(array_key_exists('status', $params)){
            $query->where('status', $params['status']);
        }
        $query = $query->get();
        if(array_key_exists('keywords', $params)){
           $query = $query->filter(function($value, $key) use($params){
            var_dump($value->advert->param('title'));
                return stripos($value->advert->param('title'), $params['keywords'],0) !== false;
           });
        }
        return $query;
    }
}
?>