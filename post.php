<?php
include_once("admin/class/post.class.php");

include('header.php');


$post = new Post();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post->set('id', $_GET['id']);
}

$selectedPost = $post->getById();

// echo "<pre>";
// print_r($selectedPost);
// echo "</pre>";
$studioList = explode(',', $selectedPost->studio);

?>

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
                <p><?php echo $selectedPost->sypnosis; ?></p>
            </div>
        </div>

    </div>
</div>


<?php
include('footer.php');
?>