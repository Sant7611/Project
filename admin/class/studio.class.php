<?php

require_once('common.class.php');
class Studio extends Common{

    public $id, $studio; 
    private $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save(){
        $sql = "insert into studio(studio) values ('$this->studio');";
        $this->conn->query($sql);
        if($this->conn->affected_rows ==1){
            return $this->conn->insert_id;
        }else{
            return false;
        }
    }
    public function edit(){
        $sql = "update studio set studio = '$this->studio' where id = $this->id;";
        $this->conn->query($sql);
        if($this->conn->affected_rows == 1){
            return "success";    
        }else{
            return "failed";
        }

    }
    public function delete(){
        $sql = "delete from studio where id = '$this->id';";
        $this->conn->query($sql);
        if($this->conn->affected_rows == 1){
            
            return 'success';
        }else{
            return 'failed';
        }
    }
    public function fetch(){
        $sql = "select * from studio;";
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
        $sql = "select * from studio where id = $this->id;";
        return $this->select($sql);
    }
}