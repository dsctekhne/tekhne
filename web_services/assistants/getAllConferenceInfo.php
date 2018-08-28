<?php
  $id_conference = $_GET['id_conference'];
  //Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->getAllConferenceInfo($id_conference);
  $num = $result->rowCount();
  if($num > 0){
    $conference_arr = array();
    $conference_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $conference_row = array(
        'id_conference' => $id_conference,
        'title' => $title,
        'control_number' => $cacontrol_number,
        'name' => $apaternal_surname.' '.$amaternal_surname.' '.$aname,
        'status' => $status
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