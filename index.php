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


            <div class="slideshow-container">

                <div class="mySlides fade">
                    <div class="numbertext">1 / 3</div>
                    <img src="admin/images/animeimg1.jpg" style="width:100%;">
                    <div class="text">Caption Text</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">2 / 3</div>
                    <img src="img_snow_wide.jpg" style="width:100%">
                    <div class="text">Caption Two</div>
                </div>

                <div class="mySlides fade">
                    <div class="numbertext">3 / 3</div>
                    <img src="img_mountains_wide.jpg" style="width:100%">
                    <div class="text">Caption Three</div>
                </div>

            </div>
            <br>

            <div class="dot-container">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

        </div>
        <div id="new_release">
            <div class="collection">
                <div class="gallery">
                    <img src="https://picsum.photos/id/239/400/300" alt="">
                    <div class="desc">
                        <h4>Title1</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/238/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/276/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/267/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/241/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/242/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/243/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/244/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
                <div class="gallery">
                    <img src="https://picsum.photos/id/243/400/300" alt="">
                    <div class="desc">
                        <h4>Title</h4>
                        <p>tags </p>
                    </div>
                </div>
            </div>
        </div>
        <div id="most_popular">

        </div>
        <div id="tv_series">

        </div>
    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) {
                slideIndex = 1
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            // setTimeout(showSlides, 2000); // Change image every 2 seconds
        }
    </script>

</body>

</html>