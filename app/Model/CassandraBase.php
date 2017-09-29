<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 3:04 AM
 */

namespace App\Model;
use Cassandra;


class CassandraBase
{
    protected static $cassandra;


    public function __construct()
    {
        $cluster   = Cassandra::cluster()->withContactPoints('35.157.50.121')->build();
        $keyspace  = 'chat';
        $this->cassandra   = $cluster->connect($keyspace);        // create session, optionally scoped to a keyspace

    }
}