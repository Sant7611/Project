<?php
include_once("admin/class/post.class.php");
include_once("admin/class/genre.class.php");
include_once("admin/class/studio.class.php");
include_once("admin/class/user.class.php");

$post = new Post();
$genre = new Genre();
$studio = new Studio();
$user = new User();

$activePost = $post->selectActivePost();
$sliderPost = $post->selectSliderPost();
$featuredPost = $post->selectFeaturedPost();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin/style/style.css">
    <title>Otaku Oasis</title>
</head>
<body>
    
</body>
</html>