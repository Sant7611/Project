<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/genre.class.php');

$genre = new Genre();

if (isset($_POST['submit'])) {
    // echo $_POST['genre'];
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $genre->set('genre', $_POST['genre']);
        $res = $genre->edit();
        if ($res == "success") {
            $msg = "Genre successfully added with id " . $res;
            $Err = "";
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
            <label class="label-block">genre Name</label>
            <input type="text" name="genre" class="input-genre">
            <input type="submit" value="submit" name="submit">
            <input type="reset">
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>