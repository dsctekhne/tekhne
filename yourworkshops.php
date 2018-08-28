<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php require_once "styles.php"; ?>
  <title>Tus talleres</title>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
</head>
<body>
  <div class="container-fluid">
    <?php require_once "navbar.php"; ?>
    <?php
    include_once 'config/Database.php';
    include_once 'models/Assistant.php';
    // Instantiate DB & connect
    $database = new Database();
    $db = $database->connect();
    $assistant = new Assistant($db);
    $result = $assistant->getAllWorkshops2($_SESSION['id_assistant']);
    $num = $result->rowCount();
    ?>
    <div class="columns" id="content-signup">
      <div class="column is-10 is-offset-1">
        <h1 class="has-text-centered is-size-1"><i class="fas fa-graduation-cap"></i>&nbspTus Talleres</h1>
      </div>
    </div>
    <div class="event-container">
    <?php
    if($num > 0) {
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo '
        <div class="event-workshop" style="min-height: 320px;">
          <div class="event-icon">
            <img class="event-image" src="images/tickets_workshop.png" alt="tickets">    
          </div>
          <div class="event-content">
            <h4 class="has-text-centered is-size-4 has-text-weight-semibold	">
              '.$title.'
            </h4>
            <div class="event-info">
              <p>
                <i class="fas fa-calendar"></i>&nbsp&nbsp&nbsp
                <button class="button is-light button-modal_schedule" id="'.$id_workshop.'">Ver horario</button>
              </p>
              <p>
                <i class="fas fa-user"></i>&nbsp&nbsp&nbsp
                '.$iname.' '.$ipaternal_surname.' '.$imaternal_surname.'
              </p><br>';
              if($wastatus == 0) {
                echo '
                  <p>
                    Estatus: <span class="has-background-info has-text-white">Lista de espera</span>
                  </p>
                ';
              } else {
                echo '
                  <p>
                    Estatus: <span class="has-background-info has-text-white">Registrado</span>
                  </p>
                ';
              }
              
              echo '
            </div>
            <br>
          </div>
        ';
        echo '</div>';
          
      }
    } else {
      echo '<h2 class="has-text-centered is-size-3 has-text-info">Aún no tienes talleres registrados<h2>';
    }
    ?>
    </div>
  </div>
  
  <article class="message is-link" style="width:90%;margin-left:5%;float:none;clear:both">
    <div class="message-header" style="float:none;">
      <p>¡Atención!</p>
    </div>
    <div class="message-body has-text-centered" style="float:none;">
      <p>
      <b>Para asegurar el registro a los talleres es necesario realizar el(los) pago(s) correspondiente(s).</b>
      </p>
      <p>Si el estatus de tu taller es <b>'Lista de espera'</b>, debes realizar tu pago y presentar tu recibo bancario.</p>
      <p>Si el estatus de tu taller es <b>'Registrado'</b>, tu pago ha sido registrado correctamente.</p>
    </div>
  </article>
  <footer class="footer-section">
    <br>
    <img src="images/logo.svg" alt="tekhne" class="img-footer">
    <p class="has-text-centered">¿Dudas? puedes un enviar email a: <span class="has-text-info">contacto@dsctekhne.com</span></p>
  </footer>
  <div class="modal" id="modal_workshop_schedule">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Horario:</p>
      <button class="delete" id="button-close-mod-w" aria-label="close"></button>
    </header>
    <section class="modal-card-body" id="schedule-info">
    </section>
  </div>
</div>
<script src="js/modal_workshop_schedule.js"></script>
  <?php require_once "modal_login_user.php"; ?>
  <?php require_once "scripts.php"; ?>
  <script src="js/signup.js"></script>
</body>
</html>