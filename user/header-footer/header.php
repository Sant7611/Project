<?php
session_start();
if (isset($_SESSION['uname']) && isset($_COOKIE['uname'])) {
    $uname = $_SESSION['uname'];
    $id = $_SESSION['id'];
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

    <!-- jquery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="../../jquery-3.7.1.min.js"></script> -->
    <!-- jquery cookie function  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>

</head>

<body>
    <nav class="navbar ">
        <!-- <div class="logo">

        </div> -->
        <ul class="nav_list">
            <li><a href="index.php?#home">Home</a></li>
            <li><a href="index.php?#new_release">New Release</a></li>
            <li><a href="index.php?#just_added">Just Added</a></li>
            <li> <a href="index.php?#most_popular">Most Popular</a></li>
        </ul>
        <div class="vcenter">

            <div class="searchbar">
                <input type="text" placeholder="Search" autocomplete="off" name="search" id="search">
                <div class="search-result">

                </div>
            </div>
            <?php if (empty($uname)) { ?>
                <div class="button ">
                    <a href="user/login.php">Log in</a>
                </div>
            <?php  } else { ?>
                <div class="dropdown">
                    <div class="userLogo">
                        <img src="admin/images/65f186cc25edeattackontitans.jpg" alt="">
                    </div>

                    <div class="dropdown-content user-profile">
                        <ul>
                            <li class="dropdown-menu"><a href="wishlist.php">
                                    <span class="material-icons-outlined">favorite_border</span>My Wishlist
                                </a>
                            </li>
                            <li class="dropdown-menu">
                                <a href="user/changepw.php">
                                    <span class="material-icons-outlined">change_circle</span> Change Password</a>
                            </li>
                            <li class="dropdown-menu">
                                <a href="user/logout.php">
                                    <span class="material-icons-outlined">logout</span> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>
    </nav>

    <script>
        //searchbar 
        document.addEventListener("DOMContentLoaded", function() {
            $('#search').keyup(function(event) {
                var val = $('#search').val().trim();
                $.ajax({
                    url: 'user/search.php',
                    method: 'post',
                    data: {
                        searchData: val
                    },
                    // dataType: 'JSON',
                    success: function(response) {
                        // displaySearch(response);
                        $('.search-result').empty();
                        if (response.length > 0) {
                            $('.search-result').append(response);
                        }
                        // else {
                        //     $('.search-result').append('<span>No search result found </span>');
                        // }
                    },
                    error: function(xhr, status, error) {
                        console.log('error:', error);
                    }
                });
                
                var search = document.querySelector('.searchbar');
                var searchData = document.querySelector('.search-result');
                toggleDisplay(search, searchData);
                $('.search-result').css({'display' : 'block'});

            });

            var dropdown = document.querySelector('.dropdown');
            var dropcontent = dropdown.querySelector('.dropdown-content');

            dropdown.addEventListener("click", (event) => {
                dropcontent.style.display = dropcontent.style.display === 'block' ? 'none' : 'block';
            });

            function toggleDisplay(className, subClassName) {
                document.addEventListener('click', (event) => {
                    if (!className.contains(event.target)) {
                        subClassName.style.display = 'none';
                        document.getElementById('search').value = "";
                    }

                });
            }

            toggleDisplay(dropdown, dropcontent);

            // document.addEventListener('click', (event) => {
            //     if (!dropdown.contains(event.target)) {
            //         dropcontent.style.display = 'none';
            //     }
            // });


        });
    </script>