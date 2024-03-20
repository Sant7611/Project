<?php
include('admin/class/user.class.php');

if (isset($_POST["submit"])) {
    $uname = $_POST['uname'];
    $pass = $_POST['pwd'];
    $email = $_POST['email'];
    $err = [];

    $userObj = new User();

    if (isset($uname) && !empty($uname)) {
        $userObj->username =  $uname;
    } else {
        $err['msg'] = 'Enter your username';
    }
    if (isset($pass) && !empty($pass)) {
        $userObj->password = $pass;
    } else {
        $err['msg'] = 'Enter your password';
    }
    if (isset($email) && !empty($email)) {
        $userObj->email = $email;
    } else {
        $err['msg'] = "Enter your email";
    }
    try {

        if (count($err) == 0) {
            $userObj->signup();
        } else {
            $err['msg'] = "Please try again...";
        }
    } catch (mysqli_sql_exception $e) {
        echo "Not available username or email!! Try another";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-up Page</title>
</head>

<body>
    <div class="main">
        <?php if (isset($err['msg'])) { ?>
            <div class="message">
                <?php echo $err['msg'];
                $err['msg'] = ""; ?>
            </div>
        <?php } ?>
        <form action="" method="post">
            <fieldset>
                <legend>Sign-up form</legend>
                <input type="text" name="uname" id="uname" placeholder="Username"> <br>
                <input type="email" name="email" id="email" placeholder="Email"> <br>
                <input type="password" name="pwd" id="pwd" placeholder="password"> <br>
                <input type="submit" value="submit" name="submit">
            </fieldset>
        </form>
    </div>
</body>

</html>