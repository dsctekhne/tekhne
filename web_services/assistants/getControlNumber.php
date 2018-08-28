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
  $result = $assistant->getControlNumbers();
  $num = $result->rowCount();
  if($num > 0){
    $assistant_arr = array();
    $assistant_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      if($control_number_req ==  $control_number) {
        echo json_encode(
          array('message' => 'found')
        );
        return;
      }
    }
    echo json_encode(
      array('message' => 'not found')
    );
  } else {
    echo json_encode(
      array('message' => 'not found')
    );
  }
?>