<?php
include('sidebar.php');
include('header_footer/header.php');
include('common.class.php');


if (isset($_POST['submit'])) {
    if (isset($_POST['genre']) && !empty($_POST['genre'])) {
        $genre = 
        $sql = "insert into genre";      
        

    
    } else {
        $error = 'Please enter the genre type';
    }
}
?>

<div id="Genre-main">
    <form action="" class="Genre" method="post">
        <?php if(isset($error)) echo "<p>". $error. "</p>"; ?>
        <label class="label-block">Genre Name</label>
        <input type="text" name="genre" class="input-genre" >
        <input type="submit" value="submit" name="submit">
        <input type="reset">
    </form>
</div>

<?php
include('header_footer/footer.php');
?>