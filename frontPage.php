<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>

    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

        .main{
            padding: 0 20px;
        }

        .container{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .form{
            height: 400px;
            width: 300px;
            border: 1px solid #ddd;
            padding: 5px 10px;
        }

        .form-title{
            text-align: center;
        }

        .formInput{
            padding: 5px 0;
        }

        input[type="text"], input[type="password"]{
            height: 25px;
    width: 100%;
    padding: 5px;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="container">
            <div class="form">
                <div class="form-title">
                    <h2>User Login Form</h2>
                </div>
                <form action="" class="inputForm">
                    <div class="formInput">
                        <!-- <label for="username">Email:</label> -->
                        <input type="text" id="email" placeholder="Email">
                    </div>
                    <div class="formInput">
                        <!-- <label for="pwd">Password:</label> -->
                        <input type="password" id="pwd" placeholder="Password">
                    </div>
                    <div class="forgetpwd">
                        <span>Forgot Password?</span>
                    </div>
                    <div class="formInput">
                        <input type="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>