<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/source.class.php');

$source = new Source();

if (isset($_POST['submit'])) {
    // echo $_POST['source'];
    if (isset($_POST['source']) && !empty($_POST['source'])) {
        $source->set('source', $_POST['source']);
        $res = $source->edit();
        if ($res == "success") {
            $msg = "Source successfully added with id " . $res;
           
        } else {
            $msg = "Source insertion unsuccessful";
        }
    } else {
        $Err = 'Source name already exist';
    }
}
?>
<div id="page-wrapper">
    <div id="create-main">
        <form action="" class="source" method="post">
            <?php if (isset($msg)) { ?>
                <div><?php echo $msg; ?> </div>
            <?php } ?>
            <?php if (isset($Err)) { ?>
                <div><?php echo $Err; ?> </div>
            <?php } ?>
            <label class="label-block">source Name</label>
            <input type="text" name="source" class="input-source">
            <input type="submit" value="submit" name="submit">
            <input type="reset">
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>