<?php
    $id = $_GET['id'];

    include('../class/post.class.php');
    $newsObject = new Post();
    $newsObject->set('id', $id);
    $status = $newsObject->delete();
    session_start();
    if($status == 'success'){
        $_SESSION['message']='News Deleted Successfully!';
        header('location:listPost.php');
    }else{
        $_SESSION['message']="failed To Delete News!";
        header('location:listPost.php');
    }  
