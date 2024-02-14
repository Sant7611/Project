<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
    <label for=""> Username</label>
    <input type="text" name="uname" placeholder="Enter username">

    <label for=""> Password</label>
    <input type="text" name="pass" placeholder="Enter password">

    <input type="submit" name="submit">
    
    
    
    </form>
</body>
</html>
<?php
include "connect.php";

if(isset($_POST['submit'])){
    $name=$_POST['uname'];
    $password= $_POST['pass'];

    $insertquery= "insert into users(username, password)values('$name', '$password');";
    $result= mysqli_query($con,$insertquery);

    if($result){
        ?>
        <script>
            alert("Data inserted successfully");
        </script>
    <?php 
    }else{
        ?>
        <script>
            alert("Error");
        </script>
        <?php
    }
}

?>