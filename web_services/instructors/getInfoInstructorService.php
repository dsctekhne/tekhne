<?php
  $id_instructor =  $_GET["id_instructor"];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Instructor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $instructor = new Instructor($db);
  $result = $instructor->getInfoInstructor($id_instructor);
  $num = $result->rowCount();
  if($num > 0){
    $instructor_arr = array();
    $instructor_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $instructor_row = array(
        'name' => $name,
        'paternal_surname' => $paternal_surname,
        'maternal_surname' => $maternal_surname,
        'information' => $information
      );
      // push to data
      array_push($instructor_arr['data'], $instructor_row);
    }
    echo json_encode($instructor_arr);
  } else {
    echo json_encode(
      array('message' => 'not found')
    );
  }
?>