<?php
@session_start();
if (array_key_exists('username', $_SESSION) && array_key_exists('username', $_COOKIE)) {
    
}else{
    header('location:../index.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>Admin Panel</title>

    <!-- custom js  -->
    <script src="../js/jquery/admin1.js"></script>

    <!-- font awesome icone  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-3sV+0JmrvsEuFv4EnHW5oB4rbqL/UQX5bZtM+xLELPR2w23t4XTtOHcbObiOTwGP" crossorigin="anonymous"> -->

    <!-- material icon  -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- jquery  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <!-- google font  -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Custom css  -->
    <link rel="stylesheet" href="../style/admin1.css">

</head>

<body>
    <?php include('./sidebar.php') ?>
    <nav>
        <div class="navbar">
            <div class="logo">
                <img src="../images/animeimg1.jpg" style="height:50px; width:50px;" alt="">
            </div>
            <span class="title">Admin Panel</span>
            <div>
                <div class="dropdown">
                    <div class="profile navbar">
                        <span>Admin</span>
                        <span class="material-icons-outlined" style="color: #000;">account_circle</span>
                        <span class="material-icons-outlined toggle">expand_less</span>
                    </div>

                    <ul class="dropdown-content user">
                        <li class="vcenter">
                            <span class="material-icons-outlined">logout</span>
                            <a href="logout.php"> Logout</a>
                        </li>
                        <li class="vcenter"><span class="material-icons-outlined">change_circle</span> <a href="changepw.php">Change Password</a> </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>