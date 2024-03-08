<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>Admin Panel</title>

    <!-- font awesome icone  -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-3sV+0JmrvsEuFv4EnHW5oB4rbqL/UQX5bZtM+xLELPR2w23t4XTtOHcbObiOTwGP" crossorigin="anonymous"> -->

    <!-- material icon  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


    <!-- google font  -->
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Custom css  -->
    <link rel="stylesheet" href="../style/admin1.css">

    <style>
        select option:selected {
            background-color: #000;
            /* Example background color */
            color: #fff;
            /* Example text color */
        }

        .marked {
            background-color: aquamarine;
            color: #000;
        }
    </style>
</head>

<body>
    <?php include('./sidebar.php') ?>
    <nav>
        <div class="navbar">
            <div class="logo">
                <img src="../images/65d704da399b1WIN_20200319_11_38_35_Pro.jpg" style="height:50px; width:50px;" alt="">
                <span class="material-symbols-outlined">
                    home
                </span>
            </div>
            <div class="profile">
                <ul>
                    <li><a href="logout.php">Logout</a></li>
                    <li><a href="changepw.php">Change Password</a></li>
                </ul>
            </div>
        </div>
    </nav>