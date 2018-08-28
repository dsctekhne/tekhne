<?php
  $name = $_POST['name'];
  $paternal_surname = $_POST['paternal_surname'];
  $maternal_surname = $_POST['maternal_surname'];
  $information = $_POST['information'];
  include_once '../../config/Database.php';
  include_once '../../models/Speaker.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $speaker = new Speaker($db);
  $speaker->setName(mb_strtoupper($name));
  $speaker->setPaternalSurname(mb_strtoupper($paternal_surname));
  $speaker->setMaternalSurname(mb_strtoupper($maternal_surname));
  $speaker->setInformation($information);
  $speaker->newSpeaker();
  // echo json_encode(
  //   array('message' => 'correct')
  // );
  echo '<script type="text/javascript">
           window.location = "../../admin/views/dashboard.php"
        </script>';
?>