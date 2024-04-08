<?php

require_once('common.class.php');
class Producer extends Common{

    public $id, $producers; 
    private $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save(){
        $sql = "insert into producers(producers) values ('$this->producers');";
        $this->conn->query($sql);
        if($this->conn->affected_rows ==1){
            return $this->conn->insert_id;
        }else{
            return false;
        }
    }
    public function edit(){
        $sql = "update producers set producers = '$this->producers' where id = $this->id;";
        $this->conn->query($sql);
        if($this->conn->affected_rows == 1){
            return "success";    
        }else{
            return "failed";
        }

    }
    public function delete(){
        $sql = "delete from producers where id = '$this->id';";
        $this->conn->query($sql);
        if($this->conn->affected_rows == 1){
            
            return 'success';
        }else{
            return 'failed';
        }
    }
    public function fetch(){
        $sql = "select * from producers;";
        $var = $this->conn->query($sql);
        if($var->num_rows > 0){
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        }else{
            return false;
        }
        
    }
    public function getById()
    {
        $sql = "select * from producers where id = $this->id;";
        return $this->select($sql);
    }
}