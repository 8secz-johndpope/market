<?php

namespace App;

use App\Mail\AccountCreated;
use App\Model\EmailCode;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Mail;


class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    function __construct(array $attributes = []){
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        parent::__construct($attributes);
    }


    function more(array $attributes = [])
    {
        $this->email=$attributes['email'];
        $this->password=$attributes['password'];
        $this->name=$attributes['name'];
        $this->phone=$attributes['phone'];
        $customer = \Stripe\Customer::create(array(
            'email' => $attributes['email']
        ));
        $account = \Stripe\Account::create(array(
            "type" => "custom",
            "country" => "GB",
            "email" => $attributes['email']
        ));

        $this->stripe_id = $customer->id;
        $this->stripe_account=$account->id;
        $this->pk_key=$account->keys->publishable;
        $this->sk_key=$account->keys->secret;
        

    }
    public function addresses()
    {
        return $this->hasMany('App\Model\Address');
    }
    public function featured()
    {
        return $this->hasMany('App\Model\Featured');
    }
    public function urgent()
    {
        return $this->hasMany('App\Model\Urgent');
    }
    public function spotlight()
    {
        return $this->hasMany('App\Model\Spotlight');
    }
    public function shipping()
    {
        return $this->hasMany('App\Model\Shipping');
    }
    public function cvs()
    {
        return $this->hasMany('App\Model\Cv');
    }
    public function covers()
    {
        return $this->hasMany('App\Model\Cover');
    }

    public function favorites()
    {
        return $this->belongsToMany('App\Model\Advert','favorites')->orderBy('id','desc');
    }
}
