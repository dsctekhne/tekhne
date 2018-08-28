<?php
  $control_number_old = $_GET['control_number_old'];
  $control_number = $_GET['control_number'];
  $name = $_GET['name'];
  $paternal_surname = $_GET['paternal_surname'];
  $maternal_surname = $_GET['maternal_surname'];
  $email = $_GET['email'];
  $id_career = $_GET['id_career'];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->editAssistant(
    $control_number_old,
    $control_number,
    mb_strtoupper($name),
    mb_strtoupper($paternal_surname),
    mb_strtoupper($maternal_surname),
    $email,
    $id_career
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