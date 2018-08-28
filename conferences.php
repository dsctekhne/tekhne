<?php
include_once 'config/Database.php';
include_once 'models/Conference.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$conference = new Conference($db);
$result = $conference->getAllConferences();
$num = $result->rowCount();
?>
<div class="is-12 has-text-white has-text-centered" id="conferences-section">   
  <h2 class="is-size-2">Conferencias</h2>
</div>
<br>
<div class="event-container">
  

<?php
if($num > 0) {
  while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    extract($row);
    echo '
    <div class="event">
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
            '.$name.' '.$paternal_surname.' '.$maternal_surname.'
          </p>
        </div>
        <br>
      </div>
    ';
    if(isset($_SESSION['id_assistant'])) {
      echo '
        <button class="button is-primary btn-event" style="width: 90%; margin-left: 5%;"
          id="c'.$id_conference.'-'.$_SESSION['id_assistant'].'">
          Registrarse en Conferencias
        </button>
      ';
    } else {
      echo '
        <button class="button is-primary btn-event button-sign-in" style="width: 90%; margin-left: 5%;">
          Registrarse en Conferencias
        </button>
      ';
    }
    echo '</div>';
      
  }
} else {
  echo '<h2 class="has-text-centered is-size-3">Aún no hay conferencias disponibles.</h2>';
}
?>
</div>
<br>