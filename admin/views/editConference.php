<?php
include_once '../../config/Database.php';
include_once '../../models/Conference.php';
include_once '../../models/Speaker.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$conference = new Conference($db);
$result = $conference->getAllConferences();
$num = $result->rowCount();
$speaker = new Speaker($db);
$result2 = $speaker->getAllSpeakers();
$num2 = $result->rowCount();
?>
<div id="notifications" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span id="notifications-text"></span>
</div>
<section class="content-header text-center">
  <h1>
  <i class="fas fa-pencil-alt"></i>&nbsp&nbsp&nbspEditar Conferencia
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Lista de conferencias registradas.</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="table-conferences" class="table table-bordered table-hover text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Hora</th>
          <th>Fecha</th>
          <th>Ubicación</th>
          <th>Ponente</th>
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
                  '.$id_conference.'
                  </td>
                  <td>
                  '.$title.'
                  </td>
                  <td>
                  '.$hour.'
                  </td>
                  <td>
                  '.$date.'
                  </td>
                  <td>
                  '.$place.'
                  </td>
                  <td>
                  '.$name.' '.$paternal_surname.' '.$maternal_surname.'
                  </td>
                  <td>
                    <button class="btn btn-primary button-edit" id="'.$id_conference.'" data-toggle="modal" data-target="#modal-edit-conference">
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
<div class="modal fade" id="modal-edit-conference" tabindex="-1" role="dialog" aria-labelledby="label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
      </div>
      <div class="modal-body">
        <form class="form">
          <div class="form-group">
            <label for="id_conference">ID:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-tag"></i></span>
              <input type="text" class="form-control"
              name="id" id="input-id_conference"
              disabled>
            </div>
          </div>
          <div class="form-group">
            <label for="title">Título de la conferencia:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-tag"></i></span>
              <input type="text" class="form-control" placeholder="Título de la conferencia"
              maxlength="50" required="required" name="title" id="input-title">
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
              <select class="form-control" name="id_speaker" required="required"
                id="input-id_speaker">
                <option value="" disabled selected>-- SELECCIONAR PONENTE --</option>
                <?php
                if($num2 > 0) {
                  while($row = $result2->fetch(PDO::FETCH_ASSOC)) {
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
    $('#table-conferences').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script src="../js/modal-edit-conference.js"></script>