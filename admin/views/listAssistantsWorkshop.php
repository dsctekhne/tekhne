<?php
include_once '../../config/Database.php';
include_once '../../models/Workshop.php';
include_once '../../models/Instructor.php';
include_once '../../models/Assistant.php';
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
    <i class="fas fa-file-pdf"></i>&nbsp&nbsp&nbspGenerar lista de Asistentes
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-success">
  <div class="box-header">
    <h3 class="box-title">Lista de talleres registrados.</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="table-workshops" class="table table-bordered table-hover text-center">
      <thead>
        <tr>
          <th>ID</th>
          <th>Título</th>
          <th>Instructor</th>
          <th>Cupo</th>
          <th>Asistentes registrados</th>
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
                  '.$name.' '.$paternal_surname.' '.$maternal_surname.'
                  </td>
                  <td>
                  '.$capacity.'
                  </td>';
                  $assistant = new Assistant($db);
                  $result3 = $assistant->getCurrentQuota($id_workshop);
                  $num3 = $result3->rowCount();
                  if($num3 > 0) {
                    while($row3 = $result3->fetch(PDO::FETCH_ASSOC)) {
                      extract($row3);
                      echo '
                        <td>
                          '.$total_registers.'
                        </td>
                      ';
                    }
                  } else {
                    echo '
                        <td>
                          0
                        </td>
                      ';
                  }
                  echo '
                  <td>
                    <form target="_blank" action="pdfWorkshop.php" method="post">
                      <button type="submit" class="btn btn-danger" name="id_workshop" value="'.$id_workshop.'">
                        <i class="fas fa-file-pdf"></i>
                      </button>
                    </form>
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