<?php
require_once('common.class.php');
class Post extends Common
{
    private $conn;
    public $id, $title, $type, $episodes, $status, $sypnosis, $genre_id, $studio_id, $release_date, $image_url;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save()
    {
        $sql = "insert into post (title, type, episodes, status, sypnosis, genre_id, studio_id, release_date,image_url) values ('$this->title', '$this->type', $this->episodes,'$this->status','$this->sypnosis','$this->genre_id'	,'$this->studio_id','$this->release_date','$this->image_url'); ";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1 && $this->conn->insert_id > 0) {
            return $this->conn->insert_id;
        }
    }

    public function delete()
    {
        $sql = "delete from post where id = '$this->id';";
        $this->conn->query($sql);
        if ($this->conn->affected_rows == 1 && $this->conn->insert_id > 0) {
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
                    studio_id = '$this->studio_id',
                    release_date = '$this->release_date',
                    image_url = '$this->image_url';    ";
        $this->conn->query($sql);
        if ($this->conn->affected_rows > 0) {
            return 1;
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
}
