<?php
  $id_conference = $_GET['id_conference'];
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Conference.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $conference = new Conference($db);
  $result = $conference->deleteConference($id_conference);
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