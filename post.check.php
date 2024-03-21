<?php
include_once('admin/class/post.class.php');

include('user/header-footer/header.php');


$post = new Post();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post->set('id', $_GET['id']);
}

$selectedPost = $post->getById();
// $datalist = $post->sortCreatedDate(6);
$datalist = $post->recommendation(6);


// echo "<pre>";
// print_r($selectedPost);
// echo "</pre>";



// $studioList = explode(',', $selectedPost->studio);

?>
<style>
    .post-head {
        /* display: flex; */
        /* justify-content: space-between; */
        width: 100%;
        padding: 25px 0 25px 0px;
    }

    .post-head span {
        /* border-right: 1px solid #eee; */
        padding: 0px 40px 5px 0;
        font-size: 14px;
        font-weight: 500;
        display: inline-block;
        font-family: "Nunito";
    }

    .post-syp {
        width: 95%;
        padding-left: 390px;
        text-align: left;
        /* margin-top: 5px; */
        font-family: "Mukta";
        font-weight: 300;
        margin-top: 10px;
    }

    .post-syp h3 {
        padding-top: 5px;
        border-top: 1px solid #eee;
    }

    .tags-container {
        margin-top: 4px;
        padding-bottom: 15px;
    }

    .alt-title {
        /* display: inline; */
        color: #b9b9b9;
        font-size: 14px;
        display: inline-block;
        width: 800px;
        line-height: 20px;
    }

    .background-img .img-title {
        position: absolute;
        top: 27px;
        left: 290px;
        /* line-height: 55px; */
        color: #fff;
        font-family: "Mukta";
        font-size: 20px;
    }

    .line button {
        border: none;
        border-radius: 5px;
        overflow: hidden;
    }

    button a {
        display: inline-block;
        padding: 7px 77px;
        color: #eee;
        background: #5b5172;
        font-weight: 400;
        font-family: 'Nunito';
        text-decoration: none;
        font-size: 18px;
        /* border-color: blue; */
        display: flex
    }


    /* comment Section  */

    .comment-section {
        /* height: 400px; */
        color: #b9b9b9;
        font-family: 'Nunito';
        font-weight: 400;
    }

    .comments-gallery {
        overflow: scroll;
        scrollbar-width: none;
        /* margin-bottom: 41px; */
        color: #b3b3b3;
        padding: 0 30px;
    }

    .comments {
        position: relative;
        /* background: #eee; */
        margin-bottom: 70px;
    }

    .write-comment {
        /* position: fixed; */
        background: #0e121f;
        padding: 8px;
        /* border: 1px solid black; */
        width: 100%;
    }

    textarea {
        resize: vertical;
        background: #141723;
        width: 100%;
        height: 50px;
        outline: 1px solid #9b9b9b;
        color: #acaeaf;
        padding: 15px 12px;
        /* border-inline: none; */
        scrollbar-width: none;
        border-radius: 6px;
    }

    textarea:focus-visible {
        outline: 1px solid #eee;
    }

    .user {
        /* background: #ccc; */
        /* border: 1px solid pink; */
        display: flex;
        justify-content: flex-start;
        align-items: center;
        padding: 10px 5px;
    }

    .user img {
        height: 35px;
        width: 35px;
        border-radius: 70%;
    }

    .user-area {
        padding: 10px 0;
        border-top: 1px solid #232323;
    }

    .user-detail {
        padding: 0px 16px;
    }

    .user-name {
        font-size: 15px;
        font-weight: 600;
        font-family: 'Nunito';
    }

    .cmt-time {
        font-size: 12px;
        color: #898585;
    }

    .cmt-response {
        padding-left: 58px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
    }

    .cmt-response span {
        flex-basis: 5%;
        cursor: pointer;
    }

    .thumb:hover {
        color: #fff;
    }
</style>

<div class="overview">
    <div class="background-img overlay">
        <img src="admin/images/sliderImage/<?php echo $selectedPost->slider_img; ?>" width="100%" alt="" srcset="">
        <div class="img-title">
            <h1><?php echo $selectedPost->title; ?></h1>
            <div class="alt-title">
                <i>Alt title: </i>
                <span><?php echo $selectedPost->alt_title ?></span>
            </div>
        </div>
    </div>
    <div class="box-main">
        <div class="post-img">
            <img src="admin/images/<?php echo $selectedPost->image_url; ?>" width="100px" alt="" srcset="">
        </div>
        <div class="post-desc">
            <div class="post-syp">
                <div class="post-head">

                    <div>
                        <span>Episodes: </span> <span><?php echo $selectedPost->episodes; ?></span>
                    </div>
                    <div>
                        <span>Type: </span> <span class="center"><?php if ($selectedPost->type == 'TV Series') {
                                                                        // echo '<i class=" material-icons-outlined ">tv</i> ';
                                                                    }
                                                                    echo $selectedPost->type; ?></span>
                    </div>
                    <div>
                        <span>Duration :</span>
                        <span><?php echo $selectedPost->duration; ?></span>
                    </div>
                    <div>
                        <span>Released:</span>
                        <span class="center"><?php echo substr($selectedPost->aired, 0, 4) ?></span>
                    </div>
                    <div>

                        <span>Rating:</span><span><?php echo 'Rating'; ?></span>
                    </div>
                </div>
                <div class="line">
                    <button><a href="" class="btn"><span class="material-icons-outlined">assignment</span>Wishlist</a></button>
                    <button></button>
                </div>
                <div class="description">
                    <h3>Description</h3>
                    <?php echo substr($selectedPost->sypnosis, 0, 2000); ?>
                </div>
                <div class="tags-container">
                    <span class="title">Tags: </span>
                    <?php $genres = explode(',', $selectedPost->genre);
                    for ($i = 0; $i < count($genres); $i++) { ?>
                        <span class="tags"><?php echo $genres[$i]; ?></span>

                    <?php } ?>
                </div>

                <div class="post-head">
                    <h3>More Details</h3>
                    <div>
                        <span>Origination: </span><span><?php echo $selectedPost->source ?></span>
                    </div>
                    <div>
                        <span>Studio :</span><span><?php echo $selectedPost->studio; ?></span>
                    </div>
                    <div>
                        <span>Producer :</span>
                        <span><?php echo $selectedPost->producer; ?></span>
                    </div>
                    <div>
                        <span>Aired :</span>
                        <span><?php echo substr($selectedPost->aired, 0, 4); ?></span>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
<div id="recommend " class="section">
    <div class="head-title">
        <h3>You might also like</h3>
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
<div class="comment-section">
    <div class="comments-gallery">
        <div class="comments">
            <div class="write-comment">
                <textarea placeholder="Leave a comment....." name="comment" id="write-comment" cols="30" rows="10"></textarea>
            </div>
            <div class="comment">
                <div class="user-area">
                    <div class="user">
                        <img src="admin/images/65f32703c2ce6onepiece.jpg" alt="">
                        <div class="user-detail">
                            <div class="user-name">
                                <span>Santosh Bohara</span>
                                <span class="cmt-time">6 hrs ago</span>
                            </div>
                            <div class="user-comment">
                                <p>This is great !!!!!!</p>
                            </div>
                        </div>
                    </div>
                    <div class="cmt-response">
                        <span class="material-icons-outlined">thumb_up</span>
                        <span class="material-icons-outlined">thumb_down</span>
                        <span>Reply</span>
                    </div>
                </div>
                <div class="user-area">
                    <div class="user">
                        <img src="admin/images/65f32703c2ce6onepiece.jpg" alt="">
                        <div class="user-detail">
                            <div class="user-name">
                                <span>Santosh Bohara</span>
                                <span class="cmt-time">6 hrs ago</span>
                            </div>
                            <div class="user-comment">
                                <p>This is great !!!!!!</p>
                            </div>
                        </div>
                    </div>
                    <div class="cmt-response">
                        <span class="thumb material-icons-outlined">thumb_up</span>
                        <span class="thumb material-icons-outlined">thumb_down</span>
                        <span>Reply</span>
                    </div>
                </div>
                <div class="user-area">
                    <div class="user">
                        <img src="admin/images/65f32703c2ce6onepiece.jpg" alt="">
                        <div class="user-detail">
                            <div class="user-name">
                                <span>Santosh Bohara</span>
                                <span class="cmt-time">6 hrs ago</span>
                            </div>
                            <div class="user-comment">
                                <p>This is great !!!!!!</p>
                            </div>
                        </div>
                    </div>
                    <div class="cmt-response">
                        <span class="material-icons-outlined">thumb_up</span>
                        <span class="material-icons-outlined">thumb_down</span>
                        <span>Reply</span>
                    </div>
                </div>
                <div class="user-area">
                    <div class="user">
                        <img src="admin/images/65f32703c2ce6onepiece.jpg" alt="">
                        <div class="user-detail">
                            <div class="user-name">
                                <span>Santosh Bohara</span>
                                <span class="cmt-time">6 hrs ago</span>
                            </div>
                            <div class="user-comment">
                                <p>This is great !!!!!!</p>
                            </div>
                        </div>
                    </div>
                    <div class="cmt-response">
                        <span class="material-icons-outlined">thumb_up</span>
                        <span class="material-icons-outlined">thumb_down</span>
                        <span>Reply</span>
                    </div>
                </div>
                <div class="user-area">
                    <div class="user">
                        <img src="admin/images/65f32703c2ce6onepiece.jpg" alt="">
                        <div class="user-detail">
                            <div class="user-name">
                                <span>Santosh Bohara</span>
                                <span class="cmt-time">6 hrs ago</span>
                            </div>
                            <div class="user-comment">
                                <p>This is great !!!!!!</p>
                            </div>
                        </div>
                    </div>
                    <div class="cmt-response">
                        <span class="material-icons-outlined">thumb_up</span>
                        <span class="material-icons-outlined">thumb_down</span>
                        <span>Reply</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include('user/header-footer/footer.php');
?>