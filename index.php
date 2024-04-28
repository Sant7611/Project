<?php
include('user/header-footer/header.php');
include_once('admin/class/post.class.php');
include('admin/class/wishlist.class.php');
$post = new Post();
$wishlist = new Wishlist();

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
            <div class="slideshow-container">
                <?php foreach ($sliderlist as $key => $post) { ?>
                    <?php $wishlist->post_id = $post['id']; ?>

                    <div class="mySlides fade">
                        <div class="numbertext"><?php echo $key + 1 ?> / 3</div>
                        <!-- <img src="admin/images/animeimg1.jpg" style="width:100%"> -->
                        <img src="<?php echo 'admin/images/sliderImage/' . $post['slider_img']; ?>" style="width:100%">
                        <div class=" overlay text">
                            <div class="disp">
                                <div class="slide-title"><?php echo $post['title']; ?></div>
                                <span class="epidsode">Ep <?php echo $post['episodes']; ?> </span>
                                <span class="center"><i class="material-icons-outlined">cast</i>
                                    <?php $airedYear = substr($post['aired'], 0, 4);
                                    echo $airedYear;; ?>
                                </span>
                                <input type="hidden" name="post_id" id="post_id" value="<?php echo $post['id']; ?>">
                                <input type="hidden" name="user_id" id="user_id" value="<?php if (isset($_SESSION['id'])) {
                                                                                            echo $_SESSION['id'];
                                                                                        } ?>">
                                <div class="sypnosis">
                                    <?php $sypnosis = substr($post['sypnosis'], 0, 250);
                                    echo $sypnosis; ?>....read more
                                </div>
                                <div class="add-btn read">
                                    <a href="post.php?id=<?php echo $post['id']; ?>">
                                    Read More <i class="material-icons-outlined">keyboard_double_arrow_right</i></a>
                                </div>
                                <div id="wishlist" class="add-btn">
                                    <?php
                                    $check = 0;
                                    if (isset($_SESSION['id'])) {
                                        $wishlist->user_id = $_SESSION['id'];
                                        $wishlist->post_id = $post['id'];
                                        $check = $wishlist->checkWishlist();
                                        if ($check == 1) { ?>
                                            <a href="javascript:void(0)" class="btn">Wishlist <i id="favorite" class="material-icons-outlined">favorite</i></a>
                                        <?php } else { ?>
                                            <a href="javascript:void(0)" class="btn">Wishlist <i id="favorite" class="material-icons-outlined">favorite_border</i></a>
                                        <?php }
                                    } else { ?>
                                        <a href="javascript:alert('Please Login to add to wishlist');" class="btn">Wishlist <i id="favorite" class="material-icons-outlined">favorite_border</i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
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


    // ################### for Wishlist
    //Wishlist functionality
    var post_id = $('#post_id').val();
    var user_id = $('#user_id').val();
    console.log(user_id, post_id);
    $('#wishlist').click(function(e) {
        e.preventDefault();
        if (user_id == "") {
            alert('Please log in to add to wishlist');
            return;
        } else {
            if ($('#favorite').text() === 'favorite') {
                var status = 'delete';
                $('#favorite').html('favorite_border');
            } else {
                var status = 'insert';
                // console.log(status);
                $('#favorite').html('favorite');
            }
            $.ajax({
                url: 'user/checkWishlist.php',
                method: 'POST',
                data: {
                    status: status,
                    post_id: post_id,
                    user_id: user_id
                },
                // dataType: 'JSON',
                success: function(response) {
                    // console.log(response.result);
                    var result = JSON.parse(response);
                    console.log(result.message)
                    alert(result.message);
                },
                error: function(xhr, status, error) {
                    console.log('error: ', error);
                    // console.log(xhr.responseText)
                }
            })
        }
    });
</script>
<?php include('user/header-footer/footer.php') ?>