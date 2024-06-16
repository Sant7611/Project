<?php

include('../../admin/class/comment.class.php');

if (isset($_GET['id'])) {
    $post_id = $_GET['id'];

    $comment = new Comment();

    $result = $comment->getComment($post_id);

    header('Content-type: application/json');
    echo json_encode($result);
} else {
    echo json_encode(array('error' => 'Post ID not provided'));
}
