<?php
include('sidebar.php');
include('header_footer/header.php');
include('../class/genre.class.php');

$genre = new Genre();

if (isset($_POST['submit'])) {
    // echo $_POST['genre'];
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $genre->set('genre', $_POST['genre']);
        $res = $genre->save();
        if ($res) {
            $msg = "Category successfully added with id " . $res;
            $Err = "";
        } else {
            $msg = "Category insertion unsuccessful";
        }
    } else {
        $Err = 'Genre type already taken';
    }
}
?>
<div class="main">

    <div id="Genre-main">
        <form action="" class="Genre" method="post">
            <?php if (isset($msg)) { ?>
            <div><?php echo $msg; ?> </div>
            <?php } ?>
        <?php if (isset($Err)) { ?>
            <div><?php echo $Err; ?> </div>
            <?php } ?>
            <label class="label-block">Genre Name</label>
            <input type="text" name="genre" class="input-genre">
            <input type="submit" value="submit" name="submit">
            <input type="reset">
    </form>
</div>
</div>

<?php
include('header_footer/footer.php');
?>