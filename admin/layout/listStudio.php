<?php
include('../class/studio.class.php');
include('header_footer/header.php');
// include('sideBar.php');
session_start();

$studio = new Studio();
$datalist = $studio->fetch();

if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $msg = $_SESSION['message'];
    $_SESSION['message'] = "";
}

if (isset($_GET['msg'])) {
    $Errmsg = $_GET['msg'];
}

?>
<div id="page-wrapper">

    <?php

    if (isset($msg)) {
        echo '<div class="alert alert-success">' . $msg . ' </div>';
    }
    if (isset($Errmsg)) {
        echo '<div class="alert alert-danger">' . $Errmsg . ' </div>';
    }
    ?>

    <div class="row">
        <div class="row-nav">
            <div>
                <h1 class="page-header">List Studio</h1>
            </div>
            <div class="searchbar">
                <input type="text" placeholder="Search" autocomplete="off" name="search" id="search">
            </div>
        </div>
        <table>
            <tr>
                <th>S.No</th>
                <th>Studio Name</th>
                <th>Action</th>
            </tr>
            <?php foreach ($datalist as $key => $studios) { ?>
                <tr class="center">
                    <td><?php echo $key + 1; ?></td>
                    <td><?php echo $studios['studio']; ?></td>
                    <td width="20%">

                        <button class="btn-success btn"><a href="editStudio.php?id=<?php echo $studios['id']; ?>">Edit</a></button>
                        <button class="btn-danger btn"><a href="deleteStudio.php?id=<?php echo $studios['id']; ?>">Delete</a></button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php
include('header_footer/footer.php');
?>