<?php
  $id_conference = $_GET['id_conference'];
  $title = $_GET['title'];
  $hour = $_GET['hour'];
  $date = $_GET['date'];
  $place = $_GET['place'];
  $id_speaker= $_GET['id_speaker'];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Conference.php';
  include_once '../../models/Speaker.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $conference = new Conference($db);
  $result = $conference->editConference(
    $id_conference,
    mb_strtoupper($title),
    $hour,
    $date,
    mb_strtoupper($place),
    $id_speaker
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