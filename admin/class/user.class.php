<?php
session_start();
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
        $checkSql = "select * from users where email = '$this->email' limit 1;";
        $check_user_query_run = mysqli_query($this->conn, $checkSql);

        if (mysqli_num_rows($check_user_query_run) > 0) {
            $_SESSION['status'] = "User Already Exists";
            return false;
        } else {
            $token = md5(rand());
            $sql = "insert into users(username, email, password, created_at, token) values ('$this->username', '$this->email', '$this->password', NOW(), '$token');";
            mysqli_query($this->conn, $sql);
            if ($this->conn->affected_rows > 0) 
            {
                $_SESSION['status'] = "User Registration successful. Please verify your email address!!";
                return false;
            } else {
                return "invalid credentials";
            }
        }
    }


    public function login()
    {
        $sql = "select * from users where email = '$this->email' and password = '$this->password';";
        $res = mysqli_query($this->conn, $sql);
        // print_r($res);
        if ($res->num_rows > 0) {
            $data = $res->fetch_object();
            session_start();
            $_SESSION['id'] = $data->id;
            $_SESSION['uname'] = $data->username;
            if ($this->remember) {
                setcookie('uname', $data->username, time() + 28 * 24 * 60 * 60, '/');
            } else {
                setcookie('uname', $data->username, time() + 24 * 60 * 60, '/');
            }
            header('location:../index.php');
            // return $data;
        } else {
            return false;
        }
    }
}
