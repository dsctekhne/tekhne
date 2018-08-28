<?php
include_once '../../config/Database.php';
include_once '../../models/Assistant.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$assistant = new Assistant($db);
$result = $assistant->getAllAssistants();
$num = $result->rowCount();
?>
<div id="notifications" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span class="text-center" id="notifications-text"></span>
</div>
<section class="content-header text-center">
  <h1>
  <i class="fas fa-user-times"></i>&nbsp&nbsp&nbspEliminar Alumno
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-danger">
  <div class="box-header">
    <h3 class="box-title">Lista de alumnos registrados.</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="table-assistants2" class="table table-bordered table-hover text-center">
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
                    <button class="btn btn-danger button-delete" id="'.$control_number.'" data-toggle="modal" data-target="#modal-edit-assistant">
                      <i class="fas fa-trash-alt"></i>
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
<script>
  $(function () {
    $('#table-assistants2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      "pagingType": "full_numbers"
    })
  })
</script>
<script src="../js/deleteAssistant.js"></script>
