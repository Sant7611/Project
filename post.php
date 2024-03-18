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


?>

<div class="overview">
    <div class="background-img overlay">
        <img src="admin/images/sliderImage/<?php echo $selectedPost->slider_img; ?>" width="100%" alt="" srcset="">
        <div class="img-title">
            <h1><?php echo $selectedPost->title; ?></h1>
            <h6 class="alt-title">Kimetsu na moto</h6>
        </div>
    </div>
    <div class="box-main">
        <div class="post-img">
            <img src="admin/images/<?php echo $selectedPost->image_url; ?>" width="100px" alt="" srcset="">
        </div>
        <div class="post-desc">
            <h2></h2>
        </div>

    </div>
</div>


<?php
include('footer.php');
?>