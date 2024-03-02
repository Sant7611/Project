<?php
include('../class/producer.class.php');
include('header_footer/header.php');
include('sideBar.php');
session_start();

$producer = new Producer();
$datalist = $producer->fetch();

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
        <h1>List Producer</h1>
    </div>
    <table>
        <tr>
            <th>S.No</th>
            <th>Producer Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($datalist as $key => $producers) { ?>
            <tr class="center">
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $producers['producers']; ?></td>
                <td width="20%">

                    <a href="editProducer.php?id=<?php echo $producers['id']; ?>">Edit</a>
                    <a href="deleteProducer.php?id=<?php echo $producers['id']; ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php
include('header_footer/footer.php');
?>