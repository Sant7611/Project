<?php
session_start();
include('../class/genre.class.php');
include('header_footer/header.php');
// include('sideBar.php');


$genre = new Genre();
$datalist = $genre->fetch();

// echo "<pre>";
// print_r($datalist);
// echo "</pre>";


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
        <h1 class="page-header">List Genre</h1>
    </div>
    <div class="row">
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
                        <button class="btn btn-success"> <a href="editGenre.php?id=<?php echo $genres['id'] ?>">Edit</a></button>
                        <button class="btn-danger btn"><a href="deleteGenre.php?id=<?php echo $genres['id'] ?>">Delete</a></button>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>
<?php
include('header_footer/footer.php');
?>