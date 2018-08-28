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
    <i class="fas fa-trash-alt"></i>&nbsp&nbsp&nbspEliminar Taller
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-danger">
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
                    <button class="btn btn-danger button-delete" id="'.$id_workshop.'" data-toggle="modal" data-target="#modal-edit-workshop">
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
<script src="../js/deleteWorkshop.js"></script>