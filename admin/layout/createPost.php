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
    $result = $post->save();
    echo $result;
    if (is_integer($result)) {
        $ErrMs = "";
        $msg = "Post inserted Successfully with id " . $result;
    } else {
        $msg = "";
    }
}
?>


<div id="page-wrapper">

    <div class="col-lg-12">
        <h1 class="page-header">Create Post</h1>
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
                    <label class="label" for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" required>
                </div>
                <div class="form-group">
                    <label for="studio_id" class="label">Post Studio</label>
                    <div class="insert-data">
                        <?php foreach ($studioList as $studios) { ?>
                            <div>
                                <label>
                                    <input type="checkbox" name="studio_id[]" value="<?php echo $studios['id']; ?>">
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
                                    <input name="source_id[]" type="checkbox" value="<?php echo $source['id']; ?>">
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
                                    <input type="checkbox" class="mark" name="producer_id[]" value="<?php echo $prod['id']; ?>">
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
                                    <input type="checkbox" name="genre_id[]" value="<?php echo $genre['id']; ?> ">
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
            <textarea class="form-control ckeditor" id="sypnosis" rows="3" name="sypnosis"></textarea>
        </div>
        <div class="form-group">
            <label for="release_dates" class="label"> Release date:</label>
            <input type="date" id="release_dates" name="release_date" value="">

        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="aired" class="label"> Aired: </label>
            <input type="date" id="aired" name="aired" value="">
        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <label for="episode" class="label">Episodes: </label>
            <input type="number" id="episode" class="form-control" name="episodes">
        </div>
    </div>
    <div class="row">
        <div class="form-group" enctype="multipart/form-data">
            <label class="label" for="image">Image</label>
            <!-- using multiple helps to upload multiple images -->
            <input type="file" name="image" id="image" required>
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