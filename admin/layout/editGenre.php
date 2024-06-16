<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/genre.class.php');

$genre = new Genre();
if(isset($_GET['id'])){
    $genre->set('id', $_GET['id']);
    $genres = $genre->getById();
}

if (isset($_POST['submit'])) {
    
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $genre->set('genre', $_POST['genre']);
        $res = $genre->edit();
        if ($res == "success") {
            $msg = "Genre successfully added with id " . $res;
        } else {
            $msg = "Genre insertion unsuccessful";
        }
    } else {
        $Err = 'Genre name already exist';
    }
}
?>
<div id="page-wrapper">

    <div id="create-main">
        <form action="" class="genre" method="post">
            <?php if (isset($msg)) { ?>
                <div><?php echo $msg; ?> </div>
            <?php } ?>
            <?php if (isset($Err)) { ?>
                <div><?php echo $Err; ?> </div>
            <?php } ?>
            <div class="row">
                <div class="row-nav">
                    <div>
                        <h1 class="page-header">Edit Genre</h1>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="genre" >Genre Name</label>
                    <?php foreach($genres as $genreName){ ?>
                    <input type="text" value="<?php echo $genreName['genre']; ?>" id="genre" name="genre" class="form-control">
                    <?php } ?>
                </div>
                <input type="submit" value="submit" class="btn btn-success" name="submit">
                <input type="reset" class="btn btn-danger" >
            </div>
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>