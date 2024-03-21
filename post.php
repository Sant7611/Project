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
// print_r($postResults);
// echo "</pre>";



$studioList = explode(',', $selectedPost->studio);

?>

<div class="overview">
    <div class="background-img overlay">
        <img src="admin/images/sliderImage/<?php echo $selectedPost->slider_img; ?>" width="100%" alt="" srcset="">
        <div class="img-title">
            <h1><?php echo $selectedPost->title; ?></h1>
            <i>Alt title: </i>
            <h6 class="alt-title"><?php echo $selectedPost->alt_title ?></h6>
        </div>
    </div>
    <div class="box-main">
        <div class="post-img">
            <img src="admin/images/<?php echo $selectedPost->image_url; ?>" width="100px" alt="" srcset="">
        </div>
        <div class="post-desc">
            <div class="post-head">
                <span><?php echo $selectedPost->episodes . 'eps'; ?></span>
                <span class="center"><?php if ($selectedPost->type == 'TV Series') {
                                            echo '<i class=" material-icons-outlined ">tv</i> ';
                                        }
                                        echo $selectedPost->type; ?></span>
                <span class="center"><i class="material-icons-outlined ">calendar_month</i> <?php echo substr($selectedPost->aired, 0, 4) ?></span>
                <span><?php echo $studioList[0]; ?></span>
                <span><?php echo 'Rating'; ?></span>
            </div>
            <div class="post-syp">
                <?php echo substr($selectedPost->sypnosis, 0, 2000); ?>
                <div class="tags-container">
                    <span class="title">Tags: </span>
                    <?php $genres = explode(',', $selectedPost->genre);
                    for ($i = 0; $i < count($genres); $i++) { ?>
                        <span class="tags"><?php echo $genres[$i]; ?></span>

                    <?php } ?>
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