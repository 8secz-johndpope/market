<?php

namespace App;

use App\Mail\AccountCreated;
use App\Model\Address;
use App\Model\Application;
use App\Model\Category;
use App\Model\EmailCode;
use App\Model\Favorite;
use App\Model\Order;
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
        $this->display_name=$attributes['name'];
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
        $account->legal_entity->type='individual';
        $account->legal_entity->first_name=$this->name;
        if(isset($attributes['last']))
            $account->legal_entity->last_name=$attributes['last'];
        if(isset($attributes['day']))
            $account->legal_entity->dob->day=$attributes['day'];
        if(isset($attributes['month']))
            $account->legal_entity->dob->month=$attributes['month'];
        if(isset($attributes['year']))
            $account->legal_entity->dob->year=$attributes['year'];
        $account->save();

    }
    public function rooms()
    {
        return $this->belongsToMany('App\Model\Room')->orderBy('updated_at','desc');
    }
    public function money_requests()
    {
        return $this->belongsToMany('App\Model\MoneyRequest')->orderBy('id','desc');
    }
    public function addresses()
    {
        return $this->hasMany('App\Model\Address')->orderBy('id','desc');
    }
    public function featured()
    {
        return $this->hasMany('App\Model\Featured');
    }
    public function packs()
    {
        return $this->hasMany('App\Model\Pack');
    }
    public function urgent()
    {
        return $this->hasMany('App\Model\Urgent');
    }
    public function spotlight()
    {
        return $this->hasMany('App\Model\Spotlight');
    }
    public function is_favorite($id){
        $fav = Favorite::where('advert_id',$id)->where('user_id',$this->id)->first();
        if($fav===null)
            return false;
        else
            return true;
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
    public function contacts()
    {
        return $this->hasMany('App\Model\Contact');
    }
    public function reviews()
    {
        return $this->hasMany('App\Model\Review');
    }
    public function invoices()
    {
        return $this->hasMany('App\Model\Invoice');
    }
    public function transactions()
    {
        return $this->hasMany('App\Model\Transaction')->orderBy('id','desc');
    }
    public function has_applied($id){
       $application = Application::where('advert_id',$id)->where('user_id',$this->id)->first();
       if($application===null)
           return false;
       else
           return true;
    }
    public function android(){
        return $this->hasMany('App\Model\Token')->where('type',0);
    }
    public function ios(){
        return $this->hasMany('App\Model\Token')->where('type',1);
    }
    public function voip(){
        return $this->hasMany('App\Model\Token')->where('type',2);
    }
    public function images()
    {
        return $this->hasMany('App\Model\Image')->orderBy('id','desc');
    }
    public function bumps()
    {
        $orders = Order::where('buyer_id', $this->id)->where('type', 'bump')->orderBy('id','desc')->get();
        $items = array();
        foreach ($orders as $order)
        {
            foreach ($order->items as $item)
                $items[]=$item;
        }
        return $items;
    }
    public function orders(){
        return $this->hasMany('App\Model\Sale','seller_id')->where('status','>',0)->orderBy('id','desc');
    }
    public function buying(){
        return $this->hasMany('App\Model\Sale')->where('status','>',0)->orderBy('id','desc');
    }
    public function favorites()
    {
        return $this->belongsToMany('App\Model\Advert','favorites')->orderBy('id','desc');
    }
    public function alerts()
    {
        return $this->hasMany('App\Model\SearchAlert')->orderBy('id','desc');
    }
    public function adverts()
    {
        return $this->hasMany('App\Model\Advert')->where('status',1)->orderby('id','desc');
    }
    public function aadverts()
    {
        return $this->hasMany('App\Model\Advert')->where('status',3)->orderby('id','desc');
    }
    public function jobs()
    {
        $jobs = Category::find(4000000000);

        return $this->hasMany('App\Model\Advert')->where('status',1)->where('category_id','>=',$jobs->id)->where('category_id','<=',$jobs->ends)->orderby('id','desc');
    }
    public function motors()
    {
        $motors = Category::find(1000000000);

        return $this->hasMany('App\Model\Advert')->where('status',1)->where('category_id','>=',$motors->id)->where('category_id','<=',$motors->ends)->orderby('id','desc');
    }
    public function adverts_category($category)
    {
        return $this->hasMany('App\Model\Advert')->where('category_id',$category)->where('status',1)->orderby('id','desc')->get();
    }
    public function live()
    {
        return $this->hasMany('App\Model\Advert')->where('status',1)->orderby('updated_at','desc');
    }
    public function drafts()
    {
        return $this->hasMany('App\Model\Advert')->where('status',0)->orderby('updated_at','desc');
    }
    public function inactive()
    {
        return $this->hasMany('App\Model\Advert')->where('status',2)->orderby('updated_at','desc');
    }
    public function roles()
    {
        return $this->belongsToMany('App\Model\Role');
    }
    public function is_admin(){
        return count($this->belongsToMany('App\Model\Role')->where('name','admin')->get()) > 0;
    }
    public function address(){
        if($this->default_address>0)
        return $this->belongsTo('App\Model\Address','default_address');
        else
            return $this->hasOne('App\Model\Address');
    }
    public function business()
    {
        return $this->hasOne('App\Model\Business');
    }
    public function profile()
    {
        return $this->hasOne('App\Model\Profile');
    }
    public function contract()
    {
        return $this->hasOne('App\Model\Contract')->where('status','active');
    }
    public function balance()
    {
        return  $this->transactions()->where('direction',1)->sum('amount')-$this->transactions()->where('direction',0)->sum('amount');
    }
}
