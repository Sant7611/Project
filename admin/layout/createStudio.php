<?php
include('sidebar.php');
include('header_footer/header.php');
include('../class/studio.class.php');

$studio = new Studio();

if (isset($_POST['submit'])) {
    // echo $_POST['studio'];
    if (isset($_POST['studio']) && !empty($_POST['studio'])) {
        $studio->set('studio', $_POST['studio']);
        $res = $studio->save();
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
            <label class="label-block">Studio Name</label>
            <input type="text" name="studio" class="input-studio">
            <input type="submit" value="submit" name="submit">
            <input type="reset">
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>