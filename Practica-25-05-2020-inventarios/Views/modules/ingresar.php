<?php
session_start();

session_unset();

session_destroy();

?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema de Ventas Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>Sistmea</b>Inventario</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class=" card-body login-card-body">
        <p class="login-box-msg">Inicia session</p>

        <form method="post">
          <div class="form-group has-feedback">
            <input type="text" name="usuarioIngreso" class="form-control" required placeholder="Usuario">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" name="passwordIngreso" required placeholder="Contraseña">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">

            <!-- /.col -->
            <div class="col-xs-6">
              <button type="submit" value="Enviar" class="btn btn-block btn-primary  ">Iniciar Sesion</button>
            </div>
            <!-- /.col -->
          </div>

        </form>


      </div>
    </div>

    <?php

    $ingreso = new MvcController();
    $ingreso->ingresoUsuarioController();

    if (isset($_GET["action"])) {

      if ($_GET["action"] == "fallo") {

        echo '
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
              Usuario o Contraseña incorrectos.
            </div>
          ';
      }
    }

    if (isset($_GET["action"])) {

      if ($_GET["action"] == "salir") {

        echo '
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
              Ha cerrado sesion.
            </div>
          ';
      }
    }


    ?>
    <!-- /.login-box-body -->

  </div>
  <!-- /.login-box -->

  </div>
  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>

</body>

</html>