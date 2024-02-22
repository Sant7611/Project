<?php
include('../class/studio.class.php');
include('header_footer/header.php');
include('sideBar.php');

$studio = new Studio();
$datalist = $studio->fetch();

?>
<style>
    .center {
        text-align: center;
    }
</style>

<div id="page-wrapper">

    <?php echo "<pre>";
    print_r($datalist);
    echo "</pre>"; ?>
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
                    <a href="editStudio.php?msg=<?php echo $studios['id'] ?>">Edit</a>
                    <a href="deleteStudio.php?msg=<?php $studios['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
<?php
include('header_footer/footer.php');
?>