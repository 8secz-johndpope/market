<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 1:24 PM
 */

namespace App\Http\Controllers;
use App\Model\Advert;
use GuzzleHttp\Pool;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MessageController extends BaseController
{
    public function __construct()
    {

        $this->middleware('auth');
        parent::__construct();
    }
    public function messages(Request $request){
        $client = new Client();
        $user = Auth::user();

        $g = $client->request('POST', 'https://fire.sumra.net/groups', [
            'form_params' => ['id'=>$user->id]
        ]);
        ///var_dump($g);
        //exit;
        $g = json_decode($g->getBody(),true);
        //return $g;
        $r = $client->request('POST', 'https://fire.sumra.net/groupmessages', [
            'form_params' => ['rid'=>$g[0]['rid'],"time"=>0]
        ]);
        $r = json_decode($r->getBody(),true);
        return view('home.messages',['r'=>$r,'g'=>$g,'rid'=>$g[0]['rid'],'user'=>$user]);
    }
    public function gmessages(Request $request,$rid){
        $client = new Client();
        $user = Auth::user();
        $r = $client->request('POST', 'https://fire.sumra.net/groupmessages', [
            'form_params' => ['rid'=>$rid,"time"=>0]
        ]);

        $g = $client->request('POST', 'https://fire.sumra.net/groups', [
            'form_params' => ['id'=>104]
        ]);
        ///var_dump($g);
        //exit;
        $r = json_decode($r->getBody(),true);
        $g = json_decode($g->getBody(),true);
        //return $g;
        return view('home.messages',['r'=>$r,'g'=>$g,'rid'=>$rid,'user'=>$user]);
    }
    public function reply(Request $request,$id){
        $user = Auth::user();
        $advert = Advert::find($id);
        if($advert===null)
        {
            $advert=Advert::where('sid',$id)->first();
        }
        return view('home.reply',['advert'=>$advert,'user'=>$user]);

    }
    public function send(Request $request){
        $user = Auth::user();
        $advert = Advert::find($request->id);
        $client = new Client();
        $g = $client->request('POST', 'https://fire.sumra.net/creategroup', [
            'form_params' => ['advert_id'=>$advert->sid,'users'=>[$user->id,$advert->user_id],'title'=>$advert->param('title'),'image'=>$advert->first_image()]
        ]);
        $g = json_decode($g->getBody(),true);
        $k = $client->request('POST', 'https://fire.sumra.net/groupmessage', [
            'form_params' => ['from'=>$user->id,'message'=>$request->message,'rid'=>$g['rid'],'type'=>'text']
        ]);

        return redirect('/user/manage/messages/'.$g['rid']);

    }
    public function fsend(Request $request){
        $user = Auth::user();
        $advert = Advert::find($request->id);
        if($advert===null){
            $advert = Advert::where('sid',$request->id)->first();
        }
        $client = new Client();
        $g = $client->request('POST', 'https://fire.sumra.net/creategroup', [
            'form_params' => ['advert_id'=>$advert->sid,'users'=>[$user->id,$advert->user_id],'title'=>$advert->param('title'),'image'=>$advert->first_image()]
        ]);
        $g = json_decode($g->getBody(),true);
        $k = $client->request('POST', 'https://fire.sumra.net/groupmessage', [
            'form_params' => ['from'=>$user->id,'message'=>$request->message,'rid'=>$g['rid'],'type'=>'text']
        ]);

        return ['rid'=>$g['rid'],'msg'=>'sent'];

    }
    public function rsend(Request $request){
        $user = Auth::user();
        $client = new Client();
        $g = $client->request('POST', 'https://fire.sumra.net/groupmessage', [
            'form_params' => ['from'=>$user->id,'message'=>$request->message,'rid'=>$request->rid,'type'=>'text']
        ]);

        return redirect('/user/manage/messages/'.$request->rid);

    }


}