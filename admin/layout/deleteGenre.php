<?php
$id = $_GET['id'];

include('../class/genre.class.php');
$genreObj = new Genre();
$genreObj->set('id', $id);
$status = $genreObj->delete();
@session_start();
if ($status == $id) {
  $_SESSION['message'] = 'Genre Deleted Successfully!';
  header('location:listGenre.php');
} else {
  $_SESSION['message'] = "Failed To Delete Genre!";
  header('location:listGenre.php');
}
