<?php
include('../admin/class/user.class.php');

$userObj = new User();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $remember = isset($_POST['remember']) ? $_POST['remember'] : null;
  $password = $_POST['password'];
  $err = [];
  if (isset($password) && !empty($password)) {
    $userObj->password = $password;
    if (isset($email) && !empty($email)) {
      $userObj->remember = $remember;
      $userObj->email = $email;

      $userObj->login();
      
    } 
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
    <form action="" id="loginForm" method="post" novalidate>
      <?php if (isset($_SESSION['status'])) { ?>
        <p class="success"> <?php echo $_SESSION['status']; unset($_SESSION['status']) ?> </p>
      <?php } ?>
      <div class="title">Login</div>
      <span class="inputs">
        <span class="inputf">
          <input type="text" name="email" id="email" class="input" placeholder="Email" required />
          <span class="label">Email</span>
          <span class="material-icons icon">account_circle</span>
        </span>
        <span class="inputf">
          <input type="password" name="password" id="pwd" class="input" placeholder="Password" required />
          <span class="label">Password</span>
          <span class="material-icons icon">lock</span>
        </span>
      </span>
      <div class="links">
        <a href="#">Forgot Password</a>
        <label>
          <input type="checkbox" name="remember" value="1" id="remember" />
          Remember Me
        </label>
      </div>
      <button type="submit" name="submit" id="submit" value="submit" class="btn">
        <span>Login</span>
      </button>
      <div class="text">
        New user? Create an account <a href="signup.php">Sign Up</a>
      </div>
    </form>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#submit').click(function(e) {

        var email = $('#email');
        var pwd = $('#pwd');
        $('.msg').remove();
        var errors = [];

        email.css('border-color', '');
        pwd.css('border-color', '');


        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.val())) {
          $(email).css("border-color", 'red');
          errors.push({
            'key': 'email',
            'msg': '<span class="msg">Please enter a valid email address</span>'
          });
          // return;
        }

        if (pwd.val().trim() === '') {
          $(pwd).css("border-color", 'red');
          errors.push({
            'key': 'pwd',
            'msg': '<span class="msg">Please enter your password</span>'
          });
        }

        console.log(errors);
        if (errors.length > 0) {
          $.each(errors, (key, value) => {
            $(value.msg).insertAfter('#' + value.key)
          });
          e.preventDefault();
        }
        
        $('#loginForm').submit();
      });


    });
  </script>

</body>

</html>