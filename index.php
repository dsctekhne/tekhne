<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php require_once "styles.php"; ?>
  <title>Tékhne | INICIO</title>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
</head>
<body>
  <div class="container-fluid">
    <?php require_once "navbar.php"; ?>
    <header id="main-head">
      <div id="main-content">
        <div id="main-title">
          <h1 class="text has-text-centered has-text-white is-size-1 is-size-3-mobile">
            Congreso Multidisciplinario en Ingeniería y Tecnologías para la Innovación 2018
          </h1>
          <div id="main-image">
            <img src="images/itm_logo.png" alt="ITM">
          </div>
        </div>
        
      </div>
    </header>
    <?php include 'conferences.php';?>
    <?php include 'workshops.php';?>
    <?php include 'help.php';?>
    <footer class="footer-section">
      <br>
      <img src="images/logo.svg" alt="tekhne" class="img-footer">
      <p class="has-text-centered">¿Dudas? puedes un enviar email a: <span class="has-text-info">contacto@dsctekhne.com</span></p>
    </footer>
  </div>
  <?php require_once "modal_login_user.php"; ?>
  <?php require_once "scripts.php"; ?>
  <!-- Particles JS -->
  <script src="libs/particlesjs/particles.js"></script>
  <script src="libs/particlesjs/particles.min.js"></script>
  <script src="libs/particlesjs/app.js"></script>
</body>
</html>