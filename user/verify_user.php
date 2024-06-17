<?php
session_start();
if ($_GET['token']) {
    $token = $_GET['token'];
    $conn = mysqli_connect('localhost', 'root', '', 'anidb');

    $sql = "select * from users where token = '$token'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<pre>';
        print_r($row);

        echo '</pre>';
        $sql = "update users set status = 'verified' where token = '$token';";
        mysqli_query($conn, $sql);
        $_SESSION['status'] = 'Your Email has been successfully verified. Login to continue';
        header('location:login.php');
    } else {
        $_SESSION['status'] = 'The token is invalid. ';
        header('location:signup.php');
    }
} else {
    $_SESSION['status'] = 'Not Allowed';
    header('location:signup.php');
}
