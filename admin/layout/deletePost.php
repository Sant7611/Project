<?php
    $id = $_GET['id'];

    include('../class/news.class.php');
    $newsObject = new News();
    $newsObject->set('id', $id);
    $status = $newsObject->delete();
    session_start();
    if($status == 'success'){
        $_SESSION['message']='News Deleted Successfully!';
        header('location:listNews.php');
    }else{
        $_SESSION['message']="failed To Delete News!";
        header('location:listNews.php');
    }  
?>