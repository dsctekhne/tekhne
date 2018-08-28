<?php
  $id_workshop =  $_GET["id_workshop"];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Workshop.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $workshop = new Workshop($db);
  $result = $workshop->getSchedule($id_workshop);
  $num = $result->rowCount();
  if($num > 0){
    $workshop_arr = array();
    $workshop_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $workshop_row = array(
        'hour_start' => $hour_start,
        'hour_end' => $hour_end,
        'date' => $date,
        'place' => $place
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