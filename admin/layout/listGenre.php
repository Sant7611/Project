<?php
session_start();
include('../class/genre.class.php');
include('header_footer/header.php');


$genre = new Genre();
$datalist = $genre->fetch();



if ((isset($_SESSION['message']) && $_SESSION['message'] != "") || (isset($_SESSION['msg']) && $_SESSION['msg'] != "")) {
    $msg = $_SESSION['message'];
    $Errmsg = $_SESSION['msg'];
    $_SESSION['message'] = "";
    $_SESSION['msg'] = "";
}

?>
<div id="page-wrapper">

    <?php
    if (isset($msg)) {
        echo '<div class="alert alert-success">' . $msg . ' </div>';
    }
    ?>
    <?php
    if (isset($Errmsg)) {
        echo '<div class="alert alert-danger">' . $Errmsg . ' </div>';
    }
    ?>

    <div class="row">
        <div class="row-nav">
            <div>
                <h1 class="page-header">List Genre</h1>
            </div>
            <div class="searchbar">
                <input type="text" placeholder="Search" autocomplete="off" name="search" id="search">
            </div>
        </div>
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