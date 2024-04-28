<?php
session_start();
setcookie('uname', '', time() - 60 *60);
session_destroy();
header('location:../index.php');