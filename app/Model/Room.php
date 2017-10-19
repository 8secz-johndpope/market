<?php
/**
 * Created by PhpStorm.
 * User: anil
 * Date: 9/29/17
 * Time: 3:06 AM
 */

namespace App\Model;
use App\User;
use Cassandra;
use Illuminate\Support\Facades\Auth;

class Room extends CassandraBase
{
    public static function all(){
        $user = Auth::user();
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
    public static function delete($rid){
        $user = Auth::user();
        $statement = new Cassandra\SimpleStatement(       // also supports prepared and batch statements
            "delete from messages where rid=".$rid
        );
        $future    = CassandraBase::cassandra()->execute($statement);
        return $future;
    }
}