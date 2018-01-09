<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\BaseController;
use App\Mail\AccountCreated;
use App\Model\EmailCode;
use App\Model\Transaction;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends BaseController
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'g-recaptcha-response' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

            $user = new User;
        $user->more([
            'name' => $data['name'],
            'last' => $data['last'],
            'day' => $data['day'],
            'month' => $data['month'],
            'year' => $data['year'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
        ]);
        $user->save();
        $token = $user->createToken('Token Name')->accessToken;
        $user->access_token = $token;
        $user->save();
        $letter = chr(rand(97,122));
        $sixd = rand(100000,999999);
        $user->referral_code = $user->name.'-'.$sixd.$letter;
        if(isset($data['code'])&&!empty($data['code'])){
            $user->referred_code = $data['code'];
        }
        $user->save();

        $transaction = new Transaction();
        $transaction->amount = 500;
        $transaction->user_id = $user->id;
        $transaction->description = "Registration Credit";
        $transaction->direction = 1;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->amount = 500;
        $transaction->user_id = 0;
        $transaction->description = "Registration Credit for ".$user->name;
        $transaction->direction = 1;
        $transaction->save();



        $acc = new AccountCreated();
        $verify = new EmailCode;
        $verify->user_id = $user->id;
        $verify->code=uniqid();
        $verify->save();
        $acc->verify_code=$verify->code;
        Mail::to($user)->send($acc);
        return $user;
        /*
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
        */
    }
}
