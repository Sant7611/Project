<?php
include('../admin/class/user.class.php');
if (isset($_GET['message'])) {
  $message = $_GET['message'];
}
$userObj = new User();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $remember = $_POST['remember'];
  $password = $_POST['password'];

  $err = [];
  if (isset($password) && !empty($password)) {
    $userObj->password = $password;
  } else {
    $err['msg'] = 1;
  }
  if (isset($email) && !empty($email)) {
    $userObj->remember = $remember;
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
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Form</title>
  <link rel="stylesheet" href="style/styl.css">
  <!--Google Fonts and Icons-->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Round|Material+Icons+Sharp|Material+Icons+Two+Tone" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <!-- <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin /> -->
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
</head>

<body>
  <div class="center">
    <form action="login.php" method="post">
      <?php if (isset($message)) { ?>
        <p class="success"> <?php echo $message; ?> </p>
      <?php } ?>
      <?php if (isset($err['msg'])) { ?>
        <p class="msg"> <?php echo $err['msg']; ?> </p>
      <?php } ?>
      <div class="title">Login</div>
      <span class="inputs">
        <span class="inputf">
          <input type="text" name="email" class="input" placeholder="Email" />
          <span class="label">Email</span>
          <span class="material-icons icon">account_circle</span>
        </span>
        <span class="inputf">
          <input type="password" name="password" class="input" placeholder="Password" />
          <span class="label">Password</span>
          <span class="material-icons icon">lock</span>
        </span>
      </span>
      <div class="links">
        <a href="#">Forgot Password</a>
        <label for="remember">
          <input type="checkbox" name="remember" value="1" id="remember" />
          Remember Me
        </label>
      </div>
      <button type="submit" class="btn">
        <span>Login</span>
      </button>
      <div class="text">
        New user? Create an account <a href="signup.php">Sign Up</a>
      </div>
    </form>
  </div>
</body>

</html>