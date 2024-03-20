<?php
$id = $_GET['id'];

include('header_footer/header.php');
include('../class/post.class.php');
include('../class/studio.class.php');
include('../class/producer.class.php');
include('../class/source.class.php');
include('../class/genre.class.php');
$post = new Post();

$post->set('id', $id);
$data = $post->getById();
// echo "<pre>";
// // print_r($data);
// print_r($_POST);
// print_r($_POST['image']);
// print_r($_POST['slider_img']);
// print_r($_FILES);
// echo "</pre>";

$studioid = explode(',', $data->studio_id);
$genreid = explode(',', $data->genre_id);
$producerid = explode(',', $data->producer_id);
$sourceid = explode(',', $data->source_id);
// print_r($producerid);
// echo "<br>" . $data->studio_id;
$genre = new Genre();
$studio = new Studio();
$source = new Source();
$producer = new Producer();

$studioList = $studio->fetch();
$genreList = $genre->fetch();
$producerList = $producer->fetch();
$sourceList = $source->fetch();

// echo "<pre>";
// echo 'producer';
// print_r($_POST['producer_id']);
// echo 'source';
// print_r($_POST['source_id']);
// echo 'genre';
// print_r($_POST['genre_id']);
// echo 'studio';
// print_r($_POST['studio_id']);
// echo "</pre>";


@session_start();
if (isset($_POST['submit'])) {
    $post->set('title', $_POST['title']);
    $post->set('type', $_POST['type']);
    $post->set('episodes', $_POST['episodes']);
    $post->set('sypnosis', $_POST['sypnosis']);
    $post->set('genre_id', $_POST['genre_id']);
    $post->set('slider_key', $_POST['slider_key']);
    $post->set('featured', $_POST['featured']);
    $post->set('studio_id', $_POST['studio_id']);
    $post->set('genre_id', $_POST['genre_id']);
    $post->set('duration', $_POST['duration']);
    $post->set('producers', $_POST['producer_id']);
    $post->set('source', $_POST['source_id']);
    $post->set('release_date', $_POST['release_date']);
    $post->set('status', $_POST['status']);
    $post->set('aired', $_POST['aired']);
    $post->set('modified_date', date('y-m-d H:i:s'));
    if (empty($_FILES['image']['name'])) {
        $post->set('image_url', $_POST['old_image']);
    }
    if ($_FILES['image']['error'] == 0) {
        if (
            $_FILES['image']['type'] == "image/png" ||
            $_FILES['image']['type'] == "image/jpg" ||
            $_FILES['image']['type'] == "image/jpeg"
        ) {
            if ($_FILES['image']['size'] <= 1024 * 1024) {
                $imageName = uniqid() . $_FILES['image']['name'];
                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    '../images/' . $imageName
                );
                $post->set('image_url', $imageName);
            } else {
                $imageError = "Error, Exceeded 1mb!";
            }
        } else {
            $imageError = "Invalid Image!";
        }
    }

    if (empty($_FILES['slider_img']['name'])) {
        $post->set('slider_img', $_POST['old_slider_image']);
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
                $imageError = "Error, Exceeded 1mb!";
            }
        } else {
            $imageError = "Invalid image format!";
        }
    }

    // echo "<pre>";
    // print_r($_FILES['image']);
    // echo "</pre>";
        $result = $post->edit();
        // echo $result;
        // echo "success";
        // header('location:listPost.php?msg=Post successfully Updated');
        
            if ($result == 'success') {
                // $ErrMs = "";
                
                // $_SESSION['msg'] = 'Post successfully updated  '; 
                echo "<script>window.location.href='listPost.php?msg=Post successfully updated'</script>";
                // $msg = "Post successfully updated  ";
            } else {
                $Errmsg = "Post cannot be updated";
            }
         

}
// include('sideBar.php');
?>


<div id="page-wrapper">

    <div class="col-lg-12">
        <h1 class="page-header">Edit Post</h1>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?php if (isset($imageError)) { ?>
                <div class="alert alert-danger"><?php echo $imageError;  ?></div>
            <?php  } ?>
            <?php if (isset($ErrMsg)) { ?>
                <div class="alert alert-danger"><?php echo $ErrMsg;  ?></div>
            <?php  } ?>
            <form role="form" id="submitForm" method="post" enctype="multipart/form-data" noValidate>
                <div class="form-group">
                    <label class="label" for="title">Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $data->title; ?>" id="title" required>
                </div>
                <div class="form-group">
                    <label class="label" for="postid">Post Studio</label>
                    <div class="insert-data">
                        <?php foreach ($studioList as $studios) {

                        ?>
                            <div>
                                <label>
                                    <input id="postid" type="checkbox" name="studio_id[]" value="<?php echo $studios['id']; ?>" class="mark" <?php if (in_array($studios['id'], $studioid)) {
                                                                                                                                                    echo 'checked ';
                                                                                                                                                } ?>>
                                    <?php echo $studios['studio']; ?>
                                    </input>
                                </label>
                            </div>
                        <?php  } ?>
                    </div>

                </div>
                <div class="form-group">
                    <label class="label" for="sourceid">Post Source </label>
                    <div class="insert-data">
                        <?php foreach ($sourceList as $source) {    ?>
                            <div>
                                <label>
                                    <input name="source_id[]" id="sourceid" type="checkbox" value="<?php echo $source['id']; ?>" class="mark" <?php if (in_array($source['id'], $sourceid)) {
                                                                                                                                                    echo 'checked ';
                                                                                                                                                } ?>>
                                    <?php echo $source['source']; ?>
                                    </input>
                                </label>
                            </div>
                        <?php  } ?>
                    </div>

                </div>
                <div class="form-group">
                    <label class="label" for="producerid">Post Producer</label>
                    <div class="insert-data">
                        <?php foreach ($producerList as $prod) { ?>
                            <label>
                                <div>
                                    <input type="checkbox" id="producerid" class="mark" name="producer_id[]" value="<?php echo $prod['id']; ?>" class="mark" <?php if (in_array($prod['id'], $producerid)) {
                                                                                                                                                                    echo 'checked';
                                                                                                                                                                } ?>>
                                    <?php echo $prod['producers']  ?>
                                    </input>
                                </div>
                            </label>
                        <?php   } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="genreid">Post Genre</label>
                    <div class="insert-data">

                        <?php foreach ($genreList as  $genre) { ?>
                            <label>
                                <div>
                                    <input type="checkbox" id="genreid" name="genre_id[]" value="<?php echo $genre['id']; ?> " class="mark" <?php if (in_array($genre['id'], $genreid)) {
                                                                                                                                                echo 'checked';
                                                                                                                                            } ?>>
                                    <?php echo $genre['genre']; ?>
                                    </input>
                                </div>
                            </label>
                        <?php
                        } ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="type">Type</label>
                    <input type="text" name="type" id="type" value="<?php echo $data->type ?>">
                </div>
                <div class="form-group">
                    <label class="label" for="duration">Duration</label>
                    <input type="text" name="duration" id="duration" value="<?php echo $data->duration ?>">
                </div>
                <div class="form-group">
                    <label class="label" for="sypnosis">Sypnosis</label>
                    <textarea class="form-control ckeditor" id="sypnosis" rows="3" name="sypnosis"> <?php echo $data->sypnosis; ?></textarea>
                </div>
                <div class="form-group">
                    <label class="label" for="release_date"> Release Date:</label>
                    <input type="date" name="release_date" id="release_date" value="<?php echo $data->release_date; ?>">
                </div>
                <div class="form-group">
                    <label class="label" for="aired"> Aired :</label>
                    <input type="date" name="aired" id="aired" value="<?php echo $data->aired; ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label class="label" for="episodes">Episodes:</label>
                    <input type="text" id="episodes" name="episodes" value="<?php echo $data->episodes; ?>">
                </div>
                <div class="form-group" enctype="multipart/form-data">
                    <label class="label" for="image">Image<br><br></label>
                    <input type="hidden" id="image" value="<?php echo $data->image_url;  ?>" name="old_image">
                    <img src="../images/<?php echo $data->image_url;  ?>" height="100" width="200" alt="" srcset=""><br>
                    <br>
                    <input type="file" name="image">
                    <br><br>
                    <label class="label" for="slider_image">Slider Image<br><br></label>
                    <input type="hidden" id="slider_image" value="<?php echo $data->slider_img;  ?>" name="old_slider_image">
                    <img src="../images/sliderImage/<?php echo $data->slider_img;  ?>" height="100" width="200" alt="" srcset=""><br>
                    <br>
                    <input type="file" name="slider_img">
                </div>


                <div class="form-group">
                    <label class="label" for="optionRadios1">Status</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="optionsRadios1" value="1" <?php if ($data->status == 1) {
                                                                                                echo 'checked';
                                                                                            } ?>>Active
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="status" id="optionsRadios2" value="0" <?php if ($data->status != 1) {
                                                                                                echo 'checked';
                                                                                            } ?>>Inactive
                        </label>
                    </div>

                </div>
                <div class="form-group">
                    <label class="label" for="featuredOption1">Featured</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="featured" id="featuredOption1" value="1" <?php if ($data->featured == 1) {
                                                                                                    echo 'checked';
                                                                                                } ?>>Active
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="featured" id="featuredOption2" value="0" <?php if ($data->featured != 1) {
                                                                                                    echo 'checked';
                                                                                                } ?>>Inactive
                        </label>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="sliderOption1">Slider Key</label>
                    <div class="radio">
                        <label>
                            <input type="radio" name="slider_key" id="sliderOption1" value="1" <?php if ($data->slider_key == 1) {
                                                                                                    echo 'checked';
                                                                                                } ?>>Active
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="slider_key" id="sliderOption2" value="0" <?php if ($data->slider_key != 1) {
                                                                                                    echo 'checked';
                                                                                                } ?>>Inactive
                        </label>
                    </div>
                </div>

                <button type="submit" name="submit" value='submit' class="btn btn-success">Update</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
</div>
<?php
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