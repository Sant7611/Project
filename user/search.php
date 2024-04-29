<?php
include_once('../admin/class/post.class.php');
$post = new Post();

$searchItem = $_POST['searchData'];

$post->set('searchData', $searchItem);
$res = $post->search();
// echo gettype($res);
// $result = json_encode($res);
// echo $searchItem;
// foreach($res as $key=>$value){
//     echo $value['title'];
// }

?>
<?php
if (gettype($res) == 'array') {
    foreach ($res as $key => $value) {
?>
        <div class=>
            <a href="post.php?id=<?php echo $value['id'] ?>" class="search-data">
                <div class="search-data-image">
                    <img src="admin/images/<?php echo $value['image_url'] ?>" class="search-img" alt="" srcset="">
                </div>
                <div class="search-data-title">
                    <h3><?php echo $value['title']; ?></h3>
                    <h5 class="sub-text"><?php echo $value['type'] ?></h5>
                </div>
            </a>
        </div>

    <?php }
} else { ?>
    <span class="search-data">No search result found </span>
<?php } ?>