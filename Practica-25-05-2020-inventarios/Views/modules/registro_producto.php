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
					<li class="breadcrumb-item"><a href="template.php?action=inventario">Inventario</a></li>
					<li class=" breadcrumb-item active">Registro de Producto</li>
				</ol>
			</div>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-6 m-auto  ">
			<!-- general form elements -->
			<div class="card card-success  d-flex">
				<div class="card-header with-border">
					<h3 class="card-title">Resgistro de Productos</h3>
				</div>
				<form method="post" enctype="multipart/form-data">
					<div class="card-body">
						<div class="form-group">
							<label for="codigoRegistro">Codigo</label>
							<input type="text" class="form-control" placeholder="Codigo del producto" id="codigoRegistro" name="codigoRegistro" required>
						</div>


						<div class="form-group">
							<label for="nombreProductoRegistro">Nombre del producto</label>
							<input type="text" class="form-control" placeholder="Nombre del producto" id="nombreProductoRegistro" name="nombreProductoRegistro" required>
						</div>

						<div class="form-group">
							<label for="imagenRegistro">Imagen</label>

							<input type="file" class="form-control" name="imagenRegistro" required>
						</div>




						<div class="form-group">
							<label>Selecciona Categoria</label>
							<div>
								<select name="categoriaRegistro" class="form-control">
									<?php
									$categorias = Datos::ObtenerCategorias("categorias");

									foreach ($categorias as $a) : ?>
										<option value="<?php echo $a['id_categoria'] ?>"><?php echo $a['nombre_categoria'] ?></option>
									<?php endforeach; ?>

								</select>

							</div>
						</div>


						<div class="form-group">
							<label for="precioRegistro">Precio</label>
							<input type="number" class="form-control" min="1" placeholder="Precio" id="precioRegistro" name="precioRegistro" required>
						</div>

						<div class="form-group">
							<label for="stockRegistro">Stock</label>
							<input type="number" class="form-control" placeholder="Stock" name="stockRegistro" id="stockRegistro" required>
						</div>
						<button type="submit" value="Enviar" class="btn btn-block btn-success">Agregar</button>
					</div>
			</div>
			</form>
		</div>
	</div>
	</div>
</section>
<?php

$registro = new MvcController();
$registro->registroProductoController();

if (isset($_GET["action"])) {

	if ($_GET["action"] == "okProducto") {

		echo "Registro Exitoso";
	}
}

?>