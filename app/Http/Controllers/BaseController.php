<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:35
 */

namespace App\Http\Controllers;
use Cassandra;

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


        $cluster   = Cassandra::cluster()->withContactPoints('35.157.50.121')->build();
        $keyspace  = 'chat';
        $this->cassandra   = $cluster->connect($keyspace);        // create session, optionally scoped to a keyspace


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
    }


}
