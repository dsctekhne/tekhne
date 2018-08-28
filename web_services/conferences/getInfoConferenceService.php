<?php
  $id_conference =  $_GET["id_conference"];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Conference.php';
  include_once '../../models/Speaker.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $conference = new Conference($db);
  $result = $conference->getInfoConference($id_conference);
  $num = $result->rowCount();
  if($num > 0){
    $conference_arr = array();
    $conference_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $conference_row = array(
        'title' => $title,
        'hour' => $hour,
        'date' => $date,
        'place' => $place,
        'id_speaker' => $id_speaker,
        'name' => $name,
        'paternal_surname' => $paternal_surname,
        'maternal_surname' => $maternal_surname,
      );
      // push to data
      array_push($conference_arr['data'], $conference_row);
    }
    echo json_encode($conference_arr);
  } else {
    echo json_encode(
      array('message' => 'not found')
    );
  }
?>