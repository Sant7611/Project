<?php
require_once('common.class.php');
class Post extends Common
{
    private $conn;
    public $id, $title, $type, $episodes, $status, $slider_key, $featured, $sypnosis, $genre_id, $studio_id, $release_date, $image_url, $created_date;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save()
    {
        $sql = "insert into post (title, type, episodes, status, slider_key, featured, sypnosis, genre_id, studio_id, release_date,image_url) values ('$this->title', 
        '$this->type',
         $this->episodes, 
         '$this->status', 
         '$this->slider_key', 
         '$this->featured', 
         '$this->sypnosis',
         '$this->genre_id',	
         '$this->studio_id',
         '$this->release_date',
         '$this->image_url'); ";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1 && $this->conn->insert_id > 0) {
            return $this->conn->insert_id;
        }
    }

    public function delete()
    {
        $sql = "delete from post where id = '$this->id';";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            $msg = "Success";
            return $msg;
        }
    }
    public function edit()
    {
        $sql = "update post set 
                    title = '$this->title',
                    type = '$this->type',
                    episodes = '$this->episodes',
                    sypnosis = '$this->sypnosis',
                    genre_id = '$this->genre_id',
                    status= '$this->status',
                    slider_key = '$this->slider_key',
                    featured = '$this->featured',
                    studio_id = '$this->studio_id',
                    release_date = '$this->release_date',
                    image_url = '$this->image_url'
                    where id = '$this->id';    ";
        $this->conn->query($sql);
        if ($this->conn->affected_rows > 0) {
            return "success";
        } else {
            return false;
        }
    }
    public function fetch()
    {
        $sql = "select * from post;";
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        if ($result->num_rows > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function getById()
    {
        $sql = "select * from post where id = '$this->id';";
        $var = $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            $result = $var->fetch_object();
            return $result;
        } else {
            return [];
        }
    }

    public function selectPostById()
    {
        $sql = "select * from post where id = '$this->id';";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $var = $result->fetch_all(MYSQLI_ASSOC);
            return $var;
        } else {
            return [];
        }
    }
    public function selectFeaturedPost()
    {
        $sql = "select * from post where featured = 1 order by created_date desc limit 3;";
        return $this->select($sql);
    }

    public function selectActivePost()
    {
        $sql = "select * from post where status = 1 order by created_date desc limit 3;";
        return $this->select($sql);
    }

    public function selectSliderPost()
    {
        $sql = "select * from post where status = 1 and slider_key = 1 order by created_date desc limit 3;";
        return $this->select($sql);
    }

    public function selectPostByGenre()
    {
        $sql = "select * from post where genre_id = '$this->genre_id' order by created_date desc limit 3;";
    }
}
