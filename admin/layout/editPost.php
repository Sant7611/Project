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
echo "<pre>";
print_r($data);
echo "</pre>";

$studioid = explode(',', $data->studio_id);
echo gettype($studioid);
echo gettype($data->studio_id);
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
    $post->set('producers', $_POST['producer_id']);
    $post->set('source', $_POST['source_id']);
    $post->set('release_date', $_POST['release_date']);
    $post->set('status', $_POST['status']);
    $post->set('aired', $_POST['aired']);
    $post->set('created_date', date('y-m-d H:i:s'));
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

    // echo "<pre>";
    // print_r($_FILES['image']);
    // echo "</pre>";
    $result = $post->edit();
    // echo $result;
    if ($result == 'success') {
        $ErrMs = "";
        $msg = "Post successfully updated  ";
    } else {
        $msg = "Post cannot be updated";
    }
}
// include('sideBar.php');
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Post</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <?php if (isset($msg)) { ?>
                <div class="alert alert-success"><?php echo $msg;  ?></div>
            <?php  } ?>
            <?php if (isset($ErrMsg)) { ?>
                <div class="alert alert-danger"><?php echo $ErrMsg;  ?></div>
            <?php  } ?>
            <form role="form" id="submitForm" method="post" enctype="multipart/form-data" noValidate>
                <div class="form-group">
                    <label>Title
                        <input type="text" class="form-control" name="title" value="<?php echo $data->title; ?>" id="title" required>
                    </label>
                </div>
                <div class="form-group">
                    <label>Post Studio
                        <?php foreach ($studioList as $studios) {

                        ?>
                            <label>
                                <input type="checkbox" name="studio_id[]" value="<?php echo $studios['id']; ?>" class="mark" <?php if (in_array($studios['id'], $studioid)) {

                                                                                                                    echo 'checked ';
                                                                                                                } ?>>
                                <?php echo $studios['studio']; ?>
                                </input>
                            </label>
                        <?php  } ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>Post Source
                        <?php foreach ($sourceList as $source) {

                        ?>
                            <label>
                                <input name="source_id[]" type="checkbox" value="<?php echo $source['id']; ?>" class="mark" <?php if (in_array($source['id'], $studioid)) {

                                                                                                                                echo 'checked ';
                                                                                                                            } ?>>
                                <?php echo $source['source']; ?>
                                </input>
                            </label>
                        <?php  } ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>Post Producer
                        <?php foreach ($producerList as $prod) { ?>
                            <label>
                                <input type="checkbox" class="mark" name="producer_id[]" value="<?php echo $prod['id']; ?>" class="mark" <?php if (in_array($prod['id'], $producerid)) {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <?php echo $prod['producers']  ?>
                                </input>
                            </label>
                        <?php   } ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>Post Genre
                        <?php foreach ($genreList as  $genre) { ?>
                            <label>
                                <input type="checkbox" name="genre_id[]" value="<?php echo $genre['id']; ?> " class="mark" <?php if (in_array($genre['id'], $genreid)) {
                                                                                                                                echo 'checked';
                                                                                                                            } ?>>
                                <?php echo $genre['genre']; ?>
                                </input>
                            </label>
                        <?php
                        } ?>
                    </label>
                </div>
                <div class="form-group">
                    <label>Type
                        <input type="text" name="type" id="type" value="<?php echo $data->type ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label>Sypnosis
                        <textarea class="form-control ckeditor" rows="3" name="sypnosis"> <?php echo $data->sypnosis; ?></textarea>
                    </label>
                </div>
                <div class="form-group">
                    <label> Release Date:
                        <input type="date" name="release_date" id="release_date" value="<?php echo $data->release_date; ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label> Aired :
                        <input type="date" name="aired" id="aired" value="<?php echo $data->aired; ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label>Episodes:
                        <input type="number" name="episodes" value="<?php echo $data->episodes; ?>">
                    </label>
                </div>
                <div class="form-group" enctype="multipart/form-data">
                    <label>Image<br>
                        <input type="hidden" value="<?php echo $data->image_url;  ?>" name="old_image">
                        <img src="../images/<?php echo $data->image_url;  ?>" height="100" width="200" alt="" srcset=""><br>
                        <br><input type="file" name="image">
                    </label>
                </div>


                <div class="form-group">
                    <label>Status
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
                    </label>
                </div>
                <div class="form-group">
                    <label>Featured
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
                    </label>
                </div>
                <div class="form-group">
                    <label>Slider Key
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
                    </label>
                </div>

                <button type="submit" name="submit" value='submit' class="btn btn-success">Submit Button</button>
                <button type="reset" class="btn btn-danger">Reset Button</button>
            </form>
        </div>
    </div>
</div>
<?php
include('header_footer/footer.php');
?>
<script src="../js/ckeditor/ckeditor.js"></script>
<script>
    // script for selected.
    // const clicks = document.getElementsByClassName('mark');
    // clickArray = [...clicks];
    // console.log(clickArray);
    // clickArray.forEach(click => {
    //     click.addEventListener('click', function() {
    //         console.log(click);
    //         if (this.hasAttribute('checked')) {
    //             this.removeAttribute('checked');
    //         } else {
    //             this.setAttribute('checked', '')
    //         }
    //     });
    // })
</script>
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