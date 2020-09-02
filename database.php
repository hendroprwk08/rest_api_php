<?php
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

