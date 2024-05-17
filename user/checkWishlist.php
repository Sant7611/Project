<?php
include('../admin/class/wishlist.class.php');
include('../admin/class/post.class.php');

$wishlist = new Wishlist();
$post = new Post();

$datalist = $post->fetch();


if (isset($_POST['user_id'])) {
    // echo gettype($_POST['user_id']);
    if (gettype($_POST['user_id']) === 'string') {
        // $wishlist->user_id = filter_input(INPUT_POST, "user_id", FILTER_SANITIZE_NUMBER_INT);
        $wishlist->user_id = $_POST['user_id'];
        // $wishlist->post_id = $_POST['post_id'];
        if (isset($_POST['status'])) {
            $wishlist->post_id = filter_input(INPUT_POST, "post_id", FILTER_SANITIZE_NUMBER_INT);
            $status = $_POST['status'];
            switch ($status) {
                case 'insert':
                    $result = $wishlist->save();
                    if ($result == 1) {
                        $response = ['status' => 'success', 'message' => 'Added to wishlist'];
                    } else {
                        $response = ['status' => 'failed', 'message' => 'Please try again!!'];
                    }
                    break;
                case 'delete':
                    $result = $wishlist->delete();
                    if ($result == 1) {
                        $response = ['status' => 'success', 'message' => 'Removed from wishlist'];
                    } else {
                        $response = ['status' => 'failed', 'message' => 'Please try again!!'];
                    }
                    break;
            }
            echo json_encode($response);
            return;
            // exit;
            // return 'success';
        }

        $res = $wishlist->fetchById();
        if (is_array($res)) {
            $result = 1;
        }
        $post_id = $wishlist->getPostId();
        // echo 'hello';
    }
} else {
    header('HTTP/1.0 400 Bad Request');
    echo json_encode(["status" => "error", "message" => "Log in to use wishlist"]);
    exit;
}

?>
<div id="wishlist" class="section">
    <div class="head-title">
        <h3>My Wishlist</h3>
    </div>
    <?php if (isset($result)) { ?>
        <div class="wishlist-collection">
            <?php foreach ($res as $key => $post) { ?>
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
                            <span class="middle"><i class="material-icons-outlined tv">tv</i> <?php echo $post['type'] . ' (';
                                                                                                echo $post['episodes'] . ' eps)'; ?></span>
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
    <?php } else { ?>
        <div class="collection">
            <h2 style="color: #c5afaf;">No items in your Wishlist🙄🙄</h2>
        </div>
    <?php } ?>
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