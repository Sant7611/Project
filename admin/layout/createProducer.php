<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/producer.class.php');

$producer = new Producer();

if (isset($_POST['submit'])) {
    // echo $_POST['producer'];
    if (isset($_POST['producer']) && !empty($_POST['producer'])) {
        $producer->set('producers', $_POST['producer']);
        $res = $producer->save();
        if ($res) {
            $msg = "Producer successfully added with id " . $res;
            $Err = "";
        } else {
            $msg = "Producer insertion unsuccessful";
        }
    } else {
        $Err = 'Producer type already taken';
    }
}
?>
<div id="page-wrapper">
    <div class="col-lg-12">
        <h1 class="page-header">Create Producer</h1>
    </div>
    <div class="row">
        <div id="Producer-main">
            <form action="" class="Producer" method="post">
                <?php if (isset($msg)) { ?>
                    <div><?php echo $msg; ?> </div>
                <?php } ?>
                <?php if (isset($Err)) { ?>
                    <div><?php echo $Err; ?> </div>
                <?php } ?>
                <div class="form-group">
                    <label class="label" for="producername">Producer Name</label>
                    <input type="text" name="producer" class="form-control">
                </div>
                <div class="row">
                    <button class="btn-success btn" type="submit" name="submit">Create </button>
                    <button type="reset" class="btn btn-danger"> Reset </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>