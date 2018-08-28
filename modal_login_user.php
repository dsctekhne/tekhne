<div class="modal" id="modal_signin">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title has-text-centered">Inicio de Sesión</p>
      <button class="delete" aria-label="close" id="button-close-modal-signin"></button>
    </header>
    <section class="modal-card-body">
      <form class="form" action="login.php" method="post">
        <div class="field">
          <label class="label" for="control_number">Número de Control</label>
          <div class="control has-icons-left">
            <input id="control-number-login" class="input is-info" type="number" name="control_number" placeholder="Introduce tu número de control" required="required" maxlength="8">
            <span class="icon is-small is-left">
              <i class="fas fa-id-card"></i>
            </span>
          </div>
          <p class="help" id="help-control-login"></p>
        </div>
        <div class="field">
          <label class="label" for="pass">Contraseña</label>
          <div class="control has-icons-left">
            <input id="password-login" class="input is-info" type="password" name="pass" placeholder="Introduce tu contraseña" required="required">
            <span class="icon is-small is-left">
              <i class="fas fa-key"></i>
            </span>
          </div>
          <p class="help" id="help-password-login"></p>
        </div>
        <div class="filed">
          <div class="control">
            <input type="submit" class="button is-info has-text-centered" style="width:100%;" value="Iniciar Sesión" id="button-login">
          </div>
        </div>
      </form>
    </section>
    <footer class="modal-card-foot has-text-centered">
      <a class="has-text-info" href="signup.php">¿Aún no tienes cuenta? Regístrate</a>
    </footer>
  </div>
</div>