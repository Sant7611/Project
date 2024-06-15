<?php
include('user/header-footer/header.php');
include('admin/class/wishlist.class.php');

$wishlist = new Wishlist();

?>
<div class="container">
    <div class="box-main">
        <input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['id']; ?>">

        <div class="show">

        </div>

    </div>
</div>
<script>
    $(document).ready(function(e) {
        function fetchWishlist() {
            var user_id = $('#user_id').val();
            console.log(user_id);
            $.ajax({
                url: 'user/checkWishlist.php',
                method: 'POST',
                data: {
                    user_id: user_id
                },
                success: function(response) {
                    $('.show').append(response);
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    console.log('error:', error);
                }
            });
        }

        fetchWishlist();
    });
</script>
<?php include('user/header-footer/footer.php'); ?>