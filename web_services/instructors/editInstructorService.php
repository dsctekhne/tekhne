<?php
  $id_instructor = $_GET['id_instructor'];
  $name = $_GET['name'];
  $paternal_surname = $_GET['paternal_surname'];
  $maternal_surname = $_GET['maternal_surname'];
  $information = $_GET['information'];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Instructor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $instructor = new Instructor($db);
  $result = $instructor->editInstructor(
    $id_instructor,
    mb_strtoupper($name),
    mb_strtoupper($paternal_surname),
    mb_strtoupper($maternal_surname),
    $information
  );
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