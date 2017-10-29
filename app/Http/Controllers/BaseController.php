<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:35
 */

namespace App\Http\Controllers;
use Cassandra;
use GuzzleHttp\Client;

class BaseController extends Controller
{
    protected $site_settings;
    protected $client;
    protected $categories;
    protected $catids;
    protected $parents;
    protected $children;
    protected $base;
    protected $oldcats;
    protected $cassandra;

    public function __construct()
    {
        $hosts = [

            'http://145.239.66.50:9200'        // SSL to localhost
        ];
        $this->client = \Elasticsearch\ClientBuilder::create()           // Instantiate a new ClientBuilder
        ->setHosts($hosts)      // Set the hosts
        ->build();              // Build the client object

        /*
        // Fetch the Site Settings object
        $params = [
            'index' => 'categories',
            'type' => 'category',
            'body' => [
                'size'=>2000,
                'query' => [
                    'match_all' => (object)[]
                ]
            ]
        ];



// Get doc at /my_index/my_type/my_id
        $response = $this->client->search($params);
        $cats = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $catmap = array();
        foreach ($cats as $cat){
            $catmap[$cat['slug']]=$cat;
        }
        $idmap=array();
        foreach ($cats as $cat){
            $idmap[$cat['id']]=$cat;
        }


        $params = [
            'index' => 'oldcats',
            'type' => 'category',
            'body' => [
                'size'=>2000,
                'query' => [
                    'match_all' => (object)[]
                ]
            ]
        ];


// Get doc at /my_index/my_type/my_id
        $response = $this->client->search($params);
        $this->oldcats = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);

        $params = [
            'index' => 'relations',
            'type' => 'relation',
            'body' => [
                'size'=>2000,
                'query' => [
                    'match_all' => (object)[]
                ]
            ]
        ];
        $response = $this->client->search($params);
        $rel = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);

        $parents = array();
        $children = array();
        foreach ($rel as $relation){
            $parent=key($relation);
            $child=$relation[$parent];

            $parents[$child]=$parent;
            if(!isset($children[$parent]))
                $children[$parent]=array();
            array_push($children[$parent],$child);

        }
        $base=array();
        foreach ($cats as $cat){
            $slug=$cat['slug'];
            if(!isset($parents[$slug])) {
                array_push($base, $slug);
            }
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $this->categories=$catmap;
        $this->parents=$parents;
        $this->children=$children;
        $this->base=$base;
        $this->catids=$idmap;
        */
    }

    public function android($token,$room,$message){
        $client = new Client([
            'headers' => [
                'Content-Type'=> 'application/json',
                'Authorization'=> 'key=AAAAxvu2uio:APA91bEv0upMJEfZC1Bv_kSH03KpsbZKP4zph4p8NXT0FO5Ihc2kLmtEUBHQ2rUoI0PXY2hyD70N3TjK2H4ARZP1hgffgJ8TeUCSMxRQNE9ADNR7zLNiMTNjajgiHHc795LAbs6akZD3'
            ]
        ]);
        //$tk='cFX7C7fVoHA:APA91bE4gCqSZ6YynKZd98Ar8ZoI8ST1HBToikZjTk1Q0xyT6qOvm06kg8inGioJ7P9MCYrATTUQNmurmQAq3wCtheaH9yb2COtNSR4SDUD2l-h5uuS9idhPHJBRpvU0_5K5lFAoyXmh';
        $g = $client->request('POST', 'https://fcm.googleapis.com/fcm/send', [
            'json' => ['to' => $token->token , 'priority'=>'high','data',['id'=>$room->id],'notification'=>['title'=>$room->title,'body'=>$message->message,'sound'=>'mySound']]
        ]);
        $g = json_decode($g->getBody(), true);

        //return ['great'=>'yes','res'=>$g];
    }


}
