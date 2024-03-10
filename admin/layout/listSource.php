<?php
session_start();
include('../class/source.class.php');
include('header_footer/header.php');
// include('sideBar.php');

$source = new Source();
$datalist = $source->fetch();

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
        <h1 class="page-header">List Source</h1>
    </div>
    <div class="row">
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