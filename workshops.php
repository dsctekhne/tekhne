<?php
include_once 'config/Database.php';
include_once 'models/Workshop.php';
include_once 'models/Assistant.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$workshop = new Workshop($db);
$result = $workshop->getAllWorkshops();
$num = $result->rowCount();
?>
<div class="is-12 has-text-white has-text-centered" id="workshops-section" 
  style="float:left;width:100%;margin-bottom:2%;">   
  <h2 class="is-size-2">Talleres</h2>
</div>
<br>
<div class="event-container">
<?php
if($num > 0) {
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo '
    <div class="event-workshop">
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
            <i class="fas fa-users"></i>&nbsp&nbsp&nbsp
            Cupo: '.$capacity.'
          </p>';
          $assistant = new Assistant($db);
          $result2 = $assistant->getCurrentQuota($id_workshop);
          $num2 = $result2->rowCount();
          $total_registers = 0;
          while($row2 = $result2->fetch(PDO::FETCH_ASSOC)) {
            extract($row2);
            echo '
              <p>
                <i class="fas fa-users"></i>&nbsp&nbsp&nbsp
                Lugares disponibles: '.($capacity - $total_registers).'
              </p>
            ';
          }
          echo '
          <p>
            <i class="fas fa-user"></i>&nbsp&nbsp&nbsp
            '.$name.' '.$paternal_surname.' '.$maternal_surname.'
          </p>
        </div>
        <br>
      </div>
    ';
    if($capacity - $total_registers > 0) {
      if(isset($_SESSION['id_assistant'])) {
        echo '
          <button class="button is-info btn-event" style="width: 90%; margin-left: 5%;"
            id="t'.$id_workshop.'-'.$_SESSION['id_assistant'].'">
            Registrarse a este Taller
          </button>
        ';
      } else {
        echo '
          <button class="button is-info btn-event button-sign-in" style="width: 90%; margin-left: 5%;">
            Registrarse a este Taller
          </button>
        ';
      }
    }
    echo '</div>';
  }
} else {
  echo '<h2 class="has-text-centered is-size-3">Aún no hay talleres disponibles.</h2>';
}
?>
</div>
<br>

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