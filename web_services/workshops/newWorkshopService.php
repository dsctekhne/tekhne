<?php
  $title = $_GET['title'];
  $quota = $_GET['capacity'];
  $id_instructor = $_GET['id_instructor'];
  $schedule = $_GET['schedule'];
  $arr_schedule = json_decode($schedule);
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Workshop.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $workshop = new Workshop($db);
  $workshop->setTitle(mb_strtoupper($title));
  $workshop->setQuota($quota);
  $workshop->setIdInstructor($id_instructor);
  $result = $workshop->newWorkshop($arr_schedule);
  $num = $result->rowCount();
  if($num > 0){
    echo json_encode(
      array('message' => 'correct')
    );
  } else {
    echo json_encode(
      array('message' => 'incorrect')
    );
  }

?>