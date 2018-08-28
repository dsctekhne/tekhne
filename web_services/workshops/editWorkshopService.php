<?php
  $id_workshop = $_GET['id_workshop'];
  $title = $_GET['title'];
  $quota = $_GET['quota'];
  $id_instructor= $_GET['id_instructor'];
  $schedule = $_GET['schedule'];
  $arr_schedule = json_decode($schedule);
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Workshop.php';
  include_once '../../models/Instructor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $workshop = new Workshop($db);
  $result = $workshop->editWorkshop(
    $id_workshop,
    mb_strtoupper($title),
    $quota,
    $id_instructor,
    $arr_schedule
  );
  $num = $result->rowCount();
  if($num > 0){
    echo json_encode(
      array('message' => $result)
    );
  } else {
    echo json_encode(
      array('message' => $result)
    );
  }
?>