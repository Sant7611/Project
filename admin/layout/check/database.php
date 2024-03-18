<?php

$server_name = "localhost";

$user_name = "root";

$password = "";

$db = "anidb";

$conn = mysqli_connect($server_name, $user_name, $password, $db);

if (!$conn) {

    die("Connection failed: " . mysqli_connect_error());
}
