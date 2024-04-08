<?php
// include('sidebar.php');
include('header_footer/header.php');
include('../class/source.class.php');

$source = new Source();
if(isset($_GET['id'])){
    $source->set('id', $_GET['id']);
    $sources = $source->getById();
}

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
            <div class="row">
                <div class="row-nav">
                    <div>
                        <h1 class="page-header">Edit Source</h1>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="source">Source Name</label>
                    <?php foreach($sources as $sourceName){ ?>
                    <input type="text" value="<?php echo $sourceName['source'] ?>" name="source" id="source" class="form-control">
                    <?php } ?>
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