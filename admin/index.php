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
        $AdminObj->email = htmlspecialchars(trim($_POST['email']));
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
    <!-- <link rel="stylesheet" href="style/admin1.css"> -->

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body,
        html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f0f0f0;
        }

        .head {
            padding: 10px 0;
        }

        .error {
            color: red;
        }

        .text {
            margin: 15px 0;

        }

        form {
            width: 275px;
        }

        .form-group {
            margin: 8px 0px;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #d9d9d9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        input[type='email'],
        input[type='password'] {
            padding: 3px 5px;
            width: 90%;
            margin: 5px 0;
            border: none;
            background: none;
            border-bottom: 2px solid #000;
            outline: none;
        }

        .btn {
            width: 90%;
            height: 30px;
            background: #d13cd1;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .btn:hover {
            background: #a521a5;
        }
    </style>
</head>

<body>
    <div class='container'>
        <form action="" id="loginForm" method="post" novalidate>
            <div class="head">
                <h2> Admin Login Panel</h2>
            </div>
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
               
                <input type="password" class="form-control pw" placeholder="Password:" name="password" id="pwd" required>
                
            </div>
            <button type="submit" class="btn" name="submit">Submit</button>
        </form>
    </div>
    </div>

   
</body>

</html>