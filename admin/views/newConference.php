<?php
include_once '../../config/Database.php';
include_once '../../models/Speaker.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$speaker = new Speaker($db);
$result = $speaker->getAllSpeakers();
$num = $result->rowCount();
?>
<section class="content-header text-center">
  <h1>
    <i class="fas fa-plus"></i>&nbsp&nbsp&nbsp
    Nueva Conferencia
  </h1>
</section>
<section class="content container-fluid">
  <div class="box box-success"> 
    <div class="box-body">
      <form action="../../web_services/conferences/newConferenceService.php" method="post">
        <div class="form-group">
          <label for="title">Título de la conferencia:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-tag"></i></span>
            <input type="text" class="form-control" placeholder="Título de la conferencia"
            maxlength="150" required="required" name="title" id="input-title">
          </div>
        </div>
        <div class="bootstrap-timepicker">
          <div class="form-group">
            <label for="hour">Hora de inicio:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-clock"></i></span>
              <input type="text" class="form-control timepicker" 
              placeholder="Hora de inicio de la conferencia"
              maxlength="50" required="required" name="hour" id="input-hour">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="date">Fecha de la conferencia:</label>
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" 
            id="datepicker" id="input-date" required="required" class="form-control"
            placeholder="Introduce la fecha de la conferencia" name="date">
          </div>
        </div>
        <div class="form-group">
          <label for="place">Ubicación de la conferencia:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-map-marker"></i></span>
            <input type="text" class="form-control" 
            placeholder="Ubicación donde será la conferencia"
            maxlength="50" required="required" name="place" id="input-place">
          </div>
        </div>
        <div class="form-group">
          <label for="id_speaker">Ponente</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-user"></i></span>
            <select class="form-control" name="id_speaker" required="required">
              <option value="" disabled selected>-- SELECCIONAR PONENTE --</option>
              <?php
              if($num > 0) {
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);
                  echo '
                    <option value="'.$id_speaker.'">
                    '.$name.' '.$paternal_surname.' '.$maternal_surname.'
                    </option>
                  ';
                }
              } else {
                echo '
                  <option disabled>No hay ponentes disponibles. Registra uno</option>
                ';
              }
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <input type="submit" class="btn btn-success" value="Registrar Conferencia">
        </div>
      </form>
    </div>
  </div>
</section>
<script src="../js/newConference.js"></script>