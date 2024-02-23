<?php
include('admin/class/user.class.php');

$userObj = new User();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $err = [];
    if (isset($password) && !empty($password)) {
        $userObj->password = $password;
    } else {
        $err['msg'] = 'Enter your password';
    }
    if (isset($email) && !empty($email)) {
        $userObj->email = $email;
    } else {
        $err['msg'] = "Enter your email";
    }

    if (count($err) == 0) {
        $stat = $userObj->login();
        
        echo "<pre>";
        print_r($stat);
        echo "</pre>";
    } else {
        echo "Invalid Credentials!!!!";
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
    <div class="main">
        <form action="" method="post">
            <fieldset>
                <legend>Login</legend>
                <input type="text" name="email" id="email" placeholder="Enter your email"> <br> <br>
                <input type="password" name="pwd" id="pwd" placeholder="Enter your password"> <br> <br>
                <input type="submit" value="submit" name="submit">
            </fieldset>
        </form>
    </div>
</body>

</html>