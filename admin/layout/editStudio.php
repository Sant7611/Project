<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/studio.class.php');

$studio = new Studio();

if (isset($_POST['submit'])) {
    // echo $_POST['studio'];
    if (isset($_POST['studio']) && !empty($_POST['studio'])) {
        $studio->set('studio', $_POST['studio']);
        $res = $studio->edit();
        if ($res == "success") {
            $msg = "Studio successfully added with id " . $res;
            $Err = "";
        } else {
            $msg = "Studio insertion unsuccessful";
        }
    } else {
        $Err = 'Studio name already exist';
    }
}
?>
<div id="page-wrapper">

    <div id="create-main">
        <form action="" class="studio" method="post">
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