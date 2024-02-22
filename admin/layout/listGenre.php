<?php
include('../class/genre.class.php');
include('header_footer/header.php');
include('sideBar.php');

$genre = new Genre();
$datalist = $genre->fetch();

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
            <th>Genre Name</th>
            <th>Action</th>
        </tr>
        <?php foreach ($datalist as $key => $genres) { ?>
            <tr class="center">
                <td><?php echo $key + 1; ?></td>
                <td><?php echo $genres['genre']; ?></td>
                <td width="20%">
                    <a href="editGenre.php?msg=<?php echo $genres['id'] ?>">Edit</a>
                    <a href="deleteGenre.php?msg=<?php $genres['id'] ?>">Delete</a>
                </td>
            </tr>

        <?php } ?>
    </table>
</div>
<?php
include('header_footer/footer.php');
?>