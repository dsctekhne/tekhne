<?php
  $control_number =  $_GET["control_number"];
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->registerConferences($control_number);
  $num = $result->rowCount();
  echo '<script type="text/javascript">
           window.location = "../signup.php"
          </script>';
?>