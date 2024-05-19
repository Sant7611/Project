<?php
// session_start();
include('admin/class/post.class.php');
include('admin/class/wishlist.class.php');

include('user/header-footer/header.php');
$wishlist = new Wishlist();
$post = new Post();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $post->set('id', $_GET['id']);
}

$selectedPost = $post->getById();
// $datalist = $post->sortCreatedDate(6);
$datalist = $post->recommendation(6);

$check = 0;
if (isset($_SESSION['id'])) {
    $wishlist->post_id = $_GET['id'];
    $wishlist->user_id = $_SESSION['id'];
    $check = $wishlist->checkWishlist();
}
?>
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons"> -->

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
                <div class="post-details">
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

                            <span>Rating:</span><span class="avgRating">No rating for this post</span>
                        </div>
                    </div>
                    <div class="rating">
                        <div class="stars">
                            <!-- <i class="fa fa-star fa-2x" style = "background: #000;"></i> -->
                            <span class="material-icons-outlined star" data-index="0">star</span>
                            <span class="material-icons-outlined star" data-index="1">star</span>
                            <span class="material-icons-outlined star" data-index="2">star</span>
                            <span class="material-icons-outlined star" data-index="3">star</span>
                            <span class="material-icons-outlined star" data-index="4">star</span>
                        </div>
                        <span class="tags userRating">Rate the Content</span>
                    </div>
                </div>
                <div  class="line ">
                    <?php if ($check == 1) { ?>
                        <button id="wishlist"><a href="javascript:void(0)" class="btn"><span id="favorite" class="material-icons-outlined">favorite</span>Wishlist</a></button>
                    <?php } else { ?>
                        <button id="wishlist"><a href="javascript:void(0)" class="btn"><span id="favorite" class="material-icons-outlined">favorite_border</span>Wishlist</a></button>
                    <?php } ?>
                </div>
                <div class="description">
                    <h3>Description</h3>
                    <?php echo substr($selectedPost->sypnosis, 0, 2000); ?>
                    <div class="tags-container">
                        <span class="title">Tags: </span>
                        <?php $genres = explode(',', $selectedPost->genre);
                        for ($i = 0; $i < count($genres); $i++) { ?>
                            <span class="tags"><?php echo $genres[$i]; ?></span>

                        <?php } ?>
                    </div>
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
                <form action="" id="comment-form">
                    <textarea placeholder="Leave a comment....." name="comment" id="comment_Text" cols="30" rows="10"></textarea>
                    <div class="submit-area">
                        <input type="hidden" name="id" id="post_id" value="<?php echo $id; ?>">
                        <input type="hidden" name="parent_id" id="parent_id" value="0">
                        <?php if (isset($_SESSION['id'])) { ?>
                            <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id'];  ?>">
                        <?php } ?>
                        <button type="submit" id="submit_comment_btn" class="submit-comment-btn">Comment</button>
                    </div>
                </form>
            </div>
            <div class="comment">

            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {

        //comment button
        $(document).on('focus', '.write-comment', function() {
            $('.submit-area').css('display', 'flex');
        })

        //comment reply
        $(document).on('click', '.reply', function() {
            var comment_id = $(this).attr("id");
            $('#parent_id').val(comment_id);
            $('#comment_Text').focus();
        });

        var user_ids = $('#user_id').val();
        var cookie = $.cookie('uname');
        console.log(cookie);

        var post_id = $('#post_id').val();
        $('#submit_comment_btn').click(function(e) {
            e.preventDefault();
            // if (!cookie) {
            //     alert('Please log in to comment');
            //     return;
            // }
            var ucomment = $('#comment_Text').val();
            var post_ids = $('#post_id').val();
            var parent_ids = $('#parent_id').val();
            var user_ids = $('#user_id').val();

            // var form_data = $(this).serialize();
            // if (cookie) {
            $.ajax({
                url: "user/comment/submitComment.php",
                method: "POST",
                data: {
                    parent_id: parent_ids,
                    post_id: post_ids,
                    user_id: user_ids,
                    commentText: ucomment
                },
                // data: form_data,
                dataType: "JSON",
                success: function(response) {
                    // if(response.status == 'success')
                    getComment();
                    $('#comment-form')[0].reset();
                    $('#parent_id').val(0);
                },
                // error: function(xhr, status, error) {
                //     alert('Error:', error);
                // }
                error: function(xhr, status, error) {
                    var errorMessage = JSON.parse(xhr.responseText).message;
                    alert('Error: ' + errorMessage);
                }
            });
        });

        //get comment
        function getComment() {
            $.ajax({
                url: "user/comment/getComment.php",
                method: 'GET',
                data: {
                    id: post_id
                },
                dataType: "JSON",
                success: function(response) {
                    if (response.length > 0)
                        displayComment(response);
                    else {
                        $('.comment').append('<p class="default">Be the first to comment</p>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching comments:', error);
                }
            });
        }
        getComment();

        //display comment
        function displayComment(comments) {
            // console.log(comments);
            var commentArea = $('.comment');
            if (comments != null)
                commentArea.empty(); // Clear the comment area before adding new comments

            comments.forEach(comment => {
                var commentHtml = generateComment(comment, blank = 0);
                commentArea.append(commentHtml);

                displayReplies(comment.replies, comment.username);
            });
        }

        // display reply
        function displayReplies(replies, p_username) {
            if (replies && replies.length > 0) {
                replies.forEach(reply => {
                    // console.log(reply);
                    var replyHtml = generateComment(reply, p_username);
                    //this only works for reply to primary comment. not reply to reply
                    $('.comment').append(replyHtml);

                    displayReplies(reply.replies);
                });
            }
        }

        function generateComment(comment, p_username) {
            var parent_username = comment.username;
            var commentHtml = '<div class="user-area ';
            if (comment.parent_id != 0) {
                commentHtml += ' reply-area';
            }
            commentHtml += '">';
            commentHtml += '<div class="user">';
            commentHtml += '<img src="admin/images/65f32703c2ce6onepiece.jpg" alt="">';
            commentHtml += '<div class="user-detail">';
            if (comment.parent_id) {
                commentHtml += '<div class = "user-name"> <span>' + comment.username + ' replied to ' + p_username + '</span>';
            } else {
                commentHtml += '<div class="user-name">' + '<span>' + comment.username + '</span> ';
            }
            commentHtml += ' <span class="cmt-time">' + comment.created + '</span>';
            commentHtml += '</div>'; // user-name
            commentHtml += '<div class="user-comment">';
            commentHtml += '<p>' + comment.comment + '</p>';
            commentHtml += '</div>'; // user-comment
            commentHtml += '</div>'; // user-detail
            commentHtml += '</div>'; // user
            commentHtml += '<div class="cmt-response">';
            commentHtml += '<div>';
            commentHtml += '<span id="like" class="thumb material-icons-outlined">thumb_up</span>';
            commentHtml += '</div>';
            commentHtml += '<div>';
            commentHtml += '<span id="dislike" class="thumb material-icons-outlined">thumb_down</span>';
            commentHtml += '</div>';
            commentHtml += '<div>';
            commentHtml += '<span id = "' + comment.id + '" class = "reply">Reply</span>';
            commentHtml += '</div>';
            commentHtml += '</div>'; // cmt-response
            commentHtml += '</div>'; // user-area
            return commentHtml;
        }

        //Rating functionality
        $('.star').mouseover(function() {
            resetStarColor();
            var starIndex = parseInt($(this).data('index'));
            setStarColor(starIndex);
        });


        $('.star').mouseleave(function() {
            resetStarColor();

            if (ratedIndex != -1) {
                setStarColor(ratedIndex);
            }
        });

        function setStarColor(index){
            for (var i = 0; i <= index; i++)
                    $('.star:eq(' + i + ')').css('color', 'yellow');
            
        }
        
        var ratedIndex = -1;
        $('.star').on('click', function() {
        if(!user_ids){
            alert('Please Login to Rate !!');
            return;
        }
            ratedIndex = parseInt($(this).data('index'));
            rating();
        });

        
        function rating(){
            $.ajax({
                url: 'user/rate.php',
                method:'POST',
                dataType : 'JSON',
                data:{'userid' : user_ids, 'rate' : ratedIndex, 'postid' : post_id},
                success: function(response){
                    console.log(response);
                    avgRating = response.rating;
                    rateIndex = response.curRating;
                    if(rateIndex != -1){
                        $('.userRating').html('Your Rating');
                    }
                    
                    setStarColor(rateIndex);
                    if(avgRating != 0)
                    $('.avgRating').html(avgRating);
                },
                error: function(xhr, status, error){
                    console.log('error: ', error);
                }
            });
        }
        
        rating();

        function resetStarColor() {
                $('.star').css('color', 'white');
        }

        //Wishlist functionality
        $('#wishlist').click(function(e) {
            e.preventDefault();
            console.log('user Id: ',user_ids);
            if (!user_ids) {
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
                // console.log(status, user_ids, post_id);
                $.ajax({
                    url: 'user/checkWishlist.php',
                    method: 'POST',
                    data: {
                        status: status,
                        post_id: post_id,
                        user_id: user_ids
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
    });
</script>

<?php
include('user/header-footer/footer.php');
?>