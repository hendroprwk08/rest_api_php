<?php
// header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=UTF-8");
// header("Access-Control-Allow-Methods: POST, GET");
// header("Access-Control-Max-Age: 3600");
// header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
class Database{
    var $mysqli;  
    
    var $host   = 'localhost';
    var $db     = 'dbpenjualan';
    var $user   = 'root';
    var $pass   = '';
    
    public function open(){
        $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->mysqli->connect_errno) 
            return $this->mysqli->connect_error;
    }
   
    public function execute($sql){
        $result = $this->mysqli->query($sql);
        
        if (!$result)
            return $this->mysqli->error;
        
        return $result;
    }
    
    public function get($sql){
        $rows = Array();
        
        $query = $this->execute($sql);
        
        while($row = $query->fetch_assoc()){
            $rows[] = $row;
        }
        
        return $rows;       
    }
	
	public function lastId(){
        return $this->mysqli->insert_id;
    } 

    public function close(){
        return $this->mysqli->close();
    } 
}
?>

