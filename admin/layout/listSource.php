<?php
session_start();
include('../class/source.class.php');
include('header_footer/header.php');


$source = new Source();
$datalist = $source->fetch();

if (isset($_GET['msg'])) {
    $errMsg = $_GET['msg'];
}

if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $msg = $_SESSION['message'];
    $_SESSION['message'] = "";
}
?>

<div id="page-wrapper">

    <?php
    if (isset($errMsg)) { ?>
        <div class="alert alert-danger"> <?php echo $errMsg ?></div>
    <?php } ?>
    <?php
    if (isset($msg)) { ?>
        <div class="alert alert-success"> <?php echo $msg; ?></div>
    <?php } ?>

    <div class="row">
        <div class="row-nav">
            <div>
                <h1 class="page-header">List Source</h1>
            </div>
        </div>
        <table>
            <tr>
                <th>S.No</th>
                <th>Source Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($datalist as $key => $sources) { ?>
                <tr class="center">
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $sources['source']; ?></td>
                    <td width="20%">
                        <button class="btn-success btn"><a href="editSource.php?id=<?php echo $sources['id']; ?>">Edit</a></button>
                        <button class="btn-danger btn"><a href="deleteSource.php?id=<?php echo $sources['id']; ?>">Delete</a></button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php
include('header_footer/footer.php');
?>