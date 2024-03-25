<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Javascript Form</title>
    <script src="jquery.min.js"></script>
    <script>
       $(document).ready(function(){
           $('#username').keyup(function(){
               var uname = $('#username').val();
               if(uname.length < 6){
                   $('#usernameError').text("Minimum 6 character required");
               }else{
                   $('#usernameError').text("");
               }
           })
           $('#repassword').keyup(function(){
               var repass = $('#repassword').val();
               var pass = $('#password').val();
               if(repass == pass){
                $('#passwordError').text("")
               }else{
                $('#passwordError').text("Password Mismatch!")
               }
           })
       })
    </script> 
</head>
<body>
    <form action="" method="post" name="loginForm">
        <label for="username">Username:</label>
        <input type="text" name="username" id="username">
        <small id="usernameError" style="color:red;"></small>
        <br><br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password">
        <br><br>
        <label for="password">Confirm Password:</label>
        <input type="password" name="repassword" id="repassword">
        <small id="passwordError" style="color:red;"></small>
        <br><br>
        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>