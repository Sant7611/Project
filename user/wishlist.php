<?php
include('../admin/class/wishlist.class.php');
$wishlist = new Wishlist();


$wishlist->post_id = $_POST['post_id'];
$wishlist->user_id = $_POST['user_id'];
$status = $_POST['status'];

switch ($status) {
    case 'insert':
        $data = ['result' => 'insert'];
        echo json_encode($data);
        // $wishlist->save();
        break;
    case 'delete':
        $data = ['result' => 'delete'];
        echo json_encode($data);
        // $wishlist->delete();
        break;
}
