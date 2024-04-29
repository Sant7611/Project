<?php
class Admin
{
    public $id, $username, $email, $password, $status, $last_login, $newPassword, $searchValue, $page;
    private $conn;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function Login()
    {
        $encpw = md5($this->password);
        $sql = "select * from admin where email = '$this->email' and password = '$encpw';";
        $var = $this->conn->query($sql);
        if ($var->num_rows > 0) {
            $data = $var->fetch_object();
            // echo "<pre>";
            // print_r($data);
            // echo "</pre>";
            session_start();
            $_SESSION['id'] = $data->id;
            $_SESSION['username'] = $data->username;
            $_SESSION['email'] = $data->email;
            $_SESSION['password'] = $this->password;
            setcookie('username', $data->username, time() + 60 * 60);
            header('Location:layout/dashboard.php');
        } else {
            $error = "Invalid Credentials!!!!";
            return $error;
        }
    }

    public function ResetPw()
    {
        $encpw = md5($this->newPassword);
        $sql = "update admin set password = '$encpw' where id = '$this->id';";
        $res = $this->conn->query($sql);
        $_SESSION['password'] = $this->newPassword;
        if ($res) {
            return 'success';
        } else {
            return 'failed';
        }
    }

    public function Search()
    {
        $sql = "SELECT p.*, 
        GROUP_CONCAT(DISTINCT s.source) AS source, 
        GROUP_CONCAT(DISTINCT s.id) AS source_id, 
        GROUP_CONCAT(DISTINCT pr.producers) AS producer, 
        GROUP_CONCAT(DISTINCT pr.id) AS producer_id, 
        GROUP_CONCAT(DISTINCT st.studio) AS studio, 
        GROUP_CONCAT(DISTINCT st.id) AS studio_id, 
        GROUP_CONCAT(DISTINCT g.genre) AS genre, 
        GROUP_CONCAT(DISTINCT g.id) AS genre_id 
 FROM post p 
 INNER JOIN post_joins pj ON p.id = pj.post_id 
 LEFT JOIN source s ON pj.source_id = s.id 
 LEFT JOIN producers pr ON pj.producer_id = pr.id 
 LEFT JOIN studio st ON pj.studio_id = st.id 
 LEFT JOIN genre g ON pj.genre_id = g.id
 WHERE p.title like '{$this->searchValue}%' group by p.id 
    ";

        $post_per_page = 5;

        if (isset($this->page)) {
            $pg = intval($this->page);
        } else {
            $pg = 1;
        }
        // echo $pg;
        $start_from = ($pg - 1) * $post_per_page;

        $sql .= ' limit ' . $start_from . ' , ' . $post_per_page . ' ;';


        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);


        // print_r($data);
        if ($result->num_rows > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function countSearch(){
        $count = $this->Search();
        if($count > 0){
            return count($count);
        }else{
            $sql = "select *  from post; ";
            $count = mysqli_query($this->conn, $sql);
            return $count->num_rows;
        }

    }

}
