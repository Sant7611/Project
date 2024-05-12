<?php

$conn = mysqli_connect('localhost', 'root', '', 'anidb');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $postid = $_POST['postid'];
    if (isset($_POST['userid'])) {
        $rate = ++$_POST['rate'];
        $userid = $_POST['userid'];

        $check = $conn->query("select * from rating where post_id = $postid and user_id = $userid; ");
        if ($check->num_rows == 0) {
            $conn->query("insert into rating(user_id, post_id, rate) values ('$userid', '$postid', '$rate');");
        } else {
            if($rate == 0){}else{
                $conn->query("update rating set rate = $rate where post_id = $postid and user_id = $userid;");
            }
            $check = $conn->query("select rate from rating where post_id = $postid and user_id = $userid; ");
            $curRating = $check->fetch_assoc();
        }
    } else {
        $result = ['status' => 'error', 'message' => 'Please login to rate'];
        return json_encode($result);
    }
    $output = $conn->query("select round(avg(rate), 2) as rating from rating;");
    $message = $output->fetch_assoc();
    $result = ['status' => 'success', 'message' => 'Thank you for rating', 'rating' => $message['rating'], 'curRating' => --$curRating['rate']];
    echo json_encode($result);
}
