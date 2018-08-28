<?php
  $id_instructor = $_GET['id_instructor'];
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Instructor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $instructor = new Instructor($db);
  $result = $instructor->deleteInstructor($id_instructor);
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