<?php
//namespace LeonHardly;

class DB {
    
    public $insert_id; // Last insert statement primary key;
    private $table;
    private $start;
    private $query;
    private $db;
    static $static_db;
    
    public function __construct($conf, $cache_object = null) {
        $this->db = new PDO("mysql:host={$conf['host']};dbname={$conf['db']}", $conf['user'], $conf['pass'], array( PDO::ATTR_PERSISTENT => true ));
    }
    
    public function fetchAll($return_type = PDO::FETCH_OBJ) {
        $this->exec();
        
        return $this->query->fetchAll($return_type);
    }

    public function fetch($return_type = PDO::FETCH_OBJ) {
        $this->exec();
        
        return $this->query->fetch($return_type);
    }
    
    public function exec() {
        return $this->query->execute();
    }
    
    public static function query($query) {
        if (!is_object(self::$static_db)) 
            self::$static_db = new DB(config::core('database'));
        
        self::$static_db->query = self::$static_db->db->prepare($query);
        
        return self::$static_db;
    }
    
    public function bind($values) {
        foreach($values as $key => $value) {
            switch(true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
            
            $this->stmt->bindValue($key + 1, $value, $type);
        }
        return $this;
    }
    /*
    public function debugOutput() {
        $this->start = microtime(true);
        
        return $this;
    }
    
    public function __destruct() {
        if (!empty($this->start))
            die(microtime(true) - $this->start);
    }
    */
}