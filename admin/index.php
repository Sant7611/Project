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
    <title>Document</title>
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
            <?php if(isset($error['msg']) && !empty($error['msg'])) {?>
                <label class="error"><?php echo $error['msg'] ;?></label>
                <?php }?>
            <div class="form-group">
                <input type="email" placeholder="Email:" name="email" id="email" required>

                <input type="password" placeholder="Password:" name="password" id="pwd" required>
                <input type="submit" name="submit"  class="btn">
            </div>
            <div class="text"> 
                <p>Forgot password? <a href="reset_pwd.php"> Click here</a></p>
                <p>Don't have an account? <a href="signup.php"> Create one</a></p>
            </div>
        </form>
    </div>
    <style>
        .error{
            color:red;
        }
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        .btn {
            width: 5rem;
            background: #b3b2b2;
        }

        .btn:hover {
            background-color: #fff;
        }

        .text {
            margin-bottom: 15px;
        }

        .form-group {
            margin: 8px 0px;
        }

        input {
            width: 14rem;
            border-radius: 13px;
            height: 2rem;
            margin: 9px;
            padding: 6px;
        }

        .head {
            padding: 4px;
        }

        .error {
            color: red;
        }

        label {
            font-size: 1rem;
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
        $(document).ready(function(){
            $('#loginForm').validate();
        })
    </script>
</body>

</html>