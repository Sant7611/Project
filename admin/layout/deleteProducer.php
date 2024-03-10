<?php
@session_start();
$id = $_GET['id'];
include('../class/producer.class.php');
$producerObj = new Producer();
$producerObj->set('id', $id);
$status = $producerObj->delete();
if ($status == 'success') {
  $_SESSION['message'] = 'producer Deleted Successfully!';
  header('location:listProducer.php');
} else {
  echo $status;
  $_SESSION['message'] = "Failed To Delete producer!";
  header('location:listProducer.php');
}
