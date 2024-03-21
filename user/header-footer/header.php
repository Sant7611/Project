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
    <link rel="stylesheet" type="text/css" href="user/style/sty.css">
</head>

<style>
    .dropdown {
        position: relative;
        cursor: pointer;
    }

    .dropdown-content {
        overflow: hidden;
        position: absolute;
        top: 50px;
        width: 200px;
        z-index: 2;
        left: -120px;
        color: #fff;
        display: none;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgb(255 255 255 / 46%);
    }

    .dropdown-menu a {
        background: #be9ce9;
        text-decoration: none;
        display: flex;
        padding: 5px;
        color: #000;
    }

    .dropdown-menu {
        border-bottom: 1px solid #eee;
        list-style: none;
    }

    .dropdown-menu a:hover {
        background: #ae7eeb;
    }
</style>

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
            <div class="dropdown">
                <div class="userLogo">
                    <img src="admin/images/65f186cc25edeattackontitans.jpg" alt="">
                </div>

                <div class="dropdown-content user">
                    <ul>
                        <li class="dropdown-menu">
                            <a href="user/logout.php">
                                <span class="material-icons-outlined">logout</span> Logout</a>
                        </li>
                        <li class="dropdown-menu">
                            <a href="user/changepw.php">
                                <span class="material-icons-outlined">change_circle</span> Change Password</a>
                        </li>
                    </ul>
                </div>
            </div>
        <?php } ?>
    </nav>

    <script>
        // document.addEventListener("DOMContentLoaded", function() {
        //     var dropdown = document.querySelector('.dropdown');
        //     var dropcontent = dropdown.querySelector('.dropdown-content');
        //     dropdown.addEventListener("click", (event) => {
        //         dropcontent.style.display = dropcontent.style.display === 'block' ? 'none' : 'block';
        //     });
        //     document.addEventListener('click', (event) => {
        //         if (!dropcontent.contains(event.target)) {
        //             dropcontent.style.display = 'none';
        //         }
        //     });
        // });

        document.addEventListener("DOMContentLoaded", function() {
            var dropdown = document.querySelector('.dropdown');
            var dropcontent = dropdown.querySelector('.dropdown-content');

            dropdown.addEventListener("click", (event) => {
                dropcontent.style.display = dropcontent.style.display === 'block' ? 'none' : 'block';
            });

            document.addEventListener('click', (event) => {
                if (!dropdown.contains(event.target)) {
                    dropcontent.style.display = 'none';
                }
            });
        });
    </script>