<?php

include_once('../admin/class/post.class.php');
$post = new $Post;

echo $_POST['searchData'];
if(isset($_POST['searchData'])){
    // echo 'santosh';
    // $post->set('searchData', $_POST['search_data']);

    // $res = $post->search();
    // if($res){
    //     echo json_encode($res);
    // }else{
    //     $data = ['status' => 'error', 'msg' => 'No search result found'];
    //     echo json_encode($data);
    // }
}
