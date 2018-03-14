<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function applications(Request $request)
    {
        $user = Auth::user();
        $balance = \Stripe\Balance::retrieve( array("stripe_account" => $user->stripe_account));
        return view('home.portals.applications',['jobs'=>$user->jobs(),'user'=>$user, 'balance' => $balance]);
    }
}
?>