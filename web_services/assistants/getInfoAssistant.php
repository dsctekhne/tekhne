<?php
  $control_number_req =  $_GET["controlnumber"];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->getInfoAssistant($control_number_req);
  $num = $result->rowCount();
  if($num > 0){
    $assistant_arr = array();
    $assistant_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $assistant_row = array(
        'name' => $name,
        'paternal_surname' => $paternal_surname,
        'maternal_surname' => $maternal_surname,
        'email' => $email ,
        'id_career' => $id_career
      );
      // push to data
      array_push($assistant_arr['data'], $assistant_row);
    }
    echo json_encode($assistant_arr);
  } else {
    echo json_encode(
      array('message' => 'not found')
    );
  }
?>