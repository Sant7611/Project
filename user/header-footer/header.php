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
        /* border-bottom: 1px solid #eee; */
        list-style: none;
    }

    .dropdown-menu a:hover {
        background: #ae7eeb;
    }

    /* search bar */
    .search-result {
        display: none;
        overflow: auto;
        padding: 5px;
        max-height: 300px;
        position: absolute;
        z-index: 2;
        background: #eee;
        width: 465px;
        top: 50px;
        scrollbar-width: thin;
        right: 70px;
        border-radius: 5px;
    }

    .search-data {

        display: flex;
        padding: 5px;
        border-radius: 5px;
    }

    .search-data:hover {
        background: #c9c5c5;
    }

    .search-data-image>.search-img {
        vertical-align: middle;
        height: 4rem;
        object-fit: cover;
        width: 2.6rem;
    }

    .search-data-title {
        padding: 0px 0 0 10px;
    }

    .sub-text {
        color: #8d8d8d;
    }
</style>

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
                            <li class="dropdown-menu"><a href="wishlist.php?id=<?php echo $id; ?>">
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
                    // url: 'user/search.php',
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

                // $('#search').on('click', function(event) {
                //     var searchData = $('.search-result');
                //     if (!searchData.contains(event)) {
                //         searchData.css(display, 'none');
                //     }
                // });
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