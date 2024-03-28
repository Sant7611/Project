<?php
include('../admin/class/user.class.php');

if (isset($_POST["submit"])) {
  $uname = $_POST['username'];
  $pass1 = $_POST['pwd1'];
  $pass2 = $_POST['pwd2'];
  $email = $_POST['email'];
  $err = [];

  $userObj = new User();

  if (isset($uname) && !empty($uname)) {
    $userObj->username =  $uname;
    if (isset($email) && !empty($email)) {
      $userObj->email = $email;
      if ((isset($pass1) && !empty($pass1))) {
        if (isset($pass2) && !empty($pass2)) {
          if ($pass1 == $pass2) {
            $userObj->password = $pass1;
            try {
              $res = $userObj->signup();
              header('location: login.php/message=Signup Successful. Please Login to continue');
            } catch (mysqli_sql_exception $e) {
              $err['msg'] = "Not available username or email!! Try another";
            }
          } else {
            $err['msg'] = "Password doesn't match!";
          }
        } else {
          $err['msg'] = "Please confirm your password  !";
        }
      } else {
        $err['msg'] = "Please enter your password  !";
      }
    } else {
      $err['msg'] = "Please enter your email  !";
    }
  } else {
    $err['msg'] = 'Please Enter Your Full Name!';
  }
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Otaku Oasis | Signup Form</title>
  <link rel="stylesheet" href="sign.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />

  <link rel="stylesheet" href="style/styl.css">

</head>

<body>
  <div class="center">
    <form action="" method="post" novalidate>
      <div class="title">Signup</div>
      <?php if (isset($err['msg'])) { ?>
        <p class="msg"> <?php echo $err['msg'];  ?> </p>
      <?php } ?>
      <span class="inputs">
        <span class="inputf">
          <input type="text" class="input" name="username" placeholder="Full Name" required />
          <span class="label">Full Name</span>
          <span class="material-icons icon">account_circle</span>
        </span>
        <span class="inputf">
          <input type="email" name="email" class="input" placeholder="Email" required />
          <span class="label">Email</span>
          <span class="material-icons icon">email</span>
        </span>
        <span class="inputf">
          <input type="password" name="pwd1" class="input" placeholder="Password" required />
          <span class="label">Password</span>
          <span class="material-icons icon">lock</span>
        </span>
        <span class="inputf">
          <input type="password" name="pwd2" class="input" placeholder="Confirm Password" required />
          <span class="label">Confirm Password</span>
          <span class="material-icons icon">lock</span>
        </span>
      </span>
      <button type="submit" value="submit" name="submit" class="btn">
        <span>Signup</span>
      </button>
      <div class="text">Already have an account? <a href="index.php">Login</a>
      </div>
    </form>
  </div>
</body>

</html>