<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Application;
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
        $myApplications = $user->liveApplications;
        $myRequests = $user->applicationRequests;
        return view('home.portals.cadidate', ['user' => $user, 'myApplications' => $myApplications, 'myRequests' => $myRequests]);
    }
}
?>