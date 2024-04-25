<?php
class Wishlist
{
    private $conn;
    public $post_id, $user_id;
    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save()
    {
        $sql = "insert into wishlist(post_id, user_id) values ($this->post_id, $this->user_id);";
        mysqli_query($this->conn, $sql);
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $sql = "delete from wishlist where post_id = $this->post_id and user_id = $this->user_id;";
        $res = mysqli_query($this->conn, $sql);
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fetchById()
    {
        $sql = "select * from post left join wishlist on post.id = wishlist.post_id  where user_id = $this->user_id ;";
        $res = mysqli_query($this->conn, $sql);
        if ($res->num_rows > 0) {
            $data = $res->fetch_all(MYSQLI_ASSOC);
            return $data;
        } else {
            return false;
        }
    }

    public function checkWishlist()
    {
        $checks = $this->fetchById();
        // return $checks;
        foreach ($checks as $key => $value) {
            if ($value['post_id'] == $this->post_id) {
             $status = 1;
            }
        }
        if($status){
            return ['status' => true];
        }else{
            return ['status' => false];
        }
    }
}
