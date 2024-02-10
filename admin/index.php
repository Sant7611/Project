<?php
@session_start();
if (array_key_exists('username', $_SESSION) && array_key_exists('username', $_COOKIE)) {
    header('Location:layout/dashboard.php');
}
include('class/user.class.php');
$UserObj = new User();
$error = [];

if (isset($_POST['submit'])) {
    print_r($_POST);

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $UserObj->email = $_POST['email'];
    } else {
        $error['email'] = "Please enter your email!!";
    }
    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $UserObj->password = $_POST['password'];
    } else {
        $error['password'] = "Please enter your password!!";
    }
    if (count($error) < 1) {
        $status = $UserObj->Login();
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
        <form action="" method="post">
            <?php
            if (isset($status)) {
                echo "<div >$status</div>";
            }
            ?>
            <div class="form-group">
                <input type="email" placeholder="Email:" name="email" id="email" required>

                <input type="password" placeholder="Password:" name="password" id="pwd" required>
                <input type="submit" value="submit" class="btn">
            </div>
            <div class="text">
                <p>Forgot password? <a href="reset_pwd.php"> Click here</a></p>
                <p>Don't have an account? <a href="signup.php"> Create one</a></p>
            </div>
        </form>
    </div>
    <style>
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

</body>

</html>
<?php
// include 'footer.php';


// if (isset($_POST['submit'])) {
//     $user = $_POST['uname'];
//     $pwd = $_POST['pwd'];

//     $query = "Select * from admin where uname = '$user' and pwd = '$pwd' ";
//     $run = mysqli_query($conn, $query);

//     $row = mysqli_num_rows($run);
//     if ($row == 1) {
//         $_SESSION['Login_success'] = 1;
//         echo "success";
//     } else {
//         echo "Wrong";
//     }
// }
?>