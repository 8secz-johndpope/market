<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/28/17
 * Time: 6:06 PM
 */

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $client;
    public function __construct()
    {
        $hosts = [

            'http://145.239.66.50:9200'        // SSL to localhost
        ];
        $this->client = \Elasticsearch\ClientBuilder::create()// Instantiate a new ClientBuilder
        ->setHosts($hosts)// Set the hosts
        ->build();              // Build the client object
        // Fetch the Site Settings object
    }
}