<?php
session_start();
if (isset($_SESSION['uname'])) {
    $uname = $_SESSION['uname'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Google font  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Mukta:wght@200;300;400;500;600;700;800&family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap" rel="stylesheet">

    <!-- custom css  -->

    <link rel="stylesheet" href="sty.css">
</head>

<body>
    <nav class="navbar ">
        <ul class="nav_list">
            <li><a href="#home">Home</a></li>
            <li><a href="#new_release">New Release</a></li>
            <li> <a href="#most_popular">Most Popular</a></li>
            <li><a href="#tv_series">TV Series</a></li>
        </ul>
        <?php
        if (empty($uname)) { ?>
            <div class="button">
                <a href="signup.php">Sign in</a>
            </div>
        <?php  } ?>

    </nav>
    <div class="box-main">
        <div id="home">

            <!-- <div class="first"><img src="" alt=""> </div>
            <div class="second">
                <input type="text" name="search" id="search" placeholder="SEARCH ANIME MOVIES AND TV-SERIES">
                <button class="search">Search </button>
            </div>
            <div class="third">View Full Site > </div> 
            <div class="naruto"><img src="" alt=""></div>-->
            <div class="container">
                <div class="left-container">
                    <img src="admin/images/65d704da399b1WIN_20200319_11_38_35_Pro.jpg" alt="Image">
                </div>
                <div class="right-container">
                    <h2>Post Title</h2>
                    <p>Post details go here...</p>
                </div>
            </div>

        </div>
        <div id="new_release">

        </div>
        <div id="most_popular">

        </div>
        <div id="tv_series">

        </div>
    </div>


</body>

</html>