<?php 
session_start();
if(!isset($_SESSION['id_user'])) {
  echo '<script type="text/javascript">
              window.location = "../login.php"
            </script>';
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tékhne | Administrador</title>
  <link rel="icon" href="../../images/favicon.ico" type="image/x-icon" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/skin-blue.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Josefin+Slab|Quicksand" rel="stylesheet">
  <!-- Custom Styles -->
  <link rel="stylesheet" href="../css/styles.css">
  <script src="bower_components/jquery/dist/jquery.min.js"></script>
</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="dashboard.php" class="logo">
      <span class="logo-mini">
        <b>Tkhn</b>
      </span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">
        <img src="../../images/logo.svg" alt="Tékhne" width="90" height="20">
      </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" data-toggle="push-menu" role="button">
      <i class="fas fa-bars" style="color:white; margin-top:20px;margin-left:15%px"></i>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu" style="margin-right: 2%;">
        <a href="logout.php" class="btn btn-info" style="margin: 5%;">
          Cerrar Sesión
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <!-- Optionally, you can add icons to the links -->
        <li class="treeview">
          <a href="#"><i class="fas fa-user-graduate"></i>&nbsp&nbsp&nbsp<span>Alumnos</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="btn-edit-assistant" href="#"><i class="fas fa-user-edit"></i>&nbsp&nbsp&nbspEditar Alumno</a></li>
            <li><a id="btn-delete-assistant" href="#"><i class="fas fa-user-times"></i>&nbsp&nbsp&nbspEliminar Alumno</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fas fa-chalkboard-teacher"></i>&nbsp&nbsp&nbsp<span>Instructores</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="btn-new-instructor" href="#"><i class="fas fa-user-plus"></i>&nbsp&nbsp&nbspNuevo Instructor</a></li>
            <li><a id="btn-edit-instructor" href="#"><i class="fas fa-user-edit"></i>&nbsp&nbsp&nbspEditar Instructor</a></li>
            <li><a id="btn-delete-instructor" href="#"><i class="fas fa-user-times"></i>&nbsp&nbsp&nbspEliminar Instructor</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fas fa-user-tie"></i>&nbsp&nbsp&nbsp<span>Ponentes</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="btn-new-speaker" href="#"><i class="fas fa-user-plus"></i>&nbsp&nbsp&nbspNuevo Ponente</a></li>
            <li><a id="btn-edit-speaker" href="#"><i class="fas fa-user-edit"></i>&nbsp&nbsp&nbspEditar Ponente</a></li>
            <li><a id="btn-delete-speaker" href="#"><i class="fas fa-user-times"></i>&nbsp&nbsp&nbspEliminar Ponente</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fas fa-comment-alt"></i>&nbsp&nbsp&nbsp<span>Conferencias</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="btn-new-conference" href="#"><i class="fas fa-plus"></i></i>&nbsp&nbsp&nbspNueva Conferencia</a></li>
            <li><a id="btn-edit-conference" href="#"><i class="fas fa-pencil-alt"></i>&nbsp&nbsp&nbspEditar Conferencia</a></li>
            <li><a id="btn-delete-conference" href="#"><i class="fas fa-trash-alt"></i>&nbsp&nbsp&nbspEliminar Conferencia</a></li>
            <li><a id="btn-list-conferences" href="#"><i class="fas fa-list-ul"></i>&nbsp&nbsp&nbspVer alumnos registrados</a></li>
            <li><a id="btn-excel-conferences" href="#"><i class="fas fa-file-excel"></i>&nbsp&nbsp&nbspLista de alumnos registrados</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fas fa-chalkboard"></i>&nbsp&nbsp&nbsp<span>Talleres</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a id="btn-new-workshop" href="#"><i class="fas fa-plus"></i></i>&nbsp&nbsp&nbspNuevo Taller</a></li>
            <li><a id="btn-edit-workshop" href="#"><i class="fas fa-pencil-alt"></i>&nbsp&nbsp&nbspEditar Taller</a></li>
            <li><a id="btn-delete-workshop" href="#"><i class="fas fa-trash-alt"></i>&nbsp&nbsp&nbspEliminar Taller</a></li>
            <li><a class="btn-list-workshops" href="#"><i class="fas fa-receipt"></i>&nbsp&nbsp&nbspRegistrar pagos</a></li>
            <li><a id="btn-pdf-workshop" href="#"><i class="fas fa-file-pdf"></i>&nbsp&nbsp&nbspGenerar lista de alumnos</a></li>
            <li><a id="btn-excel-workshop" href="#"><i class="fas fa-file-excel"></i>&nbsp&nbsp&nbspLista de alumnos registrados</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#"><i class="fas fa-book"></i>&nbsp&nbsp&nbsp<span>Manuales</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="../../manuales/manual_usuario.pdf" target="_blank"><i class="fas fa-book"></i></i>&nbsp&nbsp&nbspManual de usuario</a></li>
            <li><a href="../../manuales/manual_usuario.pdf" target="_blank"><i class="fas fa-book"></i></i>&nbsp&nbsp&nbspManual técnico</a></li>
          </ul>
        </li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="scroll: auto;">
    <?php require_once 'main.php'; ?>
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer" style="background:#222d32;">
    <!-- To the right -->
    <!-- <div class="pull-right hidden-xs">
      Anything you want
    </div> -->
    <!-- Default to the left -->
    <strong class="text-white">Instituto Tecnológico de Morelia | Tékhne
    <div class="pull-right">
      <a href="" class="anchor">
      <i class="fab fa-github"></i> GitHub
      </a>
    </div>
  </footer>
  <!-- Add the sidebar's background. This div must be placed
  immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->

<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Menu Admin -->
<script src="../js/menu-admin.js"></script>

</body>
</html>