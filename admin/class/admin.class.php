<?php 
class Admin{
    public $id, $username, $email, $password, $status, $last_login;
    
    public function Login(){
        $conn = mysqli_connect('localhost', 'root','','anidb');
        $encpw = md5($this->password);
        $sql = "select * from admin where email = '$this->email' and password = '$encpw';";
        $var = $conn->query($sql);
        if($var->num_rows>0){
            $data = $var->fetch_object();
            print_r($var);
            session_start();
            $_SESSION['id'] = $data->id;
            $_SESSION['username'] = $data->username;
            $_SESSION['email'] = $data->email;
            $_SESSION['password'] = $data->password;
            setcookie('username', $data->username, time()+60*60);
            header('Location:layout/dashboard.php');
        }else{
            $error = "Invalid Credentials!!!!";
            return $error;
        }
    }
}
?>