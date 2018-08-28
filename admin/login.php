<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- styles -->
  <!-- Bulma CSS -->
  <link rel="stylesheet" href="../css/bulma-steps.css">
  <link rel="stylesheet" href="../css/bulma-badge.min.css">
  <link rel="stylesheet" href="../libs/bulma/bulma.css">
  <!-- Fontawesome -->
  <link rel="stylesheet" href="../libs/fontawesome/web-fonts-with-css/css/fontawesome-all.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Quicksand" rel="stylesheet">
  <!-- Custom styles -->
  <link rel="stylesheet" href="../css/styles.css">
  <link rel="stylesheet" href="css/admin-login.css">
  <script src="../libs/jquery/jquery-3.3.1.js"></script>
  <title>Tekhne | Administrador</title>
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
</head>
<body>
  <header id="main-head" style="height: 100vh;">
    <div id="main-content">
      <img class="img-login" src="../images/logo.svg" alt="tekhne">
      <form action="views/loginAdmin.php" method="post" class="has-text-white">
        <div class="field">
          <label class="has-text-white label" for="username">Usuario</label>
          <div class="control has-icons-left">
            <input class="input is-primary" type="text" name="username" 
              placeholder="Introduce tu número de control" 
              required="required" maxlength="50">
            <span class="icon is-small is-left">
              <i class="fas fa-id-card"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <label class="has-text-white label">Contraseña:</label>
          <div class="control has-icons-left">
            <input class="input is-primary" type="password" name="password" 
              placeholder="Introduce tu contraseña" required="required">
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
        </div>
        <input type="submit" class="button is-info" value="Iniciar Sesión"
          style="width: 100%;">
      </form>
    </div>
  </header>
  <!-- Particles JS -->
  <script src="../libs/particlesjs/particles.js"></script>
  <script src="../libs/particlesjs/particles.min.js"></script>
  <script src="../libs/particlesjs/app.js"></script>
</body>
</html>