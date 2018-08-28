<?php
  $control_number = $_GET['control_number'];
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->deleteAssistant($control_number);
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