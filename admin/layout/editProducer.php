<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/producer.class.php');

$producer = new Producer();

if (isset($_POST['submit'])) {
    // echo $_POST['producer'];
    if (isset($_POST['producer']) && !empty($_POST['producer'])) {
        $producer->set('producer', $_POST['producer']);
        $res = $producer->edit();
        if ($res == "success") {
            $msg = "Producer successfully added with id " . $res;
        } else {
            $msg = "Producer insertion unsuccessful";
        }
    } else {
        $Err = 'Producer name already exist';
    }
}
?>
<div id="page-wrapper">
    <div id="create-main">
        <form action="" class="producer" method="post">
            <?php if (isset($msg)) { ?>
                <div><?php echo $msg; ?> </div>
            <?php } ?>
            <?php if (isset($Err)) { ?>
                <div><?php echo $Err; ?> </div>
            <?php } ?>
            <div class="row">
                <div class="row-nav">
                    <div>
                        <h1 class="page-header">Edit Producer</h1>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="producer">Producer Name</label>
                    <input type="text" name="producer" id="producer" class="form-control">
                </div>
                <input type="submit" value="submit" class="btn btn-success" name="submit">
                <input type="reset" class="btn btn-danger">
            </div>
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>