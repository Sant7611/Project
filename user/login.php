<?php
include('admin/class/user.class.php');
if (isset($_GET['message'])) {
    $message = $_GET['message'];
}
$userObj = new User();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $err = [];
    if (isset($password) && !empty($password)) {
        $userObj->password = $password;
    } else {
        $err['msg'] = 1;
    }
    if (isset($email) && !empty($email)) {
        $userObj->email = $email;
    } else {
        $err['msg'] = 1;
    }
    if (count($err) == 0) {
        $res = $userObj->login();
        if ($res) {
        } else {
            $err['msg'] = "Invalaid Credentials!!!";
        }
    } else {
        $err['msg'] = "Enter correct details!!!!";
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
        <?php if (isset($message)) { ?>
            <div class="message">
                <?php echo $message; ?>
            </div>
        <?php } ?>
        <?php if (isset($err['msg'])) { ?>
            <div class="message">
                <?php echo $err['msg']; ?>
            </div>
        <?php } ?>
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