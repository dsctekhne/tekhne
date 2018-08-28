<?php
  $control_number =  $_GET["control_number"];
  $id_workshop = $_GET["id_workshop"];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->isRegisteredAtWorkshop($control_number, $id_workshop);
  $num = $result->rowCount();
  if($num > 0){
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      if($total > 0) {
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