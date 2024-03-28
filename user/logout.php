<?php
session_start();
session_destroy();
setcookie('uname', '', time() - 60 *60);

header('location:../index.php');