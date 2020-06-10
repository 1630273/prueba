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

					<li class="breadcrumb-item"><a href="template.php?action=inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
					<li class=" breadcrumb-itemactive">Ventas</li>
				</ol>
			</div>
</section>


<!-- Main content -->
<section class="content">

	<?php

	if (isset($_GET["action"])) {

		if ($_GET["action"] == "ok_carrito") {

			echo '
		<div class="alert alert-success alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="fas fa-check"></i> Exelente!</h4>
		  El producto ha sido registrado con exito.
		</div>
	  ';
		}
	}


	if (isset($_GET["action"])) {

		if ($_GET["action"] == "ok_venta") {

			echo '
		<div class="alert alert-success alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="fas fa-check"></i> Exelente!</h4>
		La venta fue registrada con exito.
		</div>
	  ';
		}
	}



	if (isset($_GET["action"])) {

		if ($_GET["action"] == "cambio_producto") {

			echo '
		<div class="alert alert-warning alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="fas fa-check"></i> Exelente!</h4>
		  El carrito se ha modificado.
		</div>
	  ';
		}
	}


	if (isset($_GET["action"])) {

		if ($_GET["action"] == "fallo_carrito") {

			echo '
		<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="fas fa-check"></i> ERROR!</h4>
		Fallo al agregar al carrito
		</div>
	  ';
		}
	}


	if (isset($_GET["action"])) {

		if ($_GET["action"] == "cambio_fallo_carrito") {

			echo '
		<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="fas fa-check"></i> ERROR!</h4>
		Fallo al editar carrito
		</div>
	  ';
		}
	}
	if (isset($_GET["action"])) {

		if ($_GET["action"] == "supera_stock") {

			echo '
		<div class="alert alert-danger alert-dismissible">
		  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		  <h4><i class="fas fa-check"></i> ERROR!</h4>
		Se supero el stock
		</div>
	  ';
		}
	}



	?>

	<div class="row">

		<div class="col-md-4  ">
			<!-- general form elements -->
			<div class="card card-success  d-flex">
				<div class="card-header with-border">
					<h3 class="card-title">Ventas</h3>
				</div>
				<form method="post">
					<div class="card-body">
						<div class="form-group">

							<label>Selecciona Categoria</label>
							<div>
								<select name="id_categoria" id="listaCategorias" class="form-control" onchange="listarCategorias()">
									<option value="">Seleccione una Categoria</option>
									<?php
									$categorias = Datos::ObtenerCategorias("categorias");
									foreach ($categorias as $a) : ?>
										<option value="<?php echo $a['id_categoria'] ?>"><?php echo $a['nombre_categoria'] ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label>Selecciona Producto</label>
							<div>

								<select name="id_producto" id="listaProductos" class="form-control " disabled>


								</select>

							</div>
						</div>


						<div class="form-group">
							<label for="precioRegistro">Cantidad</label>
							<input type="number" class="form-control" min="1" placeholder="Cantidad" name="cantidad" required>
						</div>


						<button type="submit" value="Enviar" class="btn btn-block btn-success">Agregar</button>
					</div>
			</div>
			</form>
		</div>


		<div class="col-8  ">
			<div class="card card-primary">
				<div class="card-header">
					<h3 class="card-title">Detalle de compra</h3>
				</div>
				<div class=" card-body">
					<table id="example2" class="table table-bordered table-hover">

						<thead>

							<tr>

								<th>Nombre del Producto</th>
								<th>Precio</th>
								<th>Cantidad</th>
								<th>Importe</th>
								<th>Eliminar</th>

							</tr>

						</thead>

						<tbody>

							<?php

							$vistaVentas = new MvcController();
							$vistaVentas->vistaCarritoController();
							$vistaVentas->borrarProductoCarritoController();
							?>
							<!-- /.col -->
				</div>
				<?php

				$agregar = new MvcController();
				$agregar->agregarCarritoController();
				?>

			</div>
		</div>
		<!-- /.row -->






</section>

<?php

$registro_venta = new MvcController();
$registro_venta->registroVentaController();

if (isset($_GET["action"])) {

	if ($_GET["action"] == "okProducto") {

		echo "Registro Exitoso";
	}
}

?>