<?php
@session_start();
$id = $_GET['id'];
include('../class/producer.class.php');
$producerObj = new Producer();
$producerObj->set('id', $id);
try{
$status = $producerObj->delete();
}catch(mysqli_sql_exception $e){
if ($status == 'success') {
  $_SESSION['message'] = 'producer Deleted Successfully!';
  header('location:listProducer.php');
} 

  header('location:listProducer.php?msg=Failed To Delete producer!');
}
