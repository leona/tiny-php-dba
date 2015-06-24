<?php
class config {
    public static function core() { 
        return array(
            'user'  => 'leonharvey',
            'db'    => 'test',
            'pass'  => '',
            'host'  => '127.0.0.1',
        ); 
    }
}
require('db.php');
//use LeonHardly\DB;

$result = DB::query('SELECT * from test limit 1')->fetch();


print_r($result);