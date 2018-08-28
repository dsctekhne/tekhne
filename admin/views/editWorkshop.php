<?php
include_once '../../config/Database.php';
include_once '../../models/Workshop.php';
include_once '../../models/Instructor.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$workshop = new Workshop($db);
$result = $workshop->getAllWorkshops();
$num = $result->rowCount();
$instructor = new Instructor($db);
$result2 = $instructor->getAllInstructors();
$num2 = $result->rowCount();
?>
<div id="notifications" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span id="notifications-text"></span>
</div>
<section class="content-header text-center">
  <h1>
  <i class="fas fa-pencil-alt"></i>&nbsp&nbsp&nbspEditar Taller
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Lista de talleres registrados.</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="table-workshops" class="table table-bordered table-hover text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Cupo</th>
          <th>Instructor</th>
          <th>Operación</th>
        </tr>
      </thead>
      <tbody>
        <?php
          if($num > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <tr>
                  <td>
                  '.$id_workshop.'
                  </td>
                  <td>
                  '.$title.'
                  </td>
                  <td>
                  '.$capacity.'
                  </td>
                  <td>
                  '.$name.' '.$paternal_surname.' '.$maternal_surname.'
                  </td>
                  <td>
                    <button class="btn btn-primary button-edit" id="'.$id_workshop.'" data-toggle="modal" data-target="#modal-edit-workshop">
                      <i class="fas fa-pencil-alt"></i>
                    </button>
                  </td>
                </tr>
              ';
            }
          } else {
            echo '
              <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            ';
          }
        ?>
      </tbody>
    </table>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="modal-edit-workshop" tabindex="-1" role="dialog" aria-labelledby="label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
      </div>
      <div class="modal-body">
        <h4 class="text-center text-muted">Información general del taller:</h4>
        <hr>
        <form>
          <div class="form-group">
            <label for="id_workshop">ID:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-tag"></i></span>
              <input type="text" class="form-control" placeholder="ID del taller"
              maxlength="50" required="required" name="id_workshop" id="input-id_workshop"
              disabled="disabled">
            </div>
          </div>
          <div class="form-group">
            <label for="title">Título del taller:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-tag"></i></span>
              <input type="text" class="form-control" placeholder="Título del taller"
              maxlength="50" required="required" name="title" id="input-title">
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
                <option value="" disabled selected>-- SELECCIONAR INSTRUCTOR --</option>
                <?php
                if($num > 0) {
                  while($row = $result2->fetch(PDO::FETCH_ASSOC)) {
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
            <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-times"></i>&nbspCancelar
            </button>
            <button type="submit" class="btn btn-success">
              <i class="fas fa-save"></i>&nbspGuardar cambios
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(function () {
    $('#table-workshops').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script src="../js/modal-edit-workshop.js"></script>