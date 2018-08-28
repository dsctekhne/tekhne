<?php
include_once '../../config/Database.php';
include_once '../../models/Assistant.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$assistant = new Assistant($db);
$result = $assistant->getAllWorkshops();
$num = $result->rowCount();
?>
<div id="notifications" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span id="notifications-text"></span>
</div>
<section class="content-header text-center">
  <h1>
  <i class="fas fa-receipt"></i>&nbsp&nbsp&nbspRegistrar pago de taller
  </h1>
</section>
<section class="content container-fluid">
<div class="box box-primary">
  <div class="box-header">
    <h3 class="box-title">Lista de alumnos registrados a talleres.</h3>
  </div>
  <div class="box-body table-responsive">
    <table id="table-conferences" class="table table-bordered table-hover text-center">
      <thead>
        <tr>
          <th>ID Taller</th>
          <th>Título</th>
          <th>Número de Control</th>
          <th>Nombre del Asistente</th>
          <th>Estatus</th>
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
                  '.$waid_workshop.'
                  </td>
                  <td>
                  '.$title.'
                  </td>
                  <td>
                  '.$wacontrol_number.'
                  </td>
                  <td>
                    '.$apaternal_surname.' '.$amaternal_surname.' '.$aname.'
                  </td>';
                  if($wastatus == 1) {
                    echo '<td>
                            <span class="label label-success">Registrado</span>
                          </td>
                          <td>
                            <button class="btn btn-primary" disabled="disabled">Pago registrado</button>
                          </td>
                        </tr>
                    ';
                  } else {
                    echo '<td>
                            <span class="label label-warning">En lista de espera</span>
                          </td>
                          <td>
                            <button class="btn btn-primary button-event" id="'.$wacontrol_number.'-'.$waid_workshop.'">
                              Registrar pago
                            </button>
                          </td>
                        </tr>
                    ';
                  }
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
<script src="../js/list-workshop.js"></script>