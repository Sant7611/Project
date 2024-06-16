<?php
include('header_footer/header.php');
include('../class/studio.class.php');

$studio = new Studio();

if(isset($_GET['id'])){
    $studio->set('id', $_GET['id']);
    $studios = $studio->getById();
}
if (isset($_POST['submit'])) {
    if (isset($_POST['studio']) && !empty($_POST['studio'])) {
        $studio->set('studio', $_POST['studio']);
        $res = $studio->edit();
        if ($res == "success") {
            $msg = "Studio successfully added with id " . $res;
          
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
            <div class="row">
                <div class="row-nav">
                    <div>
                        <h1 class="page-header">Edit Studio</h1>
                    </div>
                </div>
                <div class="form-group">
                    <label class="label" for="studio" >Studio Name</label>
                    <?php foreach($studios as $studioName){ ?>
                    <input type="text" name="studio" value="<?php echo $studioName['studio']; ?>" id="studio" class="form-control">
                    <?php } ?>
                </div>
                <input type="submit" value="submit" class="btn btn-success" name="submit">
                <input type="reset" class="btn btn-danger" >
            </div>
        </form>
    </div>
</div>

<?php
include('header_footer/footer.php');
?>