<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class LoginController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticate(Request $request)
    {
        if (Auth::attempt(['email' => $request->email , 'password' => $request->password, 'enabled' => 1])) {
            // Authentication passed...
            return redirect()->intended('/');
        }
        else if (Auth::attempt(['email' => $request->email , 'password' => $request->password,'enabled'=>0])) {
            auth()->logout();
            return redirect()->back()->with('msg', 'Your account is disabled, please contact customer support');
        }
        else{
            return redirect()->back()->with('msg', 'Incorrect login details, please check your email and password');
        }
    }
    protected function authenticated(Request $request, User $user){
        if($user->isVerifyAccount()){
            return redirect()->intended($this->redirectPath());
        }
        else{
            auth()->logout();
            return back()->with('msg', 'You need to confirm your account. We have sent you an activation code, please check your email.');
        }
        
    }
}
