<?php
$token = $_GET['token'];
$conn = mysqli_connect('localhost', 'root', '', 'anidb');

$sql = "select token from users where email = ";