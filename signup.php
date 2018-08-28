<?php
include_once 'config/Database.php';
include_once 'models/Career.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$career = new Career($db);
$result = $career->getActiveCareers();
$num = $result->rowCount();
?>
<?php session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <?php require_once "styles.php"; ?>
  <title>Registro</title>
  <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
</head>
<body>
  <div class="container-fluid">
    <?php require_once "navbar.php"; ?>
    <br>
    <div class="columns" id="content-signup">
      <div class="column is-10 is-offset-1">
        <h1 class="has-text-centered is-size-1"><i class="fas fa-user-plus"></i>&nbspRegistro</h1>
      </div>
    </div>
    <form class="form" action="web_services/assistants/signupAssistant.php" method="post" id="form-signup">
      <!-- Control Number -->
      <div class="field">
        <label class="label" for="control_number"><span class="has-text-danger">*</span>Número de Control:</label>
        <div class="control has-icons-left">
          <input name="control_number" id="input-control-number" class="input" type="text" placeholder="Ingresa tu número de control" required="required"
          pattern="[0-9]{8}" maxlength="8" minlength="8">
          <span class="icon is-small is-left">
            <i class="fas fa-id-card"></i>
          </span>
        </div>
        <p class="help" id="help-control-number-signup"></p>
      </div>
      <!-- Name -->
      <div class="field">
        <label class="label" for="name"><span class="has-text-danger">*</span>Nombre:</label>
        <div class="control has-icons-left">
          <input type="text" name="name" class="input" placeholder="Ingresa tu nombre" required="required" maxlength="50"
          pattern="[a-zA-ZÀ-ž\s]+">
          <span class="icon is-small is-left">
            <i class="fas fa-user"></i>
          </span>
        </div>
      </div>
      <div class="field-body">
        <div class="field">
          <label class="label" for="paternal_surname"><span class="has-text-danger">*</span>Apellido Paterno:</label>
          <div class="control has-icons-left">
            <input type="text" name="paternal_surname" class="input" placeholder="Ingresa tu apellido paterno" required="required" maxlength="30"
            pattern="[a-zA-ZÀ-ž\s]+">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
        </div>
        <div class="field">
          <label class="label" for="maternal_surname"><span class="has-text-danger">*</span>Apellido Materno:</label>
          <div class="control has-icons-left">
            <input type="text" name="maternal_surname" class="input" placeholder="Ingresa tu apellido materno" required="required" maxlength="30"
            pattern="[a-zA-ZÀ-ž\s]+">
            <span class="icon is-small is-left">
              <i class="fas fa-user"></i>
            </span>
          </div>
        </div>
      </div>
        <div class="field" style="margin-top: 1%;">
          <label class="label" for="email"><span class="has-text-danger">*</span>Correo:</label>
          <div class="control has-icons-left">
            <input type="email" name="email" class="input" placeholder="Ingresa tu correo" required="required" maxlength="50">
            <span class="icon is-small is-left">
              <i class="fas fa-envelope"></i>
            </span>
          </div>
        </div>
        <div class="field is-6" style="margin-top: 1%;";>
          <label class="label" for="id_career"><span class="has-text-danger">*</span>Carrera:</label>
          <div class="control has-icons-left">
            <div class="select">
              <select name="id_career" required="required">
                <option value="" disabled selected>-- Selecciona tu carrera --</option>
                <?php
                if($num > 0){
                  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo '
                      <option value="'.$id_career.'">
                      '.$name.'
                      </option>
                    ';
                  }
                } else {
                  echo '<option value="" disabled>No hay carreras disponibles</option>';
                }
                ?>
              </select>
            </div>
            <span class="icon is-small is-left">
              <i class="fas fa-user-graduate"></i>
            </span>
          </div>
        </div>
        <label class="label" for="password"><span class="has-text-danger">*</span>Contraseña:</label> 
      <div class="field has-addons">
        <p class="control is-expanded has-icons-left">
          <input type="password" name="password" class="input" placeholder="Ingresa tu contraseña" required="required" maxlength="20" 
            pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" title="(Mínimo: 8 caracteres, máximo: 20 caracteres) Debe contener al menos una letra minúscula, una máyuscula y un dígito"
            id="password-signup">
          <span class="icon is-small is-left">
            <i class="fas fa-key"></i>
          </span>
        </p>
        <p class="control">
          <a class="button" id="reveal-password">
            <i class="fas fa-eye"></i>
          </a>
        </p>
      </div>
      <p class="help is-link">La contraseña debe constar de al menos 8 caracteres, al menos una letra mayúscula, una letra minúscula y un dígito.</p>
      <br>
      <div class="field">
        <input type="submit" value="Registrarse" class="button is-info button-form" id="button-signup">
      </div>
      <p>Los campos marcados con un <span class="has-text-danger">*</span> son obligatorios.</p>
    </form>
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