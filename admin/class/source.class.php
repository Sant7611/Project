<?php

require_once('common.class.php');
class Source extends Common{

    public $id, $source; 
    private $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save(){
        $sql = "insert into source(source) values ('$this->source');";
        $this->conn->query($sql);
        if($this->conn->affected_rows ==1){
            return $this->conn->insert_id;
        }else{
            return false;
        }
    }
    public function edit(){
        $sql = "update source set source = '$this->source' where id = $this->id;";
        $this->conn->query($sql);
        if($this->conn->affected_rows == 1){
            return "success";    
        }else{
            return "failed";
        }

    }
    public function delete(){
        $sql = "delete from source where id = '$this->id';";
        $this->conn->query($sql);
        if($this->conn->affected_rows == 1){
            
            return 'success';
        }else{
            return 'failed';
        }
    }
    public function fetch(){
        $sql = "select * from source;";
        $var = $this->conn->query($sql);
        if($var->num_rows > 0){
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        }else{
            return false;
        }
        
    }
}