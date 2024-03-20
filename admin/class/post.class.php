<?php
require_once('common.class.php');
class Post extends Common
{
    private $conn;
    public $id, $title, $type, $episodes, $status,
        $source, $producers, $aired, $duration, $slider_key, $featured, $sypnosis, $modified_date, $genre_id,  $studio_id, $release_date, $image_url, $slider_img, $created_date, $limit, $page;

    public function __construct()
    {
        $this->conn = mysqli_connect('localhost', 'root', '', 'anidb');
    }


    public function save()
    {
        $sql = "insert into post (title, type, duration, aired, episodes, status, slider_key, featured, sypnosis, release_date,slider_img, image_url,created_date) 
                values ('$this->title', '$this->type', '$this->duration', '$this->aired', '$this->episodes', '$this->status', '$this->slider_key', 
                '$this->featured', '$this->sypnosis', '$this->release_date','$this->slider_img', '$this->image_url', '$this->created_date');";
        if (!empty($this->limit)) {
            $sql .= 'limit $this->limit';
        }

        $this->conn->query($sql);

        $saveId = $this->conn->insert_id;
        $this->addGenre($this->genre_id, $saveId);
        $this->addSource($this->source, $saveId);
        $this->addProducer($this->producers, $saveId);
        $this->addStudio($this->studio_id, $saveId);
        // echo "<pre>";
        // print_r($this->conn);
        // echo "</pre>";
        if ($this->conn->affected_rows >= 1) {
            return 'success';
        } else {
            return 'failed';
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
            $msg = "success";
            return $msg;
        }
    }
    public function edit()
    {
        $this->updateGenre();
        $this->updateSource();
        $this->updateProducer();
        $this->updateStudio();
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
                    slider_img = '$this->slider_img',
                    image_url = '$this->image_url',
                    modified_date = '$this->modified_date'
                    where id = '$this->id';    ";

        $this->conn->query($sql);
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
        if ($this->conn->affected_rows > 0) {
            // echo "returned data";
            // 123;
            return "success";
        } else {
            return false;
        }
    }


    public function updateSource()
    {
        $sql = "select group_concat(distinct source_id) as source from post_joins where post_id = '$this->id';";
        $res = $this->conn->query($sql);
        $currentSource = $res->fetch_all(MYSQLI_ASSOC);


        // print_r($currentSource);

        $concat = $currentSource[0]['source'];
        $currentSourceId = explode(',', $concat);

        $sourceToDelete = array_diff($currentSourceId, $this->source);
        $sourceToAdd = array_diff($this->source, $currentSourceId);

        // echo "<pre>";
        // echo gettype($currentSource);
        // echo "this source";
        // print_r($this->source);
        // echo "current Source ";
        // print_r($currentSourceId);
        // echo "del Source ";
        // print_r($sourceToDelete);
        // echo "add Source ";
        // print_r($sourceToAdd);
        // echo "</pre>";

        if (!empty($sourceToDelete)) {
            foreach ($sourceToDelete as $deleteSource) {
                $sql = "delete from post_joins where post_id = '$this->id' and source_id = '$deleteSource';";
                $this->conn->query($sql);
            }
        }
        if (!empty($sourceToAdd)) {
            $this->addSource($sourceToAdd, $this->id);
        }
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
        // print_r($sourceToAdd);
        // echo $newId;
        foreach ($sourceToAdd as  $addSource) {
            // echo $addSource;
            $sql = "insert into post_joins(post_id, source_id) values('$newId',  '$addSource');";
            $this->conn->query($sql);
        }
        // if ($this->conn->affected_rows > 0) {
        //     echo 'added 1';
        //     return true;
        // } else {
        //     return false;
        // }
    }
    public function updateStudio()
    {
        $sql = "select group_concat(studio_id) as studio from post_joins where post_id = '$this->id';";
        $currentStudio = $this->select($sql);

        $concat = $currentStudio[0]['studio'];
        $currentStudioId = explode(',', $concat);
        $studioToDelete = array_diff($currentStudioId, $this->studio_id);
        $studioToAdd = array_diff($this->studio_id, $currentStudioId);
        // echo "<pre>";
        // echo 'this studioid';
        // print_r($this->studio_id);
        // echo "cur studio";
        // print_r($currentStudioId);
        // echo "add";

        // print_r($studioToAdd);
        // echo "del";

        // print_r($studioToDelete);
        // echo "<pre>";
        if (!empty($studioToDelete)) {
            foreach ($studioToDelete as $deleteGenre) {
                $sql = "delete from post_joins where post_id = '$this->id' and studio_id = '$deleteGenre';";
                $this->conn->query($sql);
            }
        }
        if (!empty($studioToAdd)) {
            $this->addStudio($studioToAdd, $this->id);
        }
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
        // if ($this->conn->affected_rows > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
    }
    public function updateGenre()
    {
        // Retrieve current genres associated with the post
        $sql = "SELECT GROUP_CONCAT(genre_id) AS genres FROM post_joins WHERE post_id = '$this->id';";
        $currentGenres = $this->select($sql);

        // Extract current genre IDs
        $currentGenreIds = explode(',', $currentGenres[0]['genres']);

        // Find genres to delete and add
        $genresToDelete = $this->customArrayDiff($currentGenreIds, $this->genre_id);
        $genresToAdd = $this->customArrayDiff($this->genre_id, $currentGenreIds);

        // Output for debugging
        echo "<pre>";
        print_r($currentGenres);
        echo "Current genres<br>";
        print_r($this->genre_id);
        echo "New genres<br>";
        print_r($currentGenreIds);
        echo "Existing genre IDs<br>";
        print_r($genresToDelete);
        echo "Genres to delete<br>";
        print_r($genresToAdd);
        echo "Genres to add<br>";
        echo "</pre>";

        // Delete duplicate genres
        if (!empty($genresToDelete)) {
            foreach ($genresToDelete as $deleteGenre) {
                $sql = "DELETE FROM post_joins WHERE post_id = '$this->id' AND genre_id = '$deleteGenre';";
                $this->conn->query($sql);
            }
        }

        // Add new genres
        if (!empty($genresToAdd)) {
            $this->addGenre($genresToAdd, $this->id);
        }

        return true; // Indicate success
    }

    public function addGenre($genresToAdd, $newId)
    {
        foreach ($genresToAdd as $addGenre) {
            $sql = "INSERT INTO post_joins (post_id, genre_id) VALUES ('$newId', '$addGenre');";
            $this->conn->query($sql);
        }
    }

    public function updateProducer()
    {

        $sql = "select group_concat(producer_id) as producer from post_joins where post_id = '$this->id';";
        $currentProducer = $this->select($sql);
        $concat = $currentProducer[0]["producer"];
        $currentProducerId = explode(',', $concat);
        $producerToDelete = array_diff($currentProducerId, $this->producers);
        $producerToAdd = array_diff($this->producers, $currentProducerId);

        // echo "<pre> <div style = 'position:relative; background- #fff;'";
        // echo 'this producerid';
        // print_r($this->producers);
        // echo "c producer";
        // print_r($currentProducerId);
        // echo "del";
        // print_r($producerToDelete);
        // echo "add";
        // print_r($producerToAdd);
        // echo "</div><pre>";
        if (!empty($producerToDelete)) {
            foreach ($producerToDelete as $deleteProducer) {
                $sql = "delete from post_joins where post_id = '$this->id' and producer_id = '$deleteProducer';";
                $this->conn->query($sql);
            }
        }
        if (!empty($producerToAdd)) {
            $this->addProducer($producerToAdd, $this->id);
        }
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
        // if ($this->conn->affected_rows > 0) {
        //     return true;
        // } else {
        //     return false;
        // }
    }

    public function fetch()
    {
        // $sql = "select * from post;";
        // $sql = "SELECT p.*, s.source, pr.producers, st.studio, g.genre FROM post p INNER JOIN post_joins pj ON p.id = pj.post_id LEFT JOIN source s ON pj.source_id = s.id LEFT JOIN producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id;";
        // $sql = "select p.*, group_concat(s.source) as source, group_concat(s.id) as source_id, group_concat(pr.producers) as producer,group_concat(pr.id) as producer_id, group_concat(st.studio) as studio,group_concat(st.id) as studio_id, group_concat(g.genre) as genre, group_concat(g.id) as genre_id from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id;";

        $sql = "SELECT 
        p.*, 
        GROUP_CONCAT(DISTINCT s.source) AS source, 
        GROUP_CONCAT(DISTINCT s.id) AS source_id, 
        GROUP_CONCAT(DISTINCT pr.producers) AS producer, 
        GROUP_CONCAT(DISTINCT pr.id) AS producer_id, 
        GROUP_CONCAT(DISTINCT st.studio) AS studio, 
        GROUP_CONCAT(DISTINCT st.id) AS studio_id, 
        GROUP_CONCAT(DISTINCT g.genre) AS genre, 
        GROUP_CONCAT(DISTINCT g.id) AS genre_id 
    FROM 
        post p 
    LEFT JOIN 
        post_joins pj ON p.id = pj.post_id 
    LEFT JOIN 
        source s ON pj.source_id = s.id 
    LEFT JOIN 
        producers pr ON pj.producer_id = pr.id 
    LEFT JOIN 
        studio st ON pj.studio_id = st.id 
    LEFT JOIN 
        genre g ON pj.genre_id = g.id 
    GROUP BY 
        p.id
    ORDER BY 
        p.release_date desc
    LIMIT 12;
    
    ";
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);

        if ($result->num_rows > 0) {
            return $data;
        } else {
            return false;
        }
    }

    public function sortCreatedDate($limit)
    {
        // $sql = "select * from post;";
        // $sql = "SELECT p.*, s.source, pr.producers, st.studio, g.genre FROM post p INNER JOIN post_joins pj ON p.id = pj.post_id LEFT JOIN source s ON pj.source_id = s.id LEFT JOIN producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id;";
        // $sql = "select p.*, group_concat(s.source) as source, group_concat(s.id) as source_id, group_concat(pr.producers) as producer,group_concat(pr.id) as producer_id, group_concat(st.studio) as studio,group_concat(st.id) as studio_id, group_concat(g.genre) as genre, group_concat(g.id) as genre_id from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id;";



        $sql = "SELECT 
        p.*, 
        GROUP_CONCAT(DISTINCT s.source) AS source, 
        GROUP_CONCAT(DISTINCT s.id) AS source_id, 
        GROUP_CONCAT(DISTINCT pr.producers) AS producer, 
        GROUP_CONCAT(DISTINCT pr.id) AS producer_id, 
        GROUP_CONCAT(DISTINCT st.studio) AS studio, 
        GROUP_CONCAT(DISTINCT st.id) AS studio_id, 
        GROUP_CONCAT(DISTINCT g.genre) AS genre, 
        GROUP_CONCAT(DISTINCT g.id) AS genre_id 
    FROM 
        post p 
    LEFT JOIN 
        post_joins pj ON p.id = pj.post_id 
    LEFT JOIN 
        source s ON pj.source_id = s.id 
    LEFT JOIN 
        producers pr ON pj.producer_id = pr.id 
    LEFT JOIN 
        studio st ON pj.studio_id = st.id 
    LEFT JOIN 
        genre g ON pj.genre_id = g.id 
    GROUP BY 
        p.id
    ORDER BY 
        p.created_date desc
    
    ";

        $post_per_page = 5;

        if ($limit != 0) {
            $sql .= ' Limit ' . $limit . ';';
        } else {
            if (isset($this->page)) {

                $pg = intval($this->page);
            } else {
                $pg = 1;
            }
            // echo $pg;
            $start_from = ($pg - 1) * $post_per_page;

            $sql .= ' limit ' . $start_from . ' , ' . $post_per_page . ' ;';
        }

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
        // $sql = "select p.*, group_concat(s.source) as source, group_concat(pr.producers) as producer, group_concat(st.studio) as studio, group_concat(g.genre) as genre from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id where p.id = '$this->id';";

        $sql = "select p.*, group_concat(distinct s.source) as source, group_concat(distinct s.id) as source_id, group_concat(distinct pr.producers) as producer,group_concat(distinct pr.id) as producer_id, group_concat(distinct st.studio) as studio,group_concat(distinct st.id) as studio_id, group_concat(distinct g.genre) as genre, group_concat(distinct g.id) as genre_id from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id where post_id = '$this->id';";

        $var = $this->conn->query($sql);
        if ($this->conn->affected_rows == 1) {
            $result = $var->fetch_object();
            return $result;
        } else {
            return [];
        }
    }

    // public function recommendation($limit)
    // {

    //     // select genre of this id
    //     $sql = "select group_concat(genre_id) as genres from post_joins where post_id = '$this->id';";
    //     $genres = $this->conn->query($sql);
    //     $genreList = explode(',', $genres);

    //     // select post based on the available genres
    //     foreach ($genreList as $genre) {
    //         $sql = "select p.*, group_concat(distinct s.source) as source, group_concat(distinct s.id) as source_id, group_concat(distinct pr.producers) as producer,group_concat(distinct pr.id) as producer_id, group_concat(distinct st.studio) as studio,group_concat(distinct st.id) as studio_id, group_concat(distinct g.genre) as genre, group_concat(distinct g.id) as genre_id from post p inner join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join producers pr ON pj.producer_id = pr.id LEFT JOIN studio st ON pj.studio_id = st.id LEFT JOIN genre g ON pj.genre_id = g.id where post_id != $this->id and genre_id  = '$genre') ";
    //         $res = $this->conn->query($sql);
    //         $res->fetch_all(MYSQLI_ASSOC);
    //     }
    //     if ($limit != 0) {
    //         $sql .= " limit $limit;";
    //     } else {
    //         $sql .= ';';
    //     }


    //     $res = $this->conn->query($sql);
    //     if ($res->num_rows > 0) {
    //         return $res->fetch_assoc();
    //     } else {
    //         return [];
    //     }
    // }


    public function recommendation($limit)
    {

        $conn = mysqli_connect('localhost', 'root', '', 'anidb');
        $sql = "SELECT GROUP_CONCAT(genre_id) AS genres FROM post_joins WHERE post_id = '{$this->id}'";
        $genresResult = $conn->query($sql);
        $genresRow = $genresResult->fetch_assoc();
        $genreList = explode(',', $genresRow['genres']);

        $sql = "(";
        foreach ($genreList as $index => $genreId) {
            $sql .= "SELECT post_id FROM post_joins WHERE genre_id = '$genreId'";
            if ($index < count($genreList) - 1) {
                $sql .= " UNION ";
            }
        }
        $sql .= ");";

        $res = $conn->query($sql);
        $postList = $res->fetch_all(MYSQLI_ASSOC);

        $post_ids = [];
        for ($i = 0; $i < count($postList); $i++) {
            if ($postList[$i]['post_id'] == $this->id) {
                $limit += 1;
                continue;
            }
            if ($limit != 0) {
                if ($i == ($limit)) {
                    break;
                } else {
                    $post_ids[] = $postList[$i]['post_id'];
                }
            } else {
                $post_ids[] = $postList[$i]['post_id'];
            }
        }

        foreach ($post_ids as $key => $postId) {
            // echo $postId;
            // Prepare the SQL query for each post ID
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
            WHERE post_id = '$postId'";

            // Execute the query
            $result = $conn->query($sql);

            // Check if query executed successfully
            if ($result === FALSE) {
                echo "Error: ";
            } else {
                // Fetch the results for the current post ID
                $postResults[$postId] = array();
                while ($row = $result->fetch_assoc()) {
                    $postResults[$postId] = $row;
                }
            }
        }
        return $postResults;
    }


    // public function selectPostById()
    // {
    //     $sql = "select * from post where id = '$this->id';";
    //     $result = $this->conn->query($sql);
    //     if ($result->num_rows == 1) {
    //         $var = $result->fetch_all(MYSQLI_ASSOC);
    //         return $var;
    //     } else {
    //         return [];
    //     }
    // }
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
        $sql = "select * from post where status = 1 and slider_key = 1 order by release_date desc limit 3;";
        return $this->select($sql);
    }

    public function selectPostByGenre()
    {
        $sql = "select p.*, group_concat(distinct s.source) as source, group_concat(distinct g.genre) as genre , group_concat(distinct pr.producer) as producer, group_concat(distinct s.studio) as studio from post p left join post_joins pj on p.id = pj.post_id left join source s on pj.source_id = s.id left join genre g on pj.id = genre.id left join producer pr on pj.producer_id = producer.id left join studio s on pj.studio_id = studio.id where genre_id = $this->genre_id;";
        return $this->select($sql);
    }
    public function allPost()
    {
        $conn = mysqli_connect('localhost', 'root', '', 'anidb');
        $sql = 'SELECT * FROM post';

        $res = $conn->query($sql);
        return $res->num_rows;
    }
}
