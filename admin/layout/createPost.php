<?php
include('header_footer/header.php');
include('../class/post.class.php');
include('../class/studio.class.php');
include('../class/genre.class.php');
include('../class/source.class.php');
include('../class/producer.class.php');

$post = new Post();
$genre = new Genre();
$studio = new Studio();
$producer = new Producer();
$source = new Source();

$sourceList = $source->fetch(); 
$producerList = $producer->fetch(); 
$studioList = $studio->fetch();
$genreList = $genre->fetch();

@session_start();
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
    echo "<pre>";
    print_r($_FILES['image']);
    echo "</pre>";
    $result = $post->save();
    if (is_integer($result)) {
        $ErrMs = "";
        $msg = "News inserted Successfully with id " . $result;
    } else {
        $msg = "";
    }
}
include('sideBar.php');
?>


<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Post</h1>
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
                    <input type="text" class="form-control" name="title" id="title" required>
                </div>
                <div class="form-group">
                    <label>Post Studio</label>
                    <select class="form-control" name="studio_id[]" multiple required>
                        <option value="">Select Studio</option>
                        <?php foreach ($studioList as $studios) {  ?>
                            <option value="<?php echo $studios['id'];  ?>">
                                <?php echo $studios['studio'];  ?>
                            </option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Genre</label>
                    <select class="form-control" name="genre_id[]" multiple required>
                        <option value="">Select Genre</option>
                        <?php foreach ($genreList as $genres) {  ?>
                            <option value="<?php echo $genres['id'];  ?>">
                                <?php echo $genres['genre'];  ?>
                            </option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Producers</label>
                    <select class="form-control" name="producers_id[]" multiple required>
                        <option value="">Select Producers</option>
                        <?php foreach ($producerList as $producer) {  ?>
                            <option value="<?php echo $producer['id'];  ?>">
                                <?php echo $producer['producers'];  ?>
                            </option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Post Source</label>
                    <select class="form-control" name="source_id[]" multiple required>
                        <option value="">Select Source</option>
                        <?php foreach ($sourceList as $source) {  ?>
                            <option value="<?php echo $source['id'];  ?>">
                                <?php echo $source['source'];  ?>
                            </option>
                        <?php  } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <input class="form-control" type="text" name="type" required></input>
                </div>
                </div>
                <div class="form-group">
                    <label>Duration </label>
                    <input class="form-control" type="text" name="duration" required></input>
                </div>
                <div class="form-group">
                    <label>Sypnosis</label>
                    <textarea class="form-control ckeditor" rows="3" name="sypnosis"></textarea>
                </div>
                <div class="form-group">
                    <label for="release_date"> Release date:
                        <input type="date" name="release_date" id="release_date" value="">
                    </label>
                </div>
                </div>
                <div class="form-group">
                    <label for="aired"> Aired:
                        <input type="date" name="aired" id="aired" value="">
                    </label>
                </div>
                <div class="form-group">
                    <label for="episodes">Episodes: </label>
                    <input type="number" name="episodes" id="">
                </div>
                <div class="form-group" enctype="multipart/form-data">
                    <label>Image</label>
                    <!-- using multiple helps to upload multiple images -->
                    <input type="file" name="image" required>
                </div>


                <div class="form-group">
                    <label>Status</label>
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
                <div class="form-group">
                    <label>Featured</label>
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
                <div class="form-group">
                    <label>Slider Key</label>
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