<?php
  $name = $_POST['name'];
  $paternal_surname = $_POST['paternal_surname'];
  $maternal_surname = $_POST['maternal_surname'];
  $information = $_POST['information'];
  include_once '../../config/Database.php';
  include_once '../../models/Instructor.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $instructor = new Instructor($db);
  $instructor->setName(mb_strtoupper($name));
  $instructor->setPaternalSurname(mb_strtoupper($paternal_surname));
  $instructor->setMaternalSurname(mb_strtoupper($maternal_surname));
  $instructor->setInformation($information);
  $instructor->newInstructor();
  // echo json_encode(
  //   array('message' => 'correct')
  // );
  echo '<script type="text/javascript">
           window.location = "../../admin/views/dashboard.php"
        </script>';
?>