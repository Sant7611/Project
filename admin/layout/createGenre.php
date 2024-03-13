<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/genre.class.php');

$genre = new Genre();

if (isset($_POST['submit'])) {
    // echo $_POST['genre'];
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $genre->set('genre', $_POST['genre']);
        $res = $genre->save();
        if ($res) {
            $msg = "Genre successfully added with id " . $res;
            
        } else {
            $Errmsg = "Genre insertion unsuccessful";
        }
    } else {
        $Errmsg = 'Please enter Genre Name!!!';
    }
}
?>
<div id="page-wrapper">

    <div class="col-lg-12">
        <?php if (isset($msg)) { ?>
            <div class="alert alert-success"><?php echo $msg; ?> </div>
        <?php } ?>
        <?php if (isset($Errmsg)) { ?>
            <div class="alert alert-danger"><?php echo $Errmsg; ?> </div>
        <?php } ?>
        <h1 class="page-header">Create Genre</h1>
    </div>

    <div class="row">
        <form action="" class="Genre" method="post">

            <div class="form-group">
                <label class="label" for="genrename">Genre Name</label>
                <input type="text" name="genre" id="genrename" class="form-control">
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success" value="submit" name="submit">Create</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </div>
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>