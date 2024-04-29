<?php
include('../class/admin.class.php');
$admin = new Admin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchValue = $_POST['searchText'];
    $admin->searchValue = $searchValue;

    $searchData = $admin->Search();
}

if (isset($_GET['page'])) {
    $postObj->set('page', $_GET['page']);
    $page = $_GET['page'];
} else {
    $page = 1;
}

$totalPost = $admin->countSearch();

$totalPages = ceil($totalPost / 5);


?>
<?php if (!empty($searchData)) { ?>
    <div class="row">
        <div class="row-nav">
            <div>
                <h1 class="page-header">Search</h1>
            </div>
            <div class="searchbar">
                <input type="text" placeholder="Search" autocomplete="off" name="search" id="search">
            </div>
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
                <?php foreach ($searchData as $key => $post) { ?>
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
        //##################for ################## Pagination.....
        // Get all pagination links
        const links = Array.from(document.querySelectorAll('.pageList .pageNumbers'));
        // console.log(links);
        // Add click event listener to each link
        links.forEach(link => {
            link.addEventListener('click', function(event) {
                // event.preventDefault(); // Prevent default link behavior
                // console.log(links);
                // console.log(link);
                // Remove 'active' class from all links
                links.forEach(item => item.classList.remove('active'));

                // alert(link);
                // Add 'active' class to the clicked link
                this.classList.add('active');
            });
        });
    </script>
<?php } else { ?>
    <div class="row">
        <div class="row-nav">
            <div>
                <h1 class="page-header">No Search Result Found</h1>
            </div>
        </div>
    </div>
<?php } ?>