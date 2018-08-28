<?php
  $id_speaker = $_GET['id_speaker'];
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Speaker.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $speaker = new Speaker($db);
  $result = $speaker->deleteSpeaker($id_speaker);
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