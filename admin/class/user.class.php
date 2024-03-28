<?php

class User
{
    private $conn;
    public $id, $username, $email, $password, $created_date, $remember;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function signup()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'anidb');
        $sql = "insert into users(username, email, password, created_at) values ('$this->username', '$this->email', '$this->password', NOW());";
        mysqli_query($this->conn, $sql);
        echo 'hello';
        if ($conn->affected_rows > 0) {
            header('location:login.php?message=Signup Successful. Please Login ');
        } else {
            return "invalid credentials";
        }
    }


    public function login()
    {
        $conn = mysqli_connect("localhost", "root", "", 'anidb');
        $sql = "select * from users where email = '$this->email' and password = '$this->password';";
        $res = mysqli_query($this->conn, $sql);
        print_r($res);
        if ($res->num_rows > 0) {
            $data = $res->fetch_object();
            session_start();
            $_SESSION['id'] = $data->id;
            $_SESSION['uname'] = $data->username;
            setcookie('uname', $data->username, time() + 24 * 60 * 60, '/');
            header('location:../index.php');
            // return $data;
        } else {
            return false;
        }
    }
}
