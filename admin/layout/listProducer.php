<?php
session_start();
include('../class/producer.class.php');
include('header_footer/header.php');
// include('sideBar.php');

$producer = new Producer();
$datalist = $producer->fetch();

if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $msg = $_SESSION['message'];
    $_SESSION['message'] = "";
}

if (isset($_GET['msg'])) {
    $errmsg = $_GET['msg'];
}
?>
<div id="page-wrapper">

    <?php
    if (isset($errmsg)) { ?>
        <div class="alert alert-danger"> <?php echo $errmsg ?></div>
    <?php } ?>
    <?php
    if (isset($msg)) { ?>
        <div class="alert alert-success"> <?php echo $msg; ?></div>
    <?php } ?>


    <div class="title">
        <h1 class="page-header">List Producer</h1>
    </div>
    <div class="row">
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
                        <button class="btn-success  btn"><a href="editProducer.php?id=<?php echo $producers['id']; ?>">Edit</a></button>
                        <button class="btn-danger btn"><a href="deleteProducer.php?id=<?php echo $producers['id']; ?>">Delete</a></button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php
include('header_footer/footer.php');
?>