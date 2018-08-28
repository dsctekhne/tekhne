<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php require_once "styles.php"; ?>
  <title>Tékhne | Registro Correcto</title>
</head>
<body>
  <div class="container-fluid">
    <?php require_once "navbar.php"; ?>
    <div class="columns" id="content-signup">
      <h1 class="has-text-centered is-size-1 has-text-primary">¡Felicidades!</h1>
    </div>
  </div>
  <footer class="footer-section">
    <br>
    <img src="images/logo.png" alt="tekhne" class="img-footer">
    <p class="has-text-centered">¿Dudas? puedes un enviar email a: <span class="has-text-primary">tekhne.itm@gmail.com</span></p>
  </footer>
  <?php require_once "modal_login_user.php"; ?>
  <?php require_once "scripts.php"; ?>
  <script src="js/signup.js"></script>
</body>
</html>