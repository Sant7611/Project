<?php
session_start();
if (isset($_SESSION['uname']) && isset($_COOKIE['uname'])) {
    $uname = $_SESSION['uname'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- google icons  -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Mukta:wght@200;300;400;500;600;700;800&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <!-- custom css  -->

    <link rel="stylesheet" href="sty.css">
</head>

<body>
    <nav class="navbar ">
        <div class="logo">

        </div>
        <ul class="nav_list">
            <li><a href="#home">Home</a></li>
            <li><a href="#new_release">New Release</a></li>
            <li><a href="#tv_series">Just Added</a></li>
            <li> <a href="#most_popular">Most Popular</a></li>
        </ul>
        <?php if (empty($uname)) { ?>
            <div class="button">
                <a href="signup.php">Sign in</a>
            </div>
        <?php  } else { ?>
            <div class="userLogo">
                <img src="admin/images/65f186cc25edeattackontitans.jpg" alt="">
            </div>
        <?php } ?>

    </nav>