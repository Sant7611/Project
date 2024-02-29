<?php
include('sidebar.php');
include('header_footer/header.php');
include('../class/producer.class.php');

$producer = new Producer();

if (isset($_POST['submit'])) {
    // echo $_POST['producer'];
    if (isset($_POST['producer']) && !empty($_POST['producer'])) {
        $producer->set('producer', $_POST['producer']);
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
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Producer</h1>
        </div>
    </div>
    <div id="Producer-main">
        <form action="" class="Producer" method="post">
            <?php if (isset($msg)) { ?>
                <div><?php echo $msg; ?> </div>
            <?php } ?>
            <?php if (isset($Err)) { ?>
                <div><?php echo $Err; ?> </div>
            <?php } ?>
            <label class="label-block">Producer Name</label>
            <input type="text" name="producer" class="input-producer">
            <input type="submit" value="submit" name="submit">
            <input type="reset">
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>