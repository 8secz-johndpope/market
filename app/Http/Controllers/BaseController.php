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

    public function __construct()
    {
        $hosts = [

            'https://search-market-qkpqb2dszupuwvaitlgjblovjm.eu-central-1.es.amazonaws.com:443'        // SSL to localhost
        ];
        $this->client = \Elasticsearch\ClientBuilder::create()           // Instantiate a new ClientBuilder
        ->setHosts($hosts)      // Set the hosts
        ->build();              // Build the client object
        // Fetch the Site Settings object
    }


}