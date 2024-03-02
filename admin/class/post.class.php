<?php
require_once('common.class.php');
class Post extends Common
{
    private $conn;
    public $id, $title, $type, $episodes, $status,
        $source, $producers, $aired, $duration, $slider_key, $featured, $sypnosis, $genre_id, $studio_id, $release_date, $image_url, $created_date;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }

    public function save()
    {
        // genre_id, studio_id,
        $sql = "insert into post (title, type,duration, aired, episodes, status, slider_key, featured, sypnosis,  release_date,image_url) values ('$this->title', 
        '$this->type',
        '$this->duration',
        '$this->aired',
         $this->episodes, 
         '$this->status', 
         '$this->slider_key', 
         '$this->featured', 
         '$this->sypnosis',
         '$this->release_date',
         '$this->image_url'); ";
        //  '$this->genre_id',	
        //  '$this->studio_id',
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
                    duration = '$this->duration',
                    aired = '$this->aired',
                    episodes = '$this->episodes',
                    sypnosis = '$this->sypnosis',
                    status= '$this->status',
                    slider_key = '$this->slider_key',
                    featured = '$this->featured',
                    release_date = '$this->release_date',
                    image_url = '$this->image_url'
                    where id = '$this->id';    ";

        $genre_res = $this->updateGenre();
        $source_res = $this->updateSource();
        $producer_res = $this->updateProducer();
        $studio_res = $this->updateStudio();
        if($genre_res && $source_res && $producer_res && $studio_res){
            echo "true";
        }
        // $current_genre = "select genre_id from post_joins where post_id = '$this->id';";
        // $genres = $this->select($current_genre);


        // foreach ($this->producers as $producer) {
        //     $sql = "update post_joins set producer_id = '$producer' where post_id = '$this->id';";
        //     $this->conn->query($sql);
        // }
        // foreach ($this->source as $source) {
        //     $sql = "update post_joins set source_id = '$source' where post_id = '$this->id';";
        //     $this->conn->query($sql);
        // }

        $this->conn->query($sql);
        if ($this->conn->affected_rows > 0) {
            return "success";
        } else {
            return false;
        }
    }

    public function updateSource()
    {

        $sql = "select source_id from post_joins where post_id = '$this->id';";
        $currentSource = $this->select($sql);
        $sourceToDelete = array_diff($currentSource, $this->source);
        $sourceToAdd = array_diff($this->source, $currentSource);
        foreach ($sourceToDelete as $deleteSource) {
            $sql = "delete from post_joins where post_id = '$this->id' and source_id = '$deleteSource';";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        foreach ($sourceToAdd as $addSource) {
            $sql = "insert into post_joins(post_id, source_id) values('$this->id',  '$addSource');";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function updateStudio()
    {
        $sql = "select studio_id from post_joins where post_id = '$this->id';";
        $currentStudio = $this->select($sql);
        $studioToDelete = array_diff($currentStudio, $this->studio_id);
        $studioToAdd = array_diff($this->studio_id, $currentStudio);
        foreach ($studioToDelete as $deleteGenre) {
            $sql = "delete from post_joins where post_id = '$this->id' and studio_id = '$deleteGenre';";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        foreach ($studioToAdd as $addGenre) {
            $sql = "insert into post_joins(post_id, studio_id) values('$this->id',  '$addGenre');";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function updateGenre()
    {
        $sql = "select genre_id from post_joins where post_id = '$this->id';";
        $currentGenre = $this->select($sql);
        $genreToDelete = array_diff($currentGenre, $this->genre_id);
        $genreToAdd = array_diff($this->genre_id, $currentGenre);
        foreach ($genreToDelete as $deleteGenre) {
            $sql = "delete from post_joins where post_id = '$this->id' and genre_id = '$deleteGenre';";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        foreach ($genreToAdd as $addGenre) {
            $sql = "insert into post_joins(post_id, genre_id) values('$this->id',  '$addGenre');";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
    }
    public function updateProducer()
    {

        $sql = "select producers from post_joins where post_id = '$this->id';";
        $currentProducer = $this->select($sql);
        $producerToDelete = array_diff($currentProducer, $this->producers);
        $producerToAdd = array_diff($this->producers, $currentProducer);
        foreach ($producerToDelete as $deleteProducer) {
            $sql = "delete from post_joins where post_id = '$this->id' and producer_id = '$deleteProducer';";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        }
        foreach ($producerToAdd as $addProducer) {
            $sql = "insert into post_joins(post_id, producer_id) values('$this->id',  '$addProducer');";
            $this->conn->query($sql);
            if ($this->conn->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
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
