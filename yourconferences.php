<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php require_once "styles.php"; ?>
  <title>Tus conferencias</title>
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
    $result = $assistant->getAllConferences2($_SESSION['id_assistant']);
    $num = $result->rowCount();
    ?>
    <div class="columns" id="content-signup">
      <div class="column is-10 is-offset-1">
        <h1 class="has-text-centered is-size-1"><i class="fas fa-comment-alt"></i>&nbspTus Conferencias</h1>
      </div>
    </div>
    <div class="event-container">
    <?php
    if($num > 0) {
      while($row = $result->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        echo '
        <div class="event" style="min-height: 320px;">
          <div class="event-icon">
            <img class="event-image" src="images/tickets_normal.png" alt="tickets">    
          </div>
          <div class="event-content">
            <h4 class="has-text-centered is-size-4 has-text-weight-semibold	">
              '.$title.'
            </h4>
            <div class="event-info">
              <p>
                <i class="fas fa-calendar"></i>&nbsp&nbsp&nbsp
                '.$date.'
              </p>
              <p>
                <i class="fas fa-clock"></i>&nbsp&nbsp&nbsp
                '.$hour.'
              </p>
              <p>
                <i class="fas fa-map-marker"></i>&nbsp&nbsp&nbsp
                '.$place.'
              </p>
              <p>
                <i class="fas fa-user"></i>&nbsp&nbsp&nbsp
                '.$sname.' '.$spaternal_surname.' '.$smaternal_surname.'
              </p><br>';
              if($castatus == 0) {
                echo '
                <p>
                  Estatus: <span class="has-background-primary has-text-white">No registrado</span>
                </p>
                ';
              } else {
                echo '
                <p>
                  Estatus: <span class="has-background-primary has-text-white">Registrado</span>
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
      echo '<h2 class="has-text-centered is-size-3 has-text-info">Aún no tienes conferencias registradas<h2>';
    }
    ?>
    </div>
  </div>
  <footer class="footer-section">
    <br>
    <img src="images/logo.svg" alt="tekhne" class="img-footer">
    <p class="has-text-centered">¿Dudas? puedes un enviar email a: <span class="has-text-info">contacto@dsctekhne.com</span></p>
  </footer>
  <?php require_once "modal_login_user.php"; ?>
  <?php require_once "scripts.php"; ?>
  <script src="js/signup.js"></script>
</body>
</html>