<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/source.class.php');

$source = new Source();

if (isset($_POST['submit'])) {
    // echo $_POST['source'];
    if (isset($_POST['source']) && !empty($_POST['source'])) {
        $source->set('source', $_POST['source']);
        $res = $source->save();
        if ($res) {
            $msg = "Source successfully added with id " . $res;
            $Err = "";
        } else {
            $msg = "Source insertion unsuccessful";
        }
    } else {
        $Err = 'Source type already taken';
    }
}
?>
<div id="page-wrapper">
<div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Create Source</h1>
        </div>
    </div>
    <div id="Source-main">
        <form action="" class="Source" method="post">
            <?php if (isset($msg)) { ?>
                <div><?php echo $msg; ?> </div>
            <?php } ?>
            <?php if (isset($Err)) { ?>
                <div><?php echo $Err; ?> </div>
            <?php } ?>
            <label class="label-block">Source Name</label>
            <input type="text" name="source" class="input-source">
            <input type="submit" value="submit" name="submit">
            <input type="reset">
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>