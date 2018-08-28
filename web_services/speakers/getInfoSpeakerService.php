<?php
  $id_speaker =  $_GET["id_speaker"];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Speaker.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $speaker = new Speaker($db);
  $result = $speaker->getInfoSpeaker($id_speaker);
  $num = $result->rowCount();
  if($num > 0){
    $speaker_arr = array();
    $speaker_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $speaker_row = array(
        'name' => $name,
        'paternal_surname' => $paternal_surname,
        'maternal_surname' => $maternal_surname,
        'information' => $information
      );
      // push to data
      array_push($speaker_arr['data'], $speaker_row);
    }
    echo json_encode($speaker_arr);
  } else {
    echo json_encode(
      array('message' => 'not found')
    );
  }
?>