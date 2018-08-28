<?php
  $id_workshop =  $_GET["id_workshop"];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Workshop.php';
  include_once '../../models/Speaker.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $workshop = new Workshop($db);
  $result = $workshop->getInfoWorkshop($id_workshop);
  $num = $result->rowCount();
  if($num > 0){
    $workshop_arr = array();
    $workshop_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $workshop_row = array(
        'title' => $title,
        'quota' => $capacity,
        'id_instructor' => $id_instructor,
        'name' => $name,
        'paternal_surname' => $paternal_surname,
        'maternal_surname' => $maternal_surname,
      );
      // push to data
      array_push($workshop_arr['data'], $workshop_row);
    }
    echo json_encode($workshop_arr);
  } else {
    echo json_encode(
      array('message' => 'not found')
    );
  }
?>