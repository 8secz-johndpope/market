<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Model\Application;
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

        $myInvitations = $this->user->applicationInvitations;
        $invitationStatus = ApplicationRequest::STATUS;
        $applicationStatus = Application::STATUS;
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        return view('home.portals.applications',['jobs'=>$this->user->jobs(),'user'=>$this->user, 'balance' => $balance, 'myInvitations' => $myInvitations, 'invitationStatus' => $invitationStatus, 'applicationStatus' => $applicationStatus]);
    }
}
?>