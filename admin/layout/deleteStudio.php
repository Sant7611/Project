<?php
@session_start();
$id = $_GET['id'];
include('../class/studio.class.php');
$studioObj = new Studio();
$studioObj->set('id', $id);
try{

  $status = $studioObj->delete();
}catch(mysqli_sql_exception $e){
if ($status == 'success') {
  $_SESSION['message'] = 'studio Deleted Successfully!';
  header('location:listStudio.php');
}
  header('location:listStudio.php?msg=Failed To Delete studio!!');

}