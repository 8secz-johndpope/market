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
    public function candidateApplyShow(Request $request)
    {
        $user=Auth::user();
        $ids = $request->ids;
        if($ids===null){
            return redirect()->back()->with('msg', 'Please select at least one application');
        }
        $ads = [];
        foreach ($ids as $id) {
            $requestApplication = ApplicationRequest::find($id);
            $advert = $requestApplication->advert;
            $ads[] = $advert;
        }
        return view('home.bulk',['user'=>$user,'adverts'=> $ads]);
    }
    public function discardAll(Request $request)
    {
        $ids = $request->ids;
        foreach ($ids as $id) {
            $applicationRequest = ApplicationRequest::find($id);
            $applicationRequest->status = 2;
            $applicationRequest->save();
        }
        return $this->candidatePortal();

    }
    public function discardShow(Request $request)
    {
        $user=Auth::user();
        $ids = $request->ids;
        $ads = [];
        foreach ($ids as $id) {
            $requestApplication = ApplicationRequest::find($id);
            $advert = $requestApplication->advert;
            $ads[] = $advert;
        }
        return view('home.portals.discard',['user'=>$user,'adverts'=> $ads]);

    }
    public function candidatePortal(Request $request){
        $user = Auth::user();
        $tab = $request->tab;
        $params = array();
        if($tab === 'tab-applications'){
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
            $myRequests = $user->applicationRequests;
        }
        else{
            if(isset($request->request_status)){
                $params['status'] = $request->request_status;
            }
            if(isset($request->request_keywords)){
                $params['keywords'] = $request->request_keywords;
            }
            if(count($params) > 0){
                $myRequests = $this->getRequestApplicationsByQuery($params);
            }
            else{
                $myRequests = $user->applicationRequests;
            }
            $myApplications = $user->liveApplications;
        }
        $latestApplications = $user->latestApplications;
        $latestApplicationRequests = $user->latestApplicationRequests;
        $applicationStatus = Application::STATUS;
        $requestStatus = ApplicationRequest::STATUS;
        return view('home.portals.cadidate', ['user' => $user, 'myApplications' => $myApplications, 'latestApplications' => $latestApplications, 'myRequests' => $myRequests, 'applicationStatus' => $applicationStatus, 'tab'=>$tab, 'statusFilter' => $request->status, 'keywordsFilter' => $request->keywords, 'requestStatus' => $requestStatus, 'keywordsRequest' => $request->request_keywords, 'statusRequest' => $request->request_status, 'latestApplicationRequests' => $latestApplicationRequests]);
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
                return stripos($value->advert->param('title'), $params['keywords'],0) !== false;
           });
        }
        return $query;
    }
    public function getRequestApplicationsByQuery(array $params = []){
        $user = Auth::user();
        $query = $user->applicationRequests();
        if(array_key_exists('status', $params)){
            $query->where('status', $params['status']);
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