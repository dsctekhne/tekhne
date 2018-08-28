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
<div id="notifications" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span id="notifications-text"></span>
</div>
<section class="content-header text-center">
  <h1>
  <i class="fas fa-user-edit"></i>&nbsp&nbsp&nbspEditar Instructor
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Lista de instructores registrados.</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="table-instructors" class="table table-bordered table-hover text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Apellido Paterno</th>
          <th>Apellido Materno</th>
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
                  '.$id_instructor.'
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
                    <button class="btn btn-primary button-edit" id="'.$id_instructor.'" data-toggle="modal" data-target="#modal-edit-instructor">
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
<div class="modal fade" id="modal-edit-instructor" tabindex="-1" role="dialog" aria-labelledby="label">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Editar Datos</h4>
      </div>
      <div class="modal-body">
        <form action="../../web_services/instructors/newInstructorService.php" method="post">
          <div class="form-group">
            <label for="name">ID:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input id="input-id_instructor" type="text" class="form-control" disabled="disabled" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="name">Nombre:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input id="input-name" type="text" class="form-control" name="name"
                placeholder="Introduce el nombre del instructor" maxlength="50"
                pattern="[a-zA-ZÀ-ž\s]+" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="paternal_surname">Apellido Paterno:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input id="input-paternal_surname" type="text" class="form-control" name="paternal_surname"
                placeholder="Introduce el apellido paterno del instructor" maxlength="50"
                pattern="[a-zA-ZÀ-ž\s]+" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="maternal_surname">Apellido Materno:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <input id="input-maternal_surname" type="text" class="form-control" name="maternal_surname"
                placeholder="Introduce el apellido materno del instructor" maxlength="50"
                pattern="[a-zA-ZÀ-ž\s]+" required="required">
            </div>
          </div>
          <div class="form-group">
            <label for="information">Información del instructor:</label>
            <div class="input-group">
              <span class="input-group-addon"><i class="fas fa-user"></i></span>
              <textarea id="input-information" class="form-control" name="information"
                placeholder="Introduce información relevante del instructor" maxlength="500"
                pattern="[a-zA-ZÀ-ž\s]+"></textarea>
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
    $('#table-instructors').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script src="../js/modal-edit-instructor.js"></script>