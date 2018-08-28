<?php
include_once '../../config/Database.php';
include_once '../../models/Assistant.php';
include_once '../../models/Conference.php';
include_once '../../models/Workshop.php';
include_once '../../models/Speaker.php';
include_once '../../models/Instructor.php';
// Instantiate DB & connect
$database = new Database();
$db = $database->connect();
?>
<section class="content">
<div class="row">
  <div class="col-lg-6 col-xs-6">
    <?php 
    $consult = new Assistant($db);
    $result = $consult->getNumberAssistants();
    $num = $result->rowCount();
    ?>
    <div class="small-box bg-aqua">
      <div class="inner">
        <?php
          if($num > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <h3>
                '.$total.'
                </h3>
              ';
            }
          } else {
            echo '<h3>0</h3>';
          }
        ?>
        <p>Asistentes Registrados</p>
      </div>
      <div class="icon">
        <i class="fas fa-user"></i>
      </div>
    </div>
  </div>     
  <div class="col-lg-6 col-xs-6">
    <?php 
    $consult = new Conference($db);
    $result = $consult->getNumberConferences();
    $num = $result->rowCount();
    ?>
    <div class="small-box bg-red">
      <div class="inner">
        <?php
          if($num > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <h3>
                '.$total.'
                </h3>
              ';
            }
          } else {
            echo '<h3>0</h3>';
          }
        ?>
        <p>Conferencias Registradas</p>
      </div>
      <div class="icon">
      <i class="fas fa-comment-alt"></i>
      </div>
    </div>
  </div>
  </div>
  <div class="row">
  <div class="col-lg-6 col-xs-6">
    <?php 
    $consult = new Workshop($db);
    $result = $consult->getNumberWorkshops();
    $num = $result->rowCount();
    ?>
    <div class="small-box bg-yellow">
      <div class="inner">
        <?php
          if($num > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <h3>
                '.$total.'
                </h3>
              ';
            }
          } else {
            echo '<h3>0</h3>';
          }
        ?>
        <p>Talleres Registrados</p>
      </div>
      <div class="icon">
        <i class="fas fa-graduation-cap"></i>
      </div>
    </div>
  </div>     
  <div class="col-lg-6 col-xs-6">
    <?php 
    $consult = new Instructor($db);
    $result = $consult->getNumberInstructors();
    $num = $result->rowCount();
    ?>
    <div class="small-box bg-green">
      <div class="inner">
        <?php
          if($num > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <h3>
                '.$total.'
                </h3>
              ';
            }
          } else {
            echo '<h3>0</h3>';
          }
        ?>
        <p>Instructores Registrados</p>
      </div>
      <div class="icon">
      <i class="fas fa-user"></i>
      </div>
    </div>
  </div>
  </div>
  <div class="row">
  <div class="col-lg-6 col-xs-6">
    <?php 
    $consult = new Speaker($db);
    $result = $consult->getNumberSpeakers();
    $num = $result->rowCount();
    ?>
    <div class="small-box bg-blue">
      <div class="inner">
        <?php
          if($num > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <h3>
                '.$total.'
                </h3>
              ';
            }
          } else {
            echo '<h3>0</h3>';
          }
        ?>
        <p>Ponentes Registrados</p>
      </div>
      <div class="icon">
      <i class="fas fa-user"></i>
      </div>
    </div>
  </div>     
  <div class="col-lg-6 col-xs-6">
    <?php 
    $consult = new Assistant($db);
    $result = $consult->getNumberAssistantsConferences();
    $num = $result->rowCount();
    ?>
    <div class="small-box bg-purple">
      <div class="inner">
        <?php
          if($num > 0){
            while($row = $result->fetch(PDO::FETCH_ASSOC)) {
              extract($row);
              echo '
                <h3>
                '.$total.'
                </h3>
              ';
            }
          } else {
            echo '<h3>0</h3>';
          }
        ?>
        <p>Asistentes Registrados a Conferencias</p>
      </div>
      <div class="icon">
      <i class="fas fa-user"></i><i class="fas fa-comment-alt"></i>
      </div>
    </div>
  </div>
  <div class="col-lg-12 col-xs-6 offset-lg-3">
      <button class="btn btn-block btn-danger btn-lg btn-list-workshops"><i class="fas fa-receipt"></i> Registrar Pagos Bancarios</button>
    </div>
</section>
