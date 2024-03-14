<?php
@session_start();
$id = $_GET['id'];
include('../class/source.class.php');
$sourceObj = new Source();
$sourceObj->set('id', $id);
try{

  $status = $sourceObj->delete();
}catch(mysqli_sql_exception $e){
if ($status == 'success') {
  $_SESSION['message'] = 'Source Deleted Successfully!';
  header('location:listSource.php');
}
  header('location:listSource.php?msg=Failed To Delete Source!');
}
