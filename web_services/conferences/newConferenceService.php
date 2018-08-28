<?php
  $title = $_POST['title'];
  $hour = $_POST['hour'];
  $date = $_POST['date'];
  $place = $_POST['place'];
  $id_speaker= $_POST['id_speaker'];
  include_once '../../config/Database.php';
  include_once '../../models/Conference.php';
  //Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $conference = new Conference($db);
  $conference->setTitle(mb_strtoupper($title));
  $conference->setHour($hour);
  $conference->setDate($date);
  $conference->setPlace(mb_strtoupper($place));
  $conference->setIdSpeaker($id_speaker);
  $conference->newConference();
  // $assistant = new Assistant($db);
  // $result = $assistant->getAllConferencesAssRe();
  // $num = $result->rowCount();
  // if($num > 0) {
  //   while($row = $result->fetch(PDO::FETCH_ASSOC)) {
  //     extract($row);
  //     $assistant2 = new Assistant($db);
  //     $assistant2->updateConferencesAssRe($scontrol_number);
  //   }
  // } else {

  // }
  // echo json_encode(
  //   array('message' => 'correct')
  // );
  echo '<script type="text/javascript">
           window.location = "../../admin/views/dashboard.php"
        </script>';
?>