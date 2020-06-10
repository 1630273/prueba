<?php
session_start();
require_once "../controllers/controller.php";


$ingreso = new MvcController();
$ingreso->ingresoUsuarioController();



if (!$_SESSION["validar"]) {

  header("location:../index.php");

  exit();
}


ob_start();
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Inventario</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <!-- Site wrapper -->
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

      </ul>


    </nav>
    <!-- /.navbar -->

    <!-- =============================================== -->
    <!-- Main Sidebar Container -->
    <!-- Left side column. contains the sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>


      <!-- Sidebar -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="d-block"> <?php echo $_SESSION['nombre']; ?> </a>

          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item has-treeview">
              <a class="nav-link" href="template.php?action=inicio">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Inicio</p>
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="template.php?action=usuarios">
                <i class="fa fa-user"></i>
                <p>Usuarios</p>
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="template.php?action=productos">
                <i class="fa fa-shopping-cart"></i>
                <p>Productos</p>

              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="template.php?action=categorias">
                <i class="fa  fa-th-large"></i>
                <p>Categorias</p>

              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="template.php?action=clientes">
                <i class="fa fa-users"></i>
                <p>Clientes</p>
              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="template.php?action=ventas">
                <i class="fas fa-dollar-sign"></i>
                <p>Ventas</p>

              </a>
            </li>


            <li class="nav-item">
              <a class="nav-link" href="template.php?action=salir">
                <i class="fas fa-sign-out-alt"></i>
                <p>Salir</p>

              </a>
            </li>
          </ul>

        </nav>

        <!-- /.sidebar-menu -->
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- =============================================== -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <?php
      require_once "../models/crud.php";
      require_once "../models/enlaces.php";
      require_once "../controllers/controller.php";


      $mvc = new MvcController();
      $mvc->enlacesPaginasController();

      ?>


      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.5
      </div>
    </footer>
    <!-- Control Sidebar -->


  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="../plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>

  <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

  <!-- daterangepicker -->
  <script src="../plugins/moment/moment.min.js"></script>
  <script src="../plugins/daterangepicker/daterangepicker.js"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
  <!-- DataTables -->
  <script src="../plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <!-- AdminLTE App -->

  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>



  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <script>
    $(function() {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": false,
      });
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>




  <script type="text/javascript">
    function listarCategorias() {
      var id = $('#listaCategorias').val();

      $.ajax({
        url: "../Controllers/Select_Dinamico_controller.php",
        type: 'post', //método de envio
        async: false,
        data: "id=" + $('#listaCategorias').val(),
        success: function(respuesta) {

          console.log(respuesta);
          $("#listaProductos").attr("disabled", false);
          $("#listaProductos").html(respuesta);

        }
      });
    }
  </script>
  <script type="text/javascript">

  </script>

</body>

</html>