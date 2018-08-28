<?php
include_once '../../config/Database.php';
include_once '../../models/Assistant.php';
include_once '../../models/Conference.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
$conference = new Conference($db);
$result = $conference->getAllConferences();
$num = $result->rowCount();
?>
<div id="notifications" class="alert alert-success alert-dismissible" role="alert" style="display: none;">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span id="notifications-text"></span>
</div>
<section class="content-header text-center">
  <h1>
    <i class="fas fa-comment-alt"></i>&nbsp&nbsp&nbspLista de Asistentes
  </h1>
</section>
<section class="content container-fluid">
  <div class="box box-default">
    <div class="box-header">
      <h4>Selecciona una Conferencia</h4>
    </div>
    <div class="box-body">
      <form class="form" id="form-list-conference">
        <div class="form-group">
          <div class="input-group">
            <span class="input-group-addon"><i class="fas fa-comment-alt"></i></span>
            <select class="form-control" name="id_conference" required="required"
              id="input-id_conference">
              <option value="" disabled selected>-- SELECCIONAR CONFERENCIA --</option>
              <?php
              if($num > 0) {
                while($row = $result->fetch(PDO::FETCH_ASSOC)) {
                  extract($row);
                  echo '
                    <option value="'.$id_conference.'">
                    '.$title.'
                    </option>
                  ';
                }
              } else {
                echo '
                  <option disabled>No hay conferencias disponibles.</option>
                ';
              }
              ?>
            </select>
          </div>
        </div>
        <input class="btn btn-primary btn-block" type="submit" value="Ver lista de asistentes">
      </form>
    </div>
  </div>
  <div class="box box-primary">
  <div id="conference-info"></div>
</section>
<script src="../js/list-conference.js"></script>