<?php
include('sidebar.php');
include('header_footer/header.php');
include('../class/post.class.php');

if(isset($_POST['submit'])){
    echo "form Submitted";
}
?>

<div id="Genre-main">
    <form action="" class="Genre" method="post">        <label class="label-block">Genre Name</label>
        <input type="text" name="genre" class="input-genre" required>
        <input type="submit" value="submit" name = "submit">
        <input type="reset">
    </form>
</div>

<?php
include('header_footer/footer.php');
?>