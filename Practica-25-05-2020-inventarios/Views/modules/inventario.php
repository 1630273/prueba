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
					<li class=" breadcrumb-itemactive">Inventario</li>
				</ol>
			</div>
</section>


<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Productos</h3>
				</div>



				<!-- /.card-header -->
				<div class="card-body">
					<div class="row">
						<div class='col-md-4'>
							<label>Filtrar por código o nombre</label>
							<input type="text" class="form-control" id="q" placeholder="Código o nombre del producto" onkeyup='load(1);'>
						</div>

						<div class='col-md-4'>
							<label>Filtrar por categoría</label>
							<select class='form-control' name='id_categoria' id='id_categoria' onchange="load(1);">
								<option value="">Selecciona una categoría</option>
								<?php
								$query_categoria = mysqli_query($con, "select * from categorias order by nombre_categoria");
								while ($rw = mysqli_fetch_array($query_categoria)) {
								?>
									<option value="<?php echo $rw['id_categoria']; ?>"><?php echo $rw['nombre_categoria']; ?></option>
								<?php
								}
								?>
							</select>
						</div>

						<div class='col-md-12 text-center'>
							<span id="loader"></span>
						</div>
					</div>
					<table id="example1" class="table table-bordered table-hover">

						<thead>

							<tr>
								<th>Codigo del Producto</th>
								<th>Nombre del Producto</th>
								<th>Fecha</th>
								<th>Precio</th>
								<th>Stock</th>
								<th>Modificar</th>
								<th>Eliminar</th>

							</tr>

						</thead>

						<tbody>

							<?php

							$vistaUsuario = new MvcController();
							$vistaUsuario->vistaProductosController();
							$vistaUsuario->borrarProductoController();

							?>

						</tbody>

					</table>
				</div>
				<!-- /.card-body -->
			</div>
		</div>
		<div class="bread">
			<a href="template.php?action=registro_producto"><button class="btn  btn-success "><i class="fa fa-user"></i> Agregar Producto</button></a>
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<?php

if (isset($_GET["action"])) {

	if ($_GET["action"] == "cambioProducto") {

		echo "Cambio Exitoso";
	}
}

?>