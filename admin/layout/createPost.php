<?php
@session_start();
include('header_footer/header.php');
include('../class/post.class.php');
include('../class/studio.class.php');
include('../class/genre.class.php');
include('../class/source.class.php');
include('../class/producer.class.php');
// include('sideBar.php');

$post = new Post();
$genre = new Genre();
$studio = new Studio();
$producer = new Producer();
$source = new Source();

$sourceList = $source->fetch();
$producerList = $producer->fetch();
$studioList = $studio->fetch();
$genreList = $genre->fetch();


if (isset($_POST['submit'])) {

    // echo "<pre><div style = 'position: absolute; left: 0; z-index: 1;'";
    // print_r($_FILES);
    // echo "</div></pre>";
    if (!empty($_POST['title']) && !empty($_POST['type']) && !empty($_POST['episodes']) && !empty($_POST['release_date']) && !empty($_POST['producers_id']) && !empty($_POST['duration']) && !empty($_POST['source_id']) && !empty($_POST['genre_id']) && !empty($_POST['studio_id']) && !empty($_POST['aired']) && !empty($_POST['sypnosis'])) {
        $post->set('title', $_POST['title']);
        $post->set('type', $_POST['type']);
        $post->set('episodes', $_POST['episodes']);
        $post->set('status', $_POST['status']);
        $post->set('slider_key', $_POST['slider_key']);
        $post->set('release_date', $_POST['release_date']);
        $post->set('featured', $_POST['featured']);
        $post->set('producers', $_POST['producers_id']);
        $post->set('aired', $_POST['aired']);
        $post->set('duration', $_POST['duration']);
        $post->set('source', $_POST['source_id']);
        $post->set('sypnosis', $_POST['sypnosis']);
        $post->set('genre_id', $_POST['genre_id']);
        $post->set('studio_id', $_POST['studio_id']);
        $post->set('created_date', date('y-m-d H:i:s'));
        if ($_FILES['image']['error'] == 0) {
            if (
                $_FILES['image']['type'] == "image/png" ||
                $_FILES['image']['type'] == "image/jpg" ||
                $_FILES['image']['type'] == "image/jpeg"
            ) {
                if ($_FILES['image']['size'] <= 1024 * 1024 * 5) {
                    $imageName = uniqid() . $_FILES['image']['name'];
                    move_uploaded_file(
                        $_FILES['image']['tmp_name'],
                        '../images/' . $imageName
                    );
                    $post->set('image_url', $imageName);
                } else {
                    $imageError = "Error, Exceeded 5mb!";
                }
            } else {
                $imageError = "Invalid Image!";
            }
        }

        if ($_FILES['slider_img']['error'] == 0) {
            if (
                $_FILES['slider_img']['type'] == "image/png" ||
                $_FILES['slider_img']['type'] == "image/jpg" ||
                $_FILES['slider_img']['type'] == "image/jpeg"
            ) {
                if ($_FILES['slider_img']['size'] <= 1024 * 1024 * 5) {
                    $sliderimageName = uniqid() . $_FILES['slider_img']['name'];
                    move_uploaded_file(
                        $_FILES['slider_img']['tmp_name'],
                        '../images/sliderImage/' . $sliderimageName
                    );
                    $post->set('slider_img', $sliderimageName);
                } else {
                    $s_imageError = "Error, Exceeded 5mb!";
                }
            } else {
                $s_imageError = "Invalid Image!";
            }
        }
        try {
            $result = $post->save();
            echo $result;
            echo 'successfully echoed';
        } catch (mysqli_sql_exception $e) {

            if ($result == 'success') {
                $msg = "Post inserted Successfully with id " . $result;
            } else {
                $ErrMsg = "Post cannot be inserted!!!" . substr($e, 21, 16);
            }
        }
    } else {
        $ErrMsg = "Please enter all the fields!!";
    }
}
?>


<div id="page-wrapper">

    <div class="col-lg-12">
        <?php if (isset($imageError)) { ?>
            <div class="alert alert-danger"><?php echo $imageError;  ?></div>
        <?php  } ?>
        <?php if (isset($s_imageError)) { ?>
            <div class="alert alert-danger"><?php echo $s_imageError;  ?></div>
        <?php  } ?>

        <?php if (isset($msg)) { ?>
            <div class="row alert alert-success"><?php echo $msg;  ?></div>
        <?php  } ?>
        <?php if (isset($ErrMsg)) { ?>
            <div class="row alert alert-danger"><?php echo "<span>" . $ErrMsg . "</span>";  ?></div>
        <?php  } ?>
        <h1 class="page-header">Create Post</h1>
    </div>

    <div class="row">
        <div class="col-lg-6">

            <form role="form" id="submitForm" method="post" enctype="multipart/form-data" noValidate>
                <div class="form-group">
                    <label class="label" for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" required>
                </div>
                <div class="form-group">
                    <label for="studio_id" class="label">Post Studio</label>
                    <div class="insert-data">
                        <?php foreach ($studioList as $studios) { ?>
                            <div>
                                <label>
                                    <input type="checkbox" name="studio_id[]" value="<?php echo $studios['id']; ?>" required>
                                    <?php echo $studios['studio']; ?>
                                    </input>
                                </label>
                            </div>
                        <?php  } ?>
                    </div>

                </div>
                <div class="form-group">
                    <label class="label" for="source_id">Post Source </label>
                    <div class="insert-data">
                        <?php foreach ($sourceList as $source) {

                        ?>
                            <div>
                                <label>
                                    <input name="source_id[]" type="checkbox" value="<?php echo $source['id']; ?>" required>
                                    <?php echo $source['source']; ?>
                                    </input>
                                </label>
                            </div>
                        <?php  } ?>
                    </div>

                </div>
                <div class="form-group">
                    <label class="label" for="producer_id">Post Producer</label>
                    <div class="insert-data">

                        <?php foreach ($producerList as $prod) { ?>
                            <div>
                                <label>
                                    <input type="checkbox" class="mark" name="producers_id[]" value="<?php echo $prod['id']; ?>" required>
                                    <?php echo $prod['producers']  ?>
                                    </input>
                                </label>
                            </div>
                        <?php   } ?>
                    </div>

                </div>
                <div class="form-group">
                    <label class="label" for="genre_id">Post Genre</label>
                    <div class="insert-data">
                        <?php foreach ($genreList as  $genre) { ?>
                            <div>
                                <label>
                                    <input type="checkbox" name="genre_id[]" value="<?php echo $genre['id']; ?> " required>
                                    <?php echo $genre['genre']; ?>
                                    </input>
                                </label>
                            </div>
                        <?php
                        } ?>
                    </div>

                </div>
                <div class="form-group">
                    <label for="type" class="label">Type</label>
                    <input class="form-control" id="type" type="text" name="type" required></input>
                </div>
        </div>
        <div class="form-group">
            <label for="duration" class="label">Duration </label>
            <input class="form-control" id="duration" type="text" name="duration" required></input>
        </div>
        <div class="form-group">
            <label for="sypnosis" class="label">Sypnosis</label>
            <textarea class="form-control ckeditor" id="sypnosis" rows="3" required name="sypnosis"></textarea>
        </div>
        <div class="form-group">
            <label for="release_dates" class="label"> Release date:</label>
            <input type="date" id="release_dates" name="release_date" value="" required>

        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="aired" class="label"> Aired: </label>
            <input type="date" id="aired" name="aired" value="" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="episode" class="label">Episodes: </label>
            <input type="number" id="episode" class="form-control" name="episodes" required>
        </div>
    </div>
    <div class="row">
        <div class="form-group" enctype="multipart/form-data">
            <label class="label" for="image">Image</label>
            <!-- using multiple helps to upload multiple images -->
            <input type="file" name="image" id="image" required>
            <?php if (isset($imageError)) { ?>
                <div class="alert alert-danger"><?php echo $imageError; ?></div>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group" enctype="multipart/form-data">
            <label class="label" for="slider_image">Slider Image</label>
            <!-- using multiple helps to upload multiple images -->
            <input type="file" name="slider_img" id="slider_image" required>
            <?php if (isset($s_imageError)) { ?>
                <div class="alert alert-danger"><?php echo $s_imageError; ?></div>
            <?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="form-group">
            <label for="statusOption1" class="label">Status</label>
            <div class="radio">
                <label>
                    <input type="radio" name="status" id="statusOption1" value="1" checked>Active
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="status" id="statusOption1" value="0">Inactive
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="featuredOption1" class="label">Featured</label>
            <div class="radio">
                <label>
                    <input type="radio" name="featured" id="featuredOption1" value="1" checked>Active
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="featured" id="featuredOption2" value="0">Inactive
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="sliderOption1" class="label">Slider Key</label>
            <div class="radio">
                <label>
                    <input type="radio" name="slider_key" id="sliderOption1" value="1" checked>Active
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="slider_key" id="sliderOption2" value="0">Inactive
                </label>
            </div>
        </div>
    </div>
    <div class="row">
        <button type="submit" name="submit" value='submit' class="btn btn-success">Create</button>
        <button type="reset" class="btn btn-danger">Reset</button>
    </div>
    </form>
</div>
<?php

// echo "<pre><div style = 'position:absoulte; right : 0;'>";
// print_r($_POST);
// echo "<div><pre>";
include('header_footer/footer.php');
?>
<script src="../js/ckeditor/ckeditor.js"></script>

<!-- <script>
    $(document).ready(function() {
        $('#name').keyup(function() {
            const value = $("#name").val();
            $.ajax({
                url: "checkCategoryName.php",
                method: "post",
                dataType: "text",
                data: {
                    'categoryName': value
                },
                success: function(res) {
                    if (res != "success") {
                        $("#categoryError").text(res);
                        $("#CategoryEntry").val("");
                    } else {
                        $("#categoryError").text("");
                        $("#CategoryEntry").val("success");

                    }
                }
            })
        })
    })
</script> -->