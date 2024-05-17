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
        $sql = "insert into post_joins(post_id, user_id, wishlist_status) values ($this->post_id, $this->user_id, 1);";
        mysqli_query($this->conn, $sql);
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return 0;
        }
        // return array($this->post_id, $this->user_id);
    }

    public function delete()
    {
        $sql = "delete from post_joins where post_id = $this->post_id and user_id = $this->user_id and wishlist_status = 1;";
        $res = mysqli_query($this->conn, $sql);
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return 0;
        }
    }

    public function getPostId()
    {
        $sql = "select post_id  from post_joins where user_id = $this->user_id and wishlist_status = 1;";
        $res = mysqli_query($this->conn, $sql);
        // $output = $res->fetch_all(MYSQLI_ASSOC);
        $output = array();
        while ($row = mysqli_fetch_assoc($res)) {
            $output[] = $row['post_id'];
        }
        if (count($output) > 0) {
            $data =  implode(',', $output);
            return $data;
        } else {
            return 0;
        }
    }

    public function fetchById()
    {
        $ids = $this->getPostId();

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
 WHERE p.id IN ($ids) 
 GROUP BY p.id ; ";

        // $sql = "select * from post left join wishlist on post.id = wishlist.post_id  where user_id = $this->user_id ;";
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
        $checks = $this->getPostId();
        if ($checks) {
            $check = explode(',', $checks);
            $status = 0;
            foreach ($check as  $value) {
                // echo $value;
                // echo $this->post_id;
                if ($value == $this->post_id) {
                    $status = 1;
                }
            }
            if ($status) {
                return true;
            } else {
                return  0;
            }
        } else {
            return 0;
        }
    }
}
