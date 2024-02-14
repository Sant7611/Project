<?php
try {
    $con = mysqli_connect('localhost', 'root', '', 'anidb');  // yo maile afno database ma rakhera check gareko xu haii.
    if ($con) {
        echo "Connection Successful";
    }
} catch (mysqli_sql_exception $e) {
    echo "connection fail" . $e;        // maile yo afaile lekheko haii connect.php include nagari.
}

if (isset($_POST['submit'])) {
    $name = $_POST['uname'];
    $password = $_POST['pass'];

    if (isset($name) && !empty($name) && isset($password) && !empty($password)) {
        $insertquery = "insert into users(username, password)values('$name', '$password');"; //yesma '$name' lekhne jasari '$password' lekha vannale colon vitra lekha. ani sql paxi semicolon hunxa ;
        $result = mysqli_query($con, $insertquery);
        echo "<pre>";                   //yesma maile tmlai $con ma kk hunxa vanera dekhauna lekheko hai.
        print_r($con);
        echo "</pre>";                  
        if ($con->affected_rows == 1) {     // input garda euta row lai matra affect garxa so yo check garda ni hunxa input vayo ki nai vanera.
            $msg = "Data inserted successfully";
        } else {
            $msg = "Unsuccessful";      // if database ma data insert vayena vane affected_row 0 hunxa so else wala dekhauxa.
        }
    } else {
        echo "Please fill all the form";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <?php if (isset($msg)) {
            echo "<p> $msg </p>";
        } ?>
        <label for=""> Username</label>
        <input type="text" name="uname" placeholder="Enter username">

        <label for=""> Password</label>
        <input type="password" name="pass" placeholder="Enter password">
        <!-- yesma type:password hunxa natra tya password field ma lekhda **** vanera dekhaunna -->

        <input type="submit" name="submit">



    </form>

</body>

</html>