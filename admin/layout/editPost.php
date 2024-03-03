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
$genreid = explode(',', $data->genre_id);
$producerid = explode(',', $data->producer_id);
$sourceid = explode(',', $data->source_id);
print_r($producerid);
echo "<br>" . $data->studio_id;
$genre = new Genre();
$studio = new Studio();
$source = new Source();
$producer = new Producer();

$studioList = $studio->fetch();
$genreList = $genre->fetch();
$producerList = $producer->fetch();
$sourceList = $source->fetch();

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
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="<?php echo $data->title; ?>" id="title" required>
                </div>
                <div class="form-group">
                    <label>Post Studio</label>
                    <select class="form-control" name="studio_id[]" multiple required>
                        <?php foreach ($studioList as $studios) {

                        ?>
                            <option value="<?php echo $studios['id']; ?>" <?php if (in_array($studios['id'], $studioid)) {
                                                                                echo 'selected';
                                                                            } ?>>
                                <?php echo $studios['studio']; ?>
                            </option>

                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Source</label>
                    <select class="form-control" name="source_id[]" multiple required>
                        <?php foreach ($sourceList as $source) {

                        ?>
                            <option value="<?php echo $source['id']; ?>" <?php if (in_array($source['id'], $studioid)) {
                                                                                echo 'selected';
                                                                            } ?>>
                                <?php echo $source['source']; ?>
                            </option>

                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Producer</label>
                    <select class="form-control" name="producer_id[]" multiple required>
                        <?php foreach ($producerList as $prod) { ?>
                            <option value="<?php echo $prod['id']; ?>" <?php $res = (in_array($prod['id'], $producerid)) ?  "selected" : false; //if (in_array($producer['id'], $producer)) {
                                                                            echo $res;
                                                                            ?>>
                                <?php echo $prod['producers']  ?>
                            </option>

                        <?php   } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Genre</label>
                    <select class="form-control" name="genre_id[]" multiple required>
                        <?php foreach ($genreList as  $genre) { ?>

                            <option value="<?php echo $genre['id']; ?>" <?php if (in_array($genre['id'], $genreid)) {
                                                                            echo 'selected';
                                                                        } ?>>
                                <?php echo $genre['genre']; ?>
                            </option>

                        <?php echo $key;
                        } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <input type="text" name="type" id="type" value="<?php echo $data->type ?>">
                </div>
                <div class="form-group">
                    <label>Sypnosis</label>
                    <textarea class="form-control ckeditor" rows="3" name="sypnosis"> <?php echo $data->sypnosis; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="release_date"> Release Date:
                        <input type="date" name="release_date" id="release_date" value="<?php echo $data->release_date; ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label for="aired"> Aired :
                        <input type="date" name="aired" id="aired" value="<?php echo $data->aired; ?>">
                    </label>
                </div>
                <div class="form-group">
                    <label for="episodes">Episodes: </label>
                    <input type="number" name="episodes" value="<?php echo $data->episodes; ?>">
                </div>
                <div class="form-group" enctype="multipart/form-data">
                    <label>Image</label><br>
                    <input type="hidden" value="<?php echo $data->image_url;  ?>" name="old_image">
                    <img src="../images/<?php echo $data->image_url;  ?>" height="100" width="200" alt="" srcset=""><br>
                    <br><input type="file" name="image">
                </div>


                <div class="form-group">
                    <label>Status</label>
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
                    <label>Featured</label>
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
                    <label>Slider Key</label>
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