<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/studio.class.php');

$studio = new Studio();

if (isset($_POST['submit'])) {
    // echo $_POST['studio'];
    if (isset($_POST['studio']) && !empty($_POST['studio'])) {
        $studio->set('studio', $_POST['studio']);
        $res = $studio->save();
        if ($res) {
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
    <div class="col-lg-12">
        <h1 class="page-header">Create Studio</h1>
    </div>
    <div class="row">
        <div id="create-main">
            <form action="" class="studio" method="post">
                <?php if (isset($msg)) { ?>
                    <div><?php echo $msg; ?> </div>
                <?php } ?>
                <?php if (isset($Err)) { ?>
                    <div><?php echo $Err; ?> </div>
                <?php } ?>
                <div class="form-group">
                    <label class="label" for="studioname">Studio Name</label>
                    <input type="text" class="form-control" id="studioname" name="studio">
                </div>
                <button type="submit" value="submit" class="btn-success btn" name="submit">Create</button>
                <button type="reset" class="btn btn-danger" >Reset</button>
            </form>
        </div>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>