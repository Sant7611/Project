<?php

include('../../admin/class/comment.class.php');

$comment = new Comment();

$comment_id = $_POST['comment_id'];
$post_id = $_POST['post_id'];
$user_id = $_POST['user_id'];
$commentText = $_POST['comment'];

if ($commentText != '' && !empty($commentText)) {
    $result =    $comment->submitComment($user_id, $post_id, $comment_id, $commentText);
if ($result) {

        return true;
    } else {
        return false;
    }
}
