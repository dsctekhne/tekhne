<?php
  $control_number = $_POST['control_number'];
  $name = $_POST['name'];
  $paternal_surname = $_POST['paternal_surname'];
  $maternal_surname = $_POST['maternal_surname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $id_career = $_POST['id_career'];
  // hash password
  $hash = password_hash($password, PASSWORD_BCRYPT);
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $assistant->setControlNumber($control_number);
  $assistant->setName(mb_strtoupper($name));
  $assistant->setPaternalSurname(mb_strtoupper($paternal_surname));
  $assistant->setMaternalSurname(mb_strtoupper($maternal_surname));
  $assistant->setEmail($email);
  $assistant->setPassword($hash);
  $assistant->setIDCareer($id_career);
  $assistant->newAssistant();
  // echo '<script type="text/javascript">
  //          window.location = "../../index.php"
  //       </script>';
  header("Location: ../../index.php");
?>