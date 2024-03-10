<?php
@session_start();
if (array_key_exists('username', $_SESSION) && array_key_exists('username', $_COOKIE)) {
    header('Location:layout/dashboard.php');
}
include('class/admin.class.php');
$AdminObj = new Admin();
$error = [];

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $AdminObj->email = $_POST['email'];
    } else {
        $error['msg'] = "Cannot be left empty!!";
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $AdminObj->password = $_POST['password'];
    } else {
        $error['msg'] = "Cannot be left empty!!";
    }
    if (count($error) < 1) {
        $status = $AdminObj->Login();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel-login</title>
    <script src="js/admin1.js"></script>
    <link rel="stylesheet" href="style/admin1.css">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">


</head>

<body>

    <div class="container">
        <div class="head">
            <h2> Admin Login Panel</h2>
        </div>
        <form action="" id="loginForm" method="post" novalidate>
            <?php
            if (isset($status)) {
                echo "<label class='error' >$status</label>";
            }
            ?>
            <?php if (isset($error['msg']) && !empty($error['msg'])) { ?>
                <label class="error"><?php echo $error['msg']; ?></label>
            <?php } ?>
            <div class="form-group">
                <input type="email" placeholder="Email:" class="form-control" name="email" id="email" required>
            </div>
            <div class="form-group">
                <div class="toggle-password">
                    <input type="password" class="form-control pw" placeholder="Password:" name="password" id="pwd" required>
                    <span class="material-icons-outlined  eye">visibility</span>
                </div>
            </div>
            <!-- <input type="submit" name="submit"  class="btn"> -->
            <button type="submit" class="btn" name="submit">Submit</button>
            <div class="text">
                <p>Forgot password? <a href="reset_pwd.php"> Click here</a></p>
                <p>Don't have an account? <a href="signup.php"> Create one</a></p>
            </div>
        </form>
    </div>
    <style>
        .error {
            color: red;
        }

        .text {
            margin: 15px 0;

        }

        .form-group {
            margin: 8px 0px;
        }


        .container {
            margin: auto;
            padding: 10px;
            height: 18rem;
            width: 16rem;
            transform: translate(-50%, -50%);
            position: absolute;
            left: 50%;
            top: 50%;
            background-color: #d9d9d9;
            text-align: center;
        }
    </style>
    <script src="js/jqueryt/jquery.validate.min.js"></script>
    <script src="js/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').validate();
        })
    </script>
</body>

</html>