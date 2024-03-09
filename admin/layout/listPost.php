<?php
@session_start();
include('header_footer/header.php');
include('../class/post.class.php');
// include('sideBar.php');

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}

if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $successMessage = $_SESSION['message'];
    $_SESSION['message'] = "";
}
$postObj = new Post();

$dataList = $postObj->fetch();


// echo "<pre>";
// print_r($dataList);
// echo "</pre>";

?>
<style>
    tr {
        text-align: center;
        border: 2px solid black;
    }
</style>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List Post</h1>
        </div>
    </div>
    <?php
    if (isset($successMessage)) {
        echo '<div class="alert alert-success">' . $successMessage . '</div>';
    }
    if (isset($msg)) {
        echo '<div class="alert alert-success">' . $msg . '</div>';
    }
    ?>
    <div class="row">
        <div class="panel-body">
            <table width="100%" class=" create-main " id="">
                <thead>
                    <tr>
                        <th>S.NO</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Genre</th>
                        <th>Studio</th>
                        <th>producer</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dataList as $key => $post) { ?>
                        <tr>
                            <td> <?php echo $key + 1; ?></td>
                            <td> <?php echo $post['title']; ?> </td>
                            <td> <?php echo $post['type']; ?> </td>
                            <td><?php echo $post['genre']; ?></td>
                            <td><?php echo $post['studio'];} ?></td>
                            <td><?php echo $post['producer']; ?></td>
                            <td>
                                <img height='100' width='100' src="../images/<?php echo $post['image_url']; ?>" alt="" srcset="">
                            </td>
                            <td class="center"><?php
                                                if ($post['featured'] == 1) {
                                                    echo "<label class='label-success'>Yes</label>";
                                                } else {
                                                    echo "<label class='label-danger'>No</label>";
                                                }
                                                ?>
                            </td>

                            <td class="center"><?php
                                                if ($post['status'] == 1) {
                                                    echo "<label class='label-success'>Active</label>";
                                                } else {
                                                    echo "<label class='label-danger'>Inactive</label>";
                                                }
                                                ?>
                            </td>

                            <td class="center" width="20%">
                              <button class="btn btn-success"><a href="editPost.php?id=<?php echo $post['id']; ?>" role="btn"><i class="fa fa-edit"></i>Edit</a></button>
                                <button class="btn btn-danger"><a href="deletePost.php?id=<?php echo $post['id']; ?>" role="btn"><i class="fa fa-trash"></i>Delete</a></button>
                            </td>
                        </tr>
                        <?php   ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
include('header_footer/footer.php');
?>