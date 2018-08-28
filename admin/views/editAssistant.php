<?php
include_once '../../config/Database.php';
include_once '../../models/Assistant.php';
include_once '../../models/Career.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$assistant = new Assistant($db);
$result = $assistant->getAllAssistants();
$num = $result->rowCount();
$career = new Career($db);
$result2 = $career->getAllCareers();
$num2 = $result->rowCount();
?>
<div id="notifications" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span id="notifications-text"></span>
</div>
<section class="content-header text-center">
  <h1>
  <i class="fas fa-user-edit"></i>&nbsp&nbsp&nbspEditar Alumno
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Lista de alumno registrados.</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="table-assistants" class="table table-bordered table-hover text-center">
      <thead>
        <tr>
          <th>No. Control</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
          <th>Email</th>
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
                  '.$control_number.'
                  </td>
                  <td>
                  '.$name.'
                  </td>
                  <td>
                  '.$paternal_surname.'
                  </td>
                  <td>
                  '.$maternal_surname.'
                  </td>
                  <td>
                  '.$email.'
                  </td>
                  <td>
                    <button class="btn btn-primary button-edit" id="'.$control_number.'" data-toggle="modal" data-target="#modal-edit-assistant">
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
<div class="modal fade" id="modal-edit-assistant" tabindex="-1" role="dialog" aria-labelledby="label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
      </div>
      <div class="modal-body">
        <form class="form">
          <div class="form-group">
            <label for="control_number">Número de Control:</label>
            <input type="text" name="control_number" required="required" class="form-control" 
            id="input-control-number" pattern="[0-9]{8}" maxlength="8" minlength="8">
          </div>
          <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" name="name" required="required" class="form-control" 
            id="input-name" pattern="[a-zA-ZÀ-ž\s]+" maxlength="50">
          </div>
          <div class="form-group">
            <label for="paternal_surname">Apellido Paterno:</label>
            <input type="text" name="paternal_surname" required="required" class="form-control" 
            id="input-paternal_surname" pattern="[a-zA-ZÀ-ž\s]+" maxlength="50">
          </div>
          <div class="form-group">
            <label for="maternal_surname">Apellido Materno:</label>
            <input type="text" name="maternal_surname" required="required" class="form-control" 
            id="input-maternal_surname" pattern="[a-zA-ZÀ-ž\s]+" maxlength="50">
          </div>
          <div class="form-group">
            <label for="email">Correo:</label>
            <input type="email" name="email" required="required" class="form-control" 
            id="input-email" maxlength="50">
          </div>
          <div class="form-group">
            <label for="id_career">Carrera:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-graduation-cap"></i></span>
              <select class="form-control" name="id_career" required="required"
                id="input-id_career">
                <option value="" disabled selected>-- seleccionar carrera--</option>
                <?php
                if($num2 > 0) {
                  while($row = $result2->fetch(PDO::FETCH_ASSOC)) {
                    extract($row);
                    echo '
                      <option value="'.$id_career.'">
                      '.$name.'
                      </option>
                    ';
                  }
                } else {
                  echo '
                    <option disabled>No hay carreras disponibles. Registra una</option>
                  ';
                }
                ?>
              </select>
            </div>
          </div>
          <button type="button" class="btn btn-danger" data-dismiss="modal">
            <i class="fas fa-times"></i>&nbspCancelar
          </button>
          <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i>&nbspGuardar cambios
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(function () {
    $('#table-assistants').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script src="../js/modal-edit-assistant.js"></script>