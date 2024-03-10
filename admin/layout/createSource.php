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
    <div class="col-lg-12">
        <h1 class="page-header">Create Source</h1>
    </div>
    <div class="row">
        <div id="Source-main">
            <form action="" class="Source" method="post">
                <?php if (isset($msg)) { ?>
                    <div><?php echo $msg; ?> </div>
                <?php } ?>
                <?php if (isset($Err)) { ?>
                    <div><?php echo $Err; ?> </div>
                <?php } ?>
                <div class="form-group">
                    <label class="label">Source Name</label>
                    <input type="text" name="source" class="form-control">
                </div>
                
                <button type="submit" value="submit" class="btn-success btn" name="submit">Create</button>
                <button type="reset" class="btn btn-danger">Reset</button>
            </form>
        </div>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>