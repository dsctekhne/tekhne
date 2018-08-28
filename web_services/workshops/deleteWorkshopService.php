<?php
  $id_workshop = $_GET['id_workshop'];
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Workshop.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $workshop = new Workshop($db);
  $result = $workshop->deleteWorkshop($id_workshop);
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