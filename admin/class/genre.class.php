<?php

require_once('common.class.php');
class Genre extends Common
{

    public $id, $genre;
    private $conn;
    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save()
    {
        $sql = "insert into genre(genre) values ('$this->genre');";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            return $this->conn->insert_id;
        } else {
            return false;
        }
    }
    public function edit()
    {
        $sql = "update genre set genre = '$this->genre' where id = $this->id;";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            return "success";
        } else {
            return "failed";
        }
    }
    public function delete()
    {
        echo $this->id;
        $sql = "delete from genre where id = '$this->id';";
        $this->conn->query($sql);

        if ($this->conn->affected_rows == 1) {
            return 'success';
        } else {
            return 'failed';
        }
    }
    public function fetch()
    {
        $sql = "select * from genre;";
        $var = $this->conn->query($sql);
        if ($var->num_rows > 0) {
            $datalist = $var->fetch_all(MYSQLI_ASSOC);
            return $datalist;
        } else {
            return false;
        }
    }
}
