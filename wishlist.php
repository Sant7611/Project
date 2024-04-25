<?php
include('user/header-footer/header.php');
include('admin/class/wishlist.class.php');

// $id = $_GET['id'];
$id = $_GET['id'];
$wishlist = new Wishlist();
// $datalist = $wishlist->fetchById();

?>
<div class="container">
    <div class="box-main">
        <div class="collection">
            <input type="hidden" name="user_id" id="user_id" value="<?php echo $id; ?>">

        </div>
    </div>
</div>
<script>
    $(document).ready(function(e) {
        function fetchWishlist() {
            var user_id = $('#user_id').val();
            $.ajax({
                url: 'user/checkWishlist.php',
                method: 'POST',
                data: {
                    user_id: user_id
                    // status: 'fetchById'
                },
                dataType: 'JSON',
                success: function(response) {
                    console.log(response.result);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log('error:', error);
                    console.log(status);
                }
            });
        }

        fetchWishlist();
    });
</script>