
<!-- navbar -->
<nav class="navbar is-transparent is-fixed-top" id="main-menu">
      <div class="container">
        <div class="navbar-brand">
          <span class="navbar-burger burger has-text-white" id="burger-icon-menu" data-target="nav-menu">
            <i class="fas fa-bars" style="margin: 30%;"></i>
          </span>
          <a href="index.php" class="navbar-item">
            <img src="images/logo.svg" alt="Tékhne">
          </a>
          <?php
            if(isset($_SESSION['id_assistant'])) {
              echo '
              <span class="navbar-burger burger has-text-white" id="btn-men-mobile" data-target="user-mobile-men">
              <i class="fas fa-user-circle" style="margin: 30%;"></i>
            </span>
              ';
            }
          ?>
        </div>
        <div class="navbar-menu" id="nav-menu">
          <div class="navbar-start">
            <a href="index.php#conferences-section" class="navbar-item has-text-centered has-text-white">Conferencias</a>
            <a href="index.php#workshops-section" class="navbar-item has-text-centered has-text-white">Talleres</a>
            <a href="index.php#help-section" class="navbar-item has-text-centered has-text-white">Ayuda</a>
          </div>
          <div class="navbar-end ">
            <?php 
              if(isset($_SESSION['id_assistant'])) {
                echo '
                  <script src="js/getInfoAssistant.js"></script>
                  <script>getInfo('.$_SESSION['id_assistant'].');</script>
                ';
                echo '
                  <div class="navbar-item">
                    <div class="dropdown is-right" id="user-icon-desktop">
                      <div class="dropdown-trigger has-text-warning">
                        <button class="button is-info" id="assistant-data-navbar" aria-haspopup="true" aria-controls="sub-menu-desktop"></button>
                      </div>
                      <div class="dropdown-menu" id="sub-menu-desktop" role="menu">
                        <div class="dropdown-content user-sub-menu">
                          <a href="yourconferences.php" class="has-text-white dropdown-item sub-menu-user">Tus conferencias</a>
                          <a href="yourworkshops.php" class="has-text-white dropdown-item sub-menu-user">Tus talleres</a>
                          <a href="logout.php" class="has-text-white dropdown-item sub-menu-user">Salir</a>
                        </div>
                      </div>
                    </div>
                  </div>
                ';
              } else {
                echo '
                <div class="navbar-item">
                  <a href="signup.php" class="navbar-item has-text-centered has-text-white" id="button-sign-up">Registrarse</a>
                </div>
                <div class="navbar-item">
                  <a class="button is-info button-sign-in">Iniciar Sesión</a>
                </div>
                ';
              }
            
            ?>
          </div>
        </div>
        <div class="navbar-menu disp-menu" id="user-mobile-men">
          <div class="navbar-start">
            <a href="yourconferences.php" class="has-text-white has-text-centered navbar-item sub-menu-user">Tus conferencias</a>
            <a href="yourworkshops.php" class="has-text-white has-text-centered navbar-item sub-menu-user">Tus talleres</a>
            <a href="logout.php" class="has-text-white has-text-centered navbar-item sub-menu-user">Salir</a>
          </div>
        </div>
      </div>
    </nav> 