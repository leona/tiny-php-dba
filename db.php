<?php
namespace LeonHardly\DB;

class DB {
    
    public $insert_id; // Last insert statement primary key;
    
    public function __construct($conf, $cache_object = null) {
        $this->db = new PDO("mysql:host={$conf['host']};dbname={$conf['db']}", $conf['user'], $conf['pass']);
    }
    
    public static function table($table) {
        if (empty(self::$db)) 
            self::$db = new DB(config::core('database'));
        
        return self::$db;
    }
    
    public function query($sql) {
        $this->db->execute($sql);
    }
    
    public function insert() {
        
    }
    
    public function update() {
        
    }
    public function fetch() {
        
    }
    
    public function fetchAll() {
        
    }
    
    public function pluck() {
        
    }
}