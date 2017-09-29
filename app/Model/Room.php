<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 3:06 AM
 */

namespace App\Model;
use Cassandra;

class Room extends CassandraBase
{
    public static function all(){
        $statement = new Cassandra\SimpleStatement(       // also supports prepared and batch statements
            "select * from rooms"
        );
        $future    = CassandraBase::cassandra()->execute($statement);
        $rooms=[];
        foreach ($future as $row){
            $rooms[]=$row['rid'];
        }
        return $rooms;
    }
}