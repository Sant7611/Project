<?php

class User{
    public $id, $username, $email, $password;

    public function signup(){
        $conn = mysqli_connect('localhost', 'root', '', 'anidb');
        $sql = "insert into users(username, email, password) values ('$this->username', '$this->email', '$this->password';";
        mysqli_query($conn, $sql);
        if($conn->affected_rows > 0){
            header('location:login.php');
        }else{
            return "invalid credentials";
        }
    }

    public function login(){
        $conn = mysqli_connect("localhost", "root", "",'anidb');
        $sql = "select * from users where email = '$this->email' and password = '$this->password';";
        $res = mysqli_query($conn, $sql);
        if($res->num_rows == 1){
            $data = $res->fetch_all(MYSQLI_ASSOC);
            session_start();
            $_SESSION['id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            setcookie('username', $data['username'], time() + 24*60*60,'/');
            header('location:index.php');
        }
    }
}