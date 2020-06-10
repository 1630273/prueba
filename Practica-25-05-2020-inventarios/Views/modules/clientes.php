<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1>
					Panel de Administracion

				</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href=" template.php?action=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
					<li class="   breadcrumb-item active">Clientes</li>
				</ol>
			</div>

</section>


<!-- Main content -->
<section class="content">

	<?php

	if (isset($_GET["action"])) {

		if ($_GET["action"] == "ok_cliente") {

			echo '
				<div class="alert alert-success alert-dismissible">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="fas fa-check"></i> Exelente!</h4>
				  El cliente ha sido registrado con exito.
				</div>
			  ';
		}
	}



	if (isset($_GET["action"])) {

		if ($_GET["action"] == "cambio_cliente") {

			echo '
				<div class="alert alert-warning alert-dismissible">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="fas fa-check"></i> Exelente!</h4>
				  El cliente ha sido modificado con exito.
				</div>
			  ';
		}
	}


	if (isset($_GET["action"])) {

		if ($_GET["action"] == "borrar_cliente") {

			echo '
				<div class="alert alert-danger alert-dismissible">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				  <h4><i class="fas fa-check"></i> Exelente!</h4>
				  El cliente ha sido eliminado con exito.
				</div>
			  ';
		}
	}


	?>
	<div class="container-fluid">
		<div class="row">
			<div class="col-12">
				<div class="card ">
					<div class="card-header">
						<div class="float-sm-left">
							<h3> Tabla de Clientes</h3>
						</div>
						<div class="float-sm-right">
							<a href="template.php?action=registro_cliente"><button class="btn  btn-success "><i class="fa fa-cliente"></i> Agregar Cliente</button></a>
						</div>
					</div>
					<!-- /.card-header -->
					<div class="card-body">
						<table id="example1" class="table table-bordered table-hover">

							<thead>

								<tr>
									<th>Id</th>
									<th>Nombre</th>
									<th>RFC</th>
									<th>Correo</th>
									<th>Modificar</th>
									<th>Eliminar</th>

								</tr>

							</thead>

							<tbody>

								<?php

								$vistaCliente = new MvcController();
								$vistaCliente->vistaClientesController();
								$vistaCliente->borrarClienteController();

								?>

							</tbody>

						</table>
					</div>
					<!-- /.card-body -->
				</div>

			</div>
			<!-- /.col -->
		</div>
	</div>
	<!-- /.row -->
</section>