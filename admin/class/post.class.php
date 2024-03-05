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
        $sql = "insert into post (title, type, duration, aired, episodes, status, slider_key, featured, sypnosis, release_date, image_url) 
                values ('$this->title', '$this->type', '$this->duration', '$this->aired', $this->episodes, '$this->status', '$this->slider_key', 
                '$this->featured', '$this->sypnosis', '$this->release_date', '$this->image_url');";
        $this->conn->query($sql);

        $saveId = $this->conn->insert_id;
        echo $saveId;
        if ($saveId > 0) {
            echo "id valid";
            $this->addGenre($this->genre_id, $saveId);
            $this->addSource($this->source, $saveId);
            $this->addProducer($this->producers, $saveId);
            $this->addStudio($this->studio_id, $saveId);
        } else {
            echo "id invalid";
        }
        if ($this->conn->affected_rows == 1 && $this->conn->insert_id > 0) {
            return $saveId;
        }
    }


    ########################################done by myself

    // public function save()
    // {
    //     // genre_id, studio_id,
    //     $sql = "insert into post (title, type,duration, aired, episodes, status, slider_key, featured, sypnosis,  release_date,image_url) values ('$this->title', 
    //     '$this->type',
    //     '$this->duration',
    //     '$this->aired',
    //     $this->episodes, 
    //     '$this->status', 
    //     '$this->slider_key', 
    //     '$this->featured', 
    //      '$this->sypnosis',
    //      '$this->release_date',
    //      '$this->image_url'); ";
    //      //  '$this->genre_id',	
    //      $this->conn->query($sql);
    //      $saveId = $this->conn->insert_id;
    //      //  '$this->studio_id',
    //      $this->addGenre($this->genre_id, $saveId);
    //      $this->addSource($this->source,$saveId);
    //      $this->addProducer($this->producers,$saveId);
    //      $this->addStudio($this->studio_id,$saveId);
    //     if ($this->conn->affected_rows == 1 && $this->conn->insert_id > 0) {
    //         return $this->conn->insert_id;
    //     }
    // }

    public function delete()
    {
        // $sql = "delete from post where id = '$this->id';";
        // Delete associated rows from post_joins
        $this->conn->query("DELETE FROM post_joins WHERE post_id = $this->id");

        // Now delete the post
        $this->conn->query("DELETE FROM post WHERE id = $this->id");

        // $this->conn->query($sql);
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
        // if ($genre_res && $source_res && $producer_res && $studio_res) {
        //     echo "true";
        // }
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
        $sql = "select group_concat(source_id) from post_joins where post_id = '$this->id';";
        $currentSource = $this->select($sql);
        $sourceToDelete = array_diff($currentSource, $this->source);
        $sourceToAdd = array_diff($this->source, $currentSource);

        echo "<pre>";
        echo "current Source ";
        print_r($currentSource);
        echo "del Source ";
        print_r($sourceToDelete);
        echo "add Source ";
        print_r($sourceToAdd);
        echo "<pre>";

        // if (!empty($sourceToDelete)) {
        //     foreach ($sourceToDelete as $deleteSource) {
        //         $sql = "delete from post_joins where post_id = '$this->id' and source_id = '$deleteSource';";
        //         $this->conn->query($sql);
        //     }
        // }
        // if (!empty($sourceToAdd)) {
        //     $this->addSource($sourceToAdd, $this->id);
        // }
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function addSource($sourceToAdd, $newId)
    {
        // if(empty($this->id)){
        //     $newId = $this->conn->insert_id;
        // }
        // $newId = $this->id;
        print_r($sourceToAdd);
        echo $newId;
        foreach ($sourceToAdd as $key => $addSource) {
            echo $addSource;
            $sql = "insert into post_joins(post_id, source_id) values('$newId',  '$addSource');";
            $this->conn->query($sql);
        }
        if ($this->conn->affected_rows > 0) {
            echo 'added 1';
            return true;
        } else {
            return false;
        }
    }
    public function updateStudio()
    {
        $sql = "select group_concat(studio_id) from post_joins where post_id = '$this->id';";
        $currentStudio = $this->select($sql);
        $studioToDelete = array_diff($currentStudio, $this->studio_id);
        $studioToAdd = array_diff($this->studio_id, $currentStudio);
        echo "<pre>";
        echo "cur studio";
        print_r($currentStudio);
        echo "add";

        print_r($studioToAdd);
        echo "del";

        print_r($studioToDelete);
        echo "<pre>";
        // if (!empty($studioToDelete)) {
        //     foreach ($studioToDelete as $deleteGenre) {
        //         $sql = "delete from post_joins where post_id = '$this->id' and studio_id = '$deleteGenre';";
        //         $this->conn->query($sql);
        //     }
        // }
        // if (!empty($studioToAdd)) {
        //     $this->addStudio($studioToAdd, $this->id);
        // }
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function addStudio($studioToAdd, $newId)
    {
        // if(empty($this->id)){
        //     $newId = $this->conn->insert_id;
        // }
        // $newId = $this->id;
        foreach ($studioToAdd as $addStudio) {
            $sql = "insert into post_joins(post_id, studio_id) values('$newId',  '$addStudio');";
            $this->conn->query($sql);
        }
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateGenre()
    {
        $sql = "select group_concat(genre_id) from post_joins where post_id = '$this->id';";
        $currentGenre = $this->select($sql);
        $dbGenre = explode(',', $currentGenre);
        $genreToDelete = array_diff($currentGenre, $this->genre_id);
        $genreToAdd = array_diff($this->genre_id, $currentGenre);

        echo "<pre>";
        echo 'c genre';
        print_r($currentGenre);
        echo "del";

        print_r($genreToDelete);
        echo "add";

        print_r($genreToAdd);
        echo "<pre>";
        // if (!empty($genreToDelete)) {
        //     foreach ($genreToDelete as $deleteGenre) {
        //         $sql = "delete from post_joins where post_id = '$this->id' and genre_id = '$deleteGenre';";
        //         $this->conn->query($sql);
        //     }
        // }
        // if (!empty($genreToDelete)) {
        //     $this->addGenre($genreToAdd, $this->id);
        // }
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addGenre($genreToAdd, $newId)
    {
        // if(empty($this->id)){
        //     $newId = $this->conn->insert_id;
        // }
        // $newId = $this->id;
        foreach ($genreToAdd as $addGenre) {
            $sql = "insert into post_joins(post_id, genre_id) values('$newId',  '$addGenre');";
            $this->conn->query($sql);
        }
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }
    public function updateProducer()
    {

        $sql = "select group_concat(producer_id) from post_joins where post_id = '$this->id';";
        $currentProducer = $this->select($sql);
        $producerToDelete = array_diff($currentProducer, $this->producers);
        $producerToAdd = array_diff($this->producers, $currentProducer);

        echo "<pre>";
        echo "c producer";
        print_r($currentProducer);
        echo "del";
        print_r($producerToDelete);
        echo "add";
        print_r($producerToAdd);
        echo "<pre>";
        // if (!empty($producerToDelete)) {
        //     foreach ($producerToDelete as $deleteProducer) {
        //         $sql = "delete from post_joins where post_id = '$this->id' and producer_id = '$deleteProducer';";
        //         $this->conn->query($sql);
        //     }
        // }
        // if(!empty($producerToAdd)){
        //     $this->addProducer($producerToAdd, $this->id);
        // }
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function addProducer($producerToAdd, $newId)
    {
        // if(empty($this->id)){
        //     $newId = $this->conn->insert_id;
        // }
        // $newId = $this->id;
        foreach ($producerToAdd as $addProducer) {
            $sql = "insert into post_joins(post_id, producer_id) values('$newId',  '$addProducer');";
            $this->conn->query($sql);
        }
        if ($this->conn->affected_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function fetch()
    {
        // $sql = "select * from post;";
        // $sql = "SELECT p.*, s.source, pr.producers, st.studio, g.genre FROM post p INNER JOIN post_joins pj ON p.id = pj.post_id LEFT JOIN source s ON pj.source_id = s.id LEFT JOIN producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id;";
        $sql = "select p.*, group_concat(s.source) as source, group_concat(s.id) as source_id, group_concat(pr.producers) as producer,group_concat(pr.id) as producer_id, group_concat(st.studio) as studio,group_concat(st.id) as studio_id, group_concat(g.genre) as genre, group_concat(g.id) as genre_id from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id;";
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if ($result->num_rows > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function getById()
    {
        // $sql = "select p.*, group_concat(s.source) as source, group_concat(pr.producers) as producer, group_concat(st.studio) as studio, group_concat(g.genre) as genre from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id
        // where p.id = '$this->id';";

        $sql = "select p.*, group_concat(s.source) as source, group_concat(s.id) as source_id, group_concat(pr.producers) as producer,group_concat(pr.id) as producer_id, group_concat(st.studio) as studio,group_concat(st.id) as studio_id, group_concat(g.genre) as genre, group_concat(g.id) as genre_id from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id;";
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
        return $this->select($sql);
    }
}
