<?php
    session_start();
    $id = $_GET['id'];

    include('../class/post.class.php');
    $newsObject = new Post();
    $newsObject->set('id', $id);
    $status = $newsObject->delete();
    if($status == 'success'){
        $_SESSION['message']='Post Deleted Successfully!';
        header('location:listPost.php');
    }else{
        $_SESSION['msg']="failed To Delete Post!";
        header('location:listPost.php');
    }  
 