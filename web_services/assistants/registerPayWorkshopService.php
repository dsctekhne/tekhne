<?php
  $control_number = $_GET['control_number'];
  $id_workshop = $_GET['id_workshop'];
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Assistant.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  $assistant = new Assistant($db);
  $result = $assistant->registerPaymentWorkshop($control_number, $id_workshop);
  $num = $result->rowCount();
  if($num > 0){
    // send email
    $name_student = '';
    $mail_student = '';
    $title_workshop = '';
    $assistant = new Assistant($db);
    $result = $assistant->getInfoAssistant($control_num);
    $num = $result->rowCount();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $name_student = $name.' '.$paternal_surname.' '.$maternal_surname;
    }
    $workshop = new Workshop($db);
    $result = $workshop->getInfoWorkshop($id_workshop);
    $num = $result->rowCount();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $title_workshop = $title;
    }
    $asunto = '¡Felicidades '.$name_student.'!, se ha registrado correctamente tu pago al taller: '.$title_workshop;
    $headers = 'MIME-Version: 1.0\r\n';
    $headers .= 'Content-type text/html; charset=iso-8859-1\r\n';
    $headers .= "From: Pago registrado | Tekhne <tekhne@isvoba.com>";
    $exito = mail("mtzggabriel@gmail.com","Pago registrado | Tekhne",$content,$headers);
    if($exito) {
      echo 'bien hecho!';
    } else {
      echo ':c';
    }
    echo json_encode(
      array('message' => 'correct')
    );
  } else {
    echo json_encode(
      array('message' => 'incorrect')
    );
  }
?>