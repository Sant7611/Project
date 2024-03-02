<?php
include('../class/source.class.php');
include('header_footer/header.php');
include('sideBar.php');
session_start();

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
        <h1>List Source</h1>
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
                    <a href="editSource.php?id=<?php echo $sources['id']; ?>">Edit</a>
                    <a href="deleteSource.php?id=<?php echo $sources['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php
include('header_footer/footer.php');
?>