<?php

class FractureForm{
    private static $instance;
    public $ins_db;
    
    private function __clone() {}
    public function __wakeUp() 
    {
          throw new Exception();  
    }
    
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new FractureForm();
        }
        
        return self::$instance;
    }
    
    private function __construct() {
        $this->ins_db = new PDO("mysql: host=".HOST.";dbname=".DB_NAME, USER, PASSWORD);
        $this->ins_db->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );  
    }
    
    
    public  function insert($table, $fields = [],$values = []) {
        $query = "INSERT INTO ".$table." (";
        $query .= implode(",",$fields).") ";
        $query .= "VALUES (";
        foreach($fields as $val) {
                $query .= ":".$val.",";
        }
        $query = rtrim($query,',').")";
        $sth = $this->ins_db->prepare($query);
        $sth->execute($values);

        return $this->ins_db->lastInsertId();
    }
    
    
    
    public function selectAll($table, $fields=['*'], $sortField="",  $sortOrder="ASC"){
        $query = "SELECT ";
        $query .= implode(",",$fields)." FROM $table ";
        if($sortField!=""){
            $query .= " ORDER BY $sortField $sortOrder";
        }
        $sth = $this->ins_db->query($query);
        
        $result = [];
        while ($res = $sth->fetch(PDO::FETCH_ASSOC)) {
            $result[] = $res;
        }
        return $result;
    }
    

    
}

