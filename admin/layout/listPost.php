<?php
@session_start();
include('header_footer/header.php');
include('../class/post.class.php');
// include('sideBar.php');
$postObj = new Post();

if (isset($_GET['msg'])) {
    $msg = $_GET['msg'];
}


if (isset($_GET['page'])) {
    $postObj->set('page', $_GET['page']);
    $page = $_GET['page'];
} else {
    $page = 1;
}

$dataList = $postObj->sortCreatedDate(0);

if (isset($_SESSION['message']) && $_SESSION['message'] != "") {
    $successMessage = $_SESSION['message'];
    $_SESSION['message'] = "";
}

$totalPost = $postObj->allPost();
$totalPages = ceil($totalPost / 5);

// echo "<pre>";
// print_r($totalPost);
// echo "</pre>";
// if (isset($_SESSION['msg']) && $_SESSION['msg'] != "") {
//     $successMessage = $_SESSION['msg'];
//     $_SESSION['msg'] = "";
// }


// echo "<pre><div style='background: #000; position:absolute; bottom: -800; color: #fff; z-index : 1;'>";
// print_r($dataList);
// echo "</div></pre>";

?>

<div id="page-wrapper">
    <?php
    if (isset($successMessage)) {
        echo '<div class="alert alert-danger">' . $successMessage . '</div>';
    }
    if (isset($msg)) {
        echo '<div class="alert alert-success">' . $msg . '</div>';
    }
    ?>
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">List Post</h1>
        </div>
    </div>
    <!-- <div class="row"> -->
    <div class="panel-body">
        <table id="custom-table">
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
                        <td><?php echo $post['studio']; ?></td>
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
                            <button class="btn btn-success"><a href="editPost.php?id=<?php echo $post['id']; ?>" role="btn"><i class="fa fa-edit"></i> Edit</a></button>
                            <button class="btn btn-danger"><a href="deletePost.php?id=<?php echo $post['id']; ?>" role="btn"><i class="fa fa-trash"></i> Delete</a></button>
                        </td>
                    </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
    <div class="row">
        <div class="pagination">
            <span class="pagination-title">Page: </span>
            <ul class="pageList">
                <?php for ($i = 1; $i <= $totalPages; $i++) { ?>
                    <li><a class="pageNumbers <?php echo $i == $page ? 'active' : ''; ?>" href="listPost.php?page=<?php echo $i ?>" data-page="<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>
<script>
    // pageNumber = document.querySelectorAll('.pageNumbers .pageList');
    // pageNumber.forEach(page => {
    //     page.addEventListener('click', (event) => {
    //         page.forEach(item => item.classList.remove('active'))

    //         this.classList.add('active')
    //     })
    // });
    // Get all pagination links
    const links = Array.from(document.querySelectorAll('.pageList .pageNumbers'));

    // Add click event listener to each link
    links.forEach(link => {
        link.addEventListener('click', function(event) {
            // event.preventDefault(); // Prevent default link behavior

            // Remove 'active' class from all links
            links.forEach(item => item.classList.remove('active'));

            // Add 'active' class to the clicked link
            this.classList.add('active');
        });
    });
</script>
<?php
include('header_footer/footer.php');
?>