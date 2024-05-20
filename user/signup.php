<?php
include('../admin/class/user.class.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
    $uname = $_POST['username'];
    $pass1 = $_POST['pwd'];
    $pass2 = $_POST['pwd2'];
    $email = $_POST['email'];
    $err = [];

    $userObj = new User();

    if (!empty($uname) && !empty($email) && !empty($pass1) && !empty($pass2) && $pass1 === $pass2) {
        $userObj->username = $uname;
        $userObj->email = $email;
        $userObj->password = $pass1;
        try {
            $signupSuccess = $userObj->signup();
            if ($signupSuccess === true) {
                $err['msg'] = 'submitted';
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            $err['msg'] = "Database error: " . $e->getMessage();
        }
    } else {
        $err['msg'] = 'Please fill in all fields correctly.';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Otaku Oasis | Signup Form</title>
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="style/styl.css">
</head>

<body>
  <div class="center">
    <form id="signupForm" action="" method="post" novalidate>
      <div class="title">Signup</div>
      <?php if (isset($err['msg'])) { ?>
        <p class="msg"> <?php echo $err['msg']; ?> </p>
      <?php } ?>

      <?php if (isset($_SESSION['status'])) { ?>
        <p class="msg"> <?php echo $_SESSION['status'];
                        unset($_SESSION['status']); ?> </p>
      <?php } ?>
      <span class="inputs">
        <span class="inputf">
          <input type="text" class="input" id="username" name="username" placeholder="User Name" required />
          <span class="label">Full Name</span>
          <span class="material-icons icon">account_circle</span>
        </span>
        <span class="inputf">
          <input type="email" name="email" class="input" id="email" placeholder="Email" required />
          <span class="label">Email</span>
          <span class="material-icons icon">email</span>
        </span>
        <span class="inputf">
          <input type="password" name="pwd" class="input" id="pwd" placeholder="Password" required />
          <span class="label">Password</span>
          <span class="material-icons icon">lock</span>
        </span>
        <span class="inputf">
          <input type="password" name="pwd2" class="input" id="pwd2" placeholder="Confirm Password" required />
          <span class="label">Confirm Password</span>
          <span class="material-icons icon">lock</span>
        </span>
      </span>
      <button type="submit" value="submit" name="submit" id="submit" class="btn">
        <span>Signup</span>
      </button>
      <div class="text">Already have an account? <a href="login.php">Login</a>
      </div>
    </form>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#submit').click(function(e) {

        // e.preventDefault();

        var uname = $('#username');
        var email = $('#email');
        var pwd = $('#pwd');
        var pwd2 = $('#pwd2');

        uname.css("border-color", '');
        email.css("border-color", '');
        pwd.css("border-color", '');
        pwd2.css("border-color", '');
        $('.msg').remove();
        var errors = [];


        if (uname.val().trim() === '') {
          uname.css("border-color", 'red');
          errors.push({
            'key': 'username',
            'msg': '<span class="msg">Please enter your username</span>'
          });

        }


        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailPattern.test(email.val())) {
          $(email).css("border-color", 'red');
          errors.push({
            'key': 'email',
            'msg': '<span class="msg">Please enter a valid email address</span>'
          });

        }


        if (pwd.val().trim() === '' || pwd.val().trim().length <= 7) {
          $(pwd).css("border-color", 'red');
          errors.push({
            'key': 'pwd',
            'msg': '<span class="msg">Minimum 8 chatacters required</span>'
          });
        }

        if (pwd2.val().trim() === '' || pwd2.val().trim().length <= 7) {
          pwd2.css("border-color", 'red');
          errors.push({
            'key': 'pwd2',
            'msg': '<span class="msg">Minimum 8 chatacters required</span>'
          });

        } else {

          if (pwd.val() !== pwd2.val()) {
            pwd.css("border-color", 'red');
            pwd2.css("border-color", 'red');
            errors.push({
              'key': 'pwd2',
              'msg': '<span class="msg">Passwords don\'t match</span>'
            });
          }
        }
        if (errors.length > 0) {
          $.each(errors, (key, value) => {
            $(value.msg).insertAfter('#' + value.key);
          });
          return false;
        } else {
          $('#signupForm').submit();
        }
      });


    });
  </script>
</body>

</html>