<?php
include('../admin/class/wishlist.class.php');
$wishlist = new Wishlist();

// $wishlist->post_id = $_GET['post_id'];
// $wishlist->user_id = $_GET['user_id'];
$wishlist->post_id = filter_input(INPUT_POST, "post_id", FILTER_SANITIZE_NUMBER_INT);
$wishlist->user_id = filter_input(INPUT_POST, "user_id", FILTER_SANITIZE_NUMBER_INT);
// $status = $_GET['status'];
// $status = $_POST['status'];

// $data = $wishlist->checkWishlist();
$data = ['result' => 'delete'];
echo json_encode($data);
// echo 'hello';

// switch ($status) {
//     case 'insert':
//         // $data = ['result' => 'insert'];
//         // echo json_encode($data);
//         $wishlist->save();
//         break;
//     case 'delete':
//         // $data = ['result' => 'delete'];
//         // echo json_encode($data);
//         $wishlist->delete();
//         break;
//     case 'fetchById':
//         // $result = $wishlist->fetchById();
//         // echo json_encode($result);

//         $data = ['result' => 'delete'];
//         echo json_encode($data);
//         break;
// }
// // if ($check == true) {
// //     $data = ['result' => true, 'msg' => 'it is wishlisted'];
// // } else {
// //     $data = ['status' => 'error', 'msg' => 'it is not wishlisted'];
// // }
// // echo json_encode($data);
