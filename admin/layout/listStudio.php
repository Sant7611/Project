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

?>
<style>
    .center {
        text-align: center;
    }
</style>

<div id="page-wrapper">

    <?php
    if (isset($msg)) {
        echo '<div class="msg">' . $msg . ' </div>';
    }
    ?>

    <div class="title">
        <h1 class="page-header">List Studio</h1>
    </div>
    <div class="row">
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