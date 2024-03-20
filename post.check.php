<?php
include_once('admin/class/post.class.php');

include('user/header-footer/header.php');


$post = new Post();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post->set('id', $_GET['id']);
}

$selectedPost = $post->getById();
// $datalist = $post->sortCreatedDate(6);
$datalist = $post->recommendation(6);


// echo "<pre>";
// print_r($selectedPost);
// echo "</pre>";



// $studioList = explode(',', $selectedPost->studio);

?>
<style>
    .post-head {
        /* display: flex; */
        /* justify-content: space-between; */
        width: 100%;
        padding: 25px 0 10px 0px;
    }

    .post-head span {
        /* border-right: 1px solid #eee; */
        padding: 0px 40px 5px 0;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        font-family: "Nunito";
    }

    .post-syp {
        width: 95%;
        padding-left: 390px;
        text-align: left;
        /* margin-top: 5px; */
        font-family: "Mukta";
        font-weight: 300;
        margin-top: 10px;
    }

    .post-syp h3 {
        padding-top: 5px;
        border-top: 1px solid #eee;
    }

    .tags-container {
        margin-top: 4px;
        padding-bottom: 15px;
    }
</style>

<div class="overview">
    <div class="background-img overlay">
        <img src="admin/images/sliderImage/<?php echo $selectedPost->slider_img; ?>" width="100%" alt="" srcset="">
        <div class="img-title">
            <h1><?php echo $selectedPost->title; ?></h1>
            <i>Alt title: </i>
            <h6 class="alt-title">Kimetsu na moto</h6>
        </div>
    </div>
    <div class="box-main">
        <div class="post-img">
            <img src="admin/images/<?php echo $selectedPost->image_url; ?>" width="100px" alt="" srcset="">
        </div>
        <div class="post-desc">
            <div class="post-syp">
                <div class="post-head">

                    <div>
                        <span>Episodes: </span> <span><?php echo $selectedPost->episodes; ?></span>
                    </div>
                    <div>
                        <span>Type: </span> <span class="center"><?php if ($selectedPost->type == 'TV Series') {
                                                                        // echo '<i class=" material-icons-outlined ">tv</i> ';
                                                                    }
                                                                    echo $selectedPost->type; ?></span>
                    </div>
                    <div>
                        <span>Duration :</span>
                        <span><?php echo $selectedPost->duration; ?></span>
                    </div>
                    <div>
                        <span>Released:</span>
                        <span class="center"><?php echo substr($selectedPost->aired, 0, 4) ?></span>
                    </div>
                    <div>

                        <span>Rating:</span><span><?php echo 'Rating'; ?></span>
                    </div>
                </div>
                <h3>Description</h3>
                <?php echo substr($selectedPost->sypnosis, 0, 2000); ?>
                <div class="tags-container">
                    <span class="title">Tags: </span>
                    <?php $genres = explode(',', $selectedPost->genre);
                    for ($i = 0; $i < count($genres); $i++) { ?>
                        <span class="tags"><?php echo $genres[$i]; ?></span>

                    <?php } ?>
                </div>

                <div class="post-head">
                    <h3>More Details</h3>
                    <div>
                        <span>Origination: </span><span><?php echo $selectedPost->source ?></span>
                    </div>
                    <div>
                        <span>Studio :</span><span><?php echo $selectedPost->studio; ?></span>
                    </div>
                    <div>
                        <span>Producer :</span>
                        <span><?php echo $selectedPost->producer; ?></span>
                    </div>
                    <div>
                        <span>Aired :</span>
                        <span><?php echo substr($selectedPost->aired, 0, 4); ?></span>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<div id="recommend " class="section">
    <div class="head-title">
        <h3>You might also like</h3>
    </div>
    <div class="collection">
        <?php foreach ($datalist as $key => $post) {
            // if ($post['id'] == $selectedPost->id) {

            //     continue;
            // }
        ?>
            <div class="gallery">
                <a href="post.php?id=<?php echo $post['id']; ?>">
                    <div class="img">
                        <img src="admin/images/<?php echo $post['image_url'] ?>" alt="">
                        <div class="gallery-overlay"></div>
                        <div class="desc">
                        </div>
                        <h4 class="card-title"><?php echo $post['title']; ?></h4>
                    </div>
                </a>
                <div class="gallery-detail">
                    <h2><?php echo $post['title']; ?></h2>
                    <div class="line">
                        <span class="middle"><i class="material-icons-outlined tv">tv</i> TV(<?php echo $post['episodes']; ?>eps)</span>
                        <span><?php $studio = explode(',', $post['studio']);
                                echo $studio[0]; ?></span>
                        <span><?php echo $post['release_date']; ?></span>
                        <span>Rating</span>
                    </div>
                    <div class="abstract">
                        <?php $sypnosis = substr($post['sypnosis'], 0, 450);
                        echo $sypnosis; ?>....
                    </div>
                    <div class="tags-container">
                        <span class="title">Tags: </span>
                        <?php $genres = explode(',', $post['genre']);
                        foreach ($genres as $key => $genre) { ?>
                            <span class="tags"><?php echo $genre; ?></span>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<?php
include('user/header-footer/footer.php');
?>