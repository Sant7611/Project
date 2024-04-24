<?php
include('user/header-footer/header.php');
include_once('admin/class/post.class.php');

$post = new Post();

//for New Releases 
$datalist = $post->fetch();

//for Slider Post -> new released
$sliderlist = $post->selectSliderPost();

//for just added
$justlist = $post->sortCreatedDate(12);

?>
<div class="container">
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
                <?php foreach ($sliderlist as $key => $post) { ?>
                    <div class="mySlides fade">
                        <div class="numbertext"><?php echo $key + 1 ?> / 3</div>
                        <!-- <img src="admin/images/animeimg1.jpg" style="width:100%"> -->
                        <img src="<?php echo 'admin/images/sliderImage/' . $post['slider_img']; ?>" style="width:100%">';
                        <div class=" overlay text">
                            <div class="disp">
                                <div class="slide-title"><?php echo $post['title']; ?></div>
                                <span class="epidsode">Ep <?php echo $post['episodes']; ?> </span>
                                <span class="center"><i class="material-icons-outlined">cast</i>
                                    <?php $airedYear = substr($post['aired'], 0, 4);
                                    echo $airedYear;; ?>
                                </span>
                                <div class="sypnosis">
                                    <?php $sypnosis = substr($post['sypnosis'], 0, 250);
                                    echo $sypnosis; ?>....
                                </div>
                                <div class="add-btn read">
                                    <a href="post.php?id=<?php echo $post['id']; ?>">
                                        <i class="material-icons-outlined">keyboard_double_arrow_right</i>Read More</a>
                                </div>
                                <div class="add-btn">
                                    <a href="post.php?id=<?php echo $post['id']; ?>"><i class="material-icons-outlined">bookmark_border</i> Add to List</a>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php } ?>
                <!-- <div class="mySlides fade">
                <div class="numbertext">1 / 3</div>
                <img src="admin/images/animeimg1.jpg" style="width:100%"> -->
                <!-- 
                <div class=" overlay text">
                    <div class="disp">
                        <div class="slide-title">SOLO LEVELING</div>
                        <span class="epidsode">Ep 10 +</span>
                        <span class="aired">2020</span>
                        <div class="sypnosis">
                            Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nisi quisquam, vero voluptate ducimus officiis, necessitatibus laudantium expedita velit deleniti atque unde magni saepe iure aliquam quasi magnam culpa at ad harum commodi nesciunt! Placeat libero repellat excepturi possimus! Aliquam ea maiores ratione totam. Ipsam ....
                        </div>
                        <div class="add-btn">
                            <a href=""><i class="material-icons-outlined">add</i>Add to List</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">2 / 3</div>
                <img src="admin/images/naruto.jpg" style="width:100%;">
                <div class="text">
                    <span class="slider-title">Naruto</span>

                </div>
            </div>

            <div class="mySlides fade">
                <div class="numbertext">3 / 3</div>
                <img src="admin/images/attack on titans.jpg" style="width:100%">
                <div class="text">Caption Two</div>
            </div>
 -->

            </div>
            <br>

            <div class="dot-container">
                <span class="dot"></span>
                <span class="dot"></span>
                <span class="dot"></span>
            </div>

        </div>
        <div id="new_release" class="section">
            <div class="head-title">
                <h3>New Release</h3>
            </div>
            <div class="collection">
                <?php foreach ($datalist as $key => $post) { ?>
                    <div class="gallery">
                        <a href="post.php?id=<?php echo $post['id']; ?>">
                            <div class="img">
                                <img src="admin/images/<?php echo $post['image_url'] ?>" alt="">
                                <div class="gallery-overlay"></div>
                                <div class="desc">
                                </div>
                                <h4 class="card-title"><?php echo $post['title']; ?></h4>
                            </div>
                        </a>
                        <div class="gallery-detail">
                            <h2><?php echo $post['title']; ?></h2>
                            <div class="line">
                                <span class="middle"><i class="material-icons-outlined tv">tv</i> TV(<?php echo $post['episodes']; ?>eps)</span>
                                <span><?php $studio = explode(',', $post['studio']);
                                        echo $studio[0]; ?></span>
                                <span><?php echo $post['release_date']; ?></span>
                                <span>Rating</span>
                            </div>
                            <div class="abstract">
                                <?php $sypnosis = substr($post['sypnosis'], 0, 450);
                                echo $sypnosis; ?>....
                            </div>
                            <div class="tags-container">
                                <span class="title">Tags: </span>
                                <?php $genres = explode(',', $post['genre']);
                                foreach ($genres as $key => $genre) { ?>
                                    <span class="tags"><?php echo $genre; ?></span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <div id="just_added" class="section">
            <div class="head-title">
                <h3>Just Added</h3>
            </div>
            <div class="collection">
                <?php foreach ($justlist as $key => $post) { ?>
                    <div class="gallery">
                        <a href="post.php?id=<?php echo $post['id']; ?>">
                            <div class="img">
                                <img src="admin/images/<?php echo $post['image_url'] ?>" alt="">
                                <div class="gallery-overlay"></div>
                            </div>
                            <div class="desc">
                                <h4 class="card-title"><?php echo $post['title']; ?></h4>
                            </div>
                        </a>
                        <div class="gallery-detail">
                            <h2><?php echo $post['title']; ?></h2>
                            <div class="line">
                                <span class="middle"><i class="material-icons-outlined tv">tv</i> (<?php echo $post['type'] . '(';
                                                                                                    echo $post['episodes']; ?>eps)</span>
                                <span><?php $producer = explode(',', $post['producer']);
                                        echo $producer[0]; ?></span>
                                <span><?php echo $post['release_date']; ?></span>
                                <span>Rating</span>
                            </div>
                            <div class="abstract">
                                <?php $sypnosis = substr($post['sypnosis'], 0, 450);
                                echo $sypnosis; ?>....
                            </div>
                            <div>
                                <span class="title">Tags: </span>
                                <?php $genres = explode(',', $post['genre']);
                                foreach ($genres as $key => $genre) { ?>
                                    <span class="tags"><?php echo $genre; ?></span>

                                <?php } ?>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <!-- <div id="tv_series" class="section">
        <div class="head-title">
            <h3>TV Series</h3>
        </div>
        <div class="collection">
            <div class="gallery">
                <img src="admin/images/solo-leveling-1-190x273.jpg" alt="">
                <div class="desc">
                    <h4 class="card-title">Solo Leveling</h4>
                    <span>Action</span>
                    <span>Adventure</span>
                </div>
            </div>
            <div class="gallery">
                <img src="admin/images/solo-leveling-1-190x273.jpg" alt="">
                <div class="desc">
                    <h4 class="card-title">Solo Leveling</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/238/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/238/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/276/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/276/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/267/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/267/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/241/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/241/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/242/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/242/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/243/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>tags</span>
                </div>
            </div>
            <div class="gallery">
                <img src="https://picsum.photos/id/243/400/300" alt="">
                <div class="desc">
                    <h4 class="card-title">Title</h4>
                    <span>Action</span>
                    <span>Suspense</span>
                </div>
            </div>


        </div>
    </div> -->
    </div>
</div>


<script>
    //################## for slideshow ......
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
        setTimeout(showSlides, 3000); // Change image every 2 seconds
    }
</script>
<?php include('user/header-footer/footer.php') ?>