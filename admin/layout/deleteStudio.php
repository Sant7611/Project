<?php
$id = $_GET['id'];

include('../class/studio.class.php');
$studioObj = new Studio();
$studioObj->set('id', $id);
$status = $studioObj->delete();
@session_start();
if ($status == $id) {
  $_SESSION['message'] = 'studio Deleted Successfully!';
  header('location:listStudio.php');
} else {
  $_SESSION['message'] = "Failed To Delete studio!";
  header('location:listStudio.php');
}
