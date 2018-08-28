<?php
  $control_number =  $_GET["control_number"];
  $id_workshop = $_GET["id_workshop"];
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->registerWorkshop($control_number, $id_workshop);
  $num = $result->rowCount();
?>