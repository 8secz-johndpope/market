<?php
/**
 * Created by PhpStorm.
 * User: sumra
 * Date: 14/07/2017
 * Time: 18:35
 */

namespace App\Http\Controllers;


class BaseController extends Controller
{
    protected $site_settings;
    protected $client;
    protected $categories;
    protected $parents;
    protected $children;
    protected $base;

    public function __construct()
    {
        $hosts = [

            'https://search-market-qkpqb2dszupuwvaitlgjblovjm.eu-central-1.es.amazonaws.com:443'        // SSL to localhost
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


// Get doc at /my_index/my_type/my_id
        $response = $this->client->search($params);
        $cats = array_map(function ($a) { return $a['_source']; },$response['hits']['hits']);
        $catmap = array();
        foreach ($cats as $cat){
            $catmap[$cat['slug']]=$cat;
        }

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
        $this->categories=$catmap;
        $this->parents=$parents;
        $this->children=$children;
        $this->base=$base;
    }


}