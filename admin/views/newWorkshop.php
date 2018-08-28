<?php
include_once '../../config/Database.php';
include_once '../../models/Instructor.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$instructor = new Instructor($db);
$result = $instructor->getAllInstructors();
$num = $result->rowCount();
?>
<section class="content-header text-center">
  <h1>
    <i class="fas fa-plus"></i>&nbsp&nbsp&nbsp
    Nuevo Taller
  </h1>
</section>
<section class="content container-fluid">
  <div class="box box-success"> 
    <div class="box-body">
      <h4 class="text-center text-muted">Información general del taller:</h4>
      <hr>
      <form>
        <div class="form-group">
          <label for="title">Título del taller:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-tag"></i></span>
            <input type="text" class="form-control" placeholder="Título del taller"
            maxlength="150" required="required" name="title" id="input-title">
          </div>
        </div>
        <div class="form-group">
          <label for="quota">Cupo:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-users"></i></span>
            <input type="number" class="form-control" 
            placeholder="Cupo de asistentes para el taller"
            maxlength="50" required="required" name="quota" id="input-quota"
            min="0" max="100">
            <span class="input-group-addon">personas</span>
          </div>
        </div>
        <div class="form-group">
          <label for="id_instructor">Instructor:</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-user"></i></span>
            <select class="form-control" name="id_instructor" required="required"
              id="input-id_instructor">
              <option value="" disabled selected>-- seleccionar instructor--</option>
              <?php
              if($num > 0) {
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);
                  echo '
                    <option value="'.$id_instructor.'">
                    '.$name.' '.$paternal_surname.' '.$maternal_surname.'
                    </option>
                  ';
                }
              } else {
                echo '
                  <option disabled>No hay instructores disponibles. Registra uno</option>
                ';
              }
              ?>
            </select>
          </div>
        </div>
        <h4 class="text-center text-muted">Horario del taller:</h4>
        <hr>
        <div id="schedule-area">
          <div class="day-schedule" id="day-1">
            <h5 class="text-primary">Horario 1:</h5>
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <label for="hour">Hora de inicio:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                  <input type="text" class="form-control timepicker input-hour_start" 
                  placeholder="Hora de inicio del taller"
                  maxlength="50" required="required">
                </div>
              </div>
            </div>
            <div class="bootstrap-timepicker">
              <div class="form-group">
                <label for="hour">Hora de termino:</label>
                <div class="input-group">
                  <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                  <input type="text" class="form-control timepicker input-hour_end" 
                  placeholder="Hora de inicio de la conferencia"
                  maxlength="50" required="required">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="date">Fecha:</label>
              <div class="input-group date">
              <div class="input-group-addon">
                <i class="fa fa-calendar"></i>
              </div>
                <input type="text" class="form-control pull-right input-date datepicker" 
                required="required" class="form-control"
                placeholder="Introduce la fecha del taller">
              </div>
            </div>
            <div class="form-group">
              <label for="place">Ubicación del taller:</label>
              <div class="input-group">
                <span class="input-group-addon"><i class="fas fa-map-marker"></i></span>
                <input type="text" class="form-control input-place" 
                placeholder="Ubicación donde será el taller"
                maxlength="50" required="required">
              </div>
            </div>
          </div>
          <div id="schedule-adds"></div>
          <div id="buttons-schedule">
              <button class="btn btn-danger btn-block" id="btn-delete-last-schedule">
                Eliminar úlitmo horario agregado
              </button>
              <button class="btn btn-primary btn-block" id="btn-add-schedule">
                Agregar otro día de horario
              </button>
          </div>
        </div>
        <br>
        <div class="form-group">
          <input type="submit" class="btn btn-success" value="Registrar Taller">
        </div>
      </form>
    </div>
  </div>
</section>
<script src="../js/newWorkshop.js"></script>