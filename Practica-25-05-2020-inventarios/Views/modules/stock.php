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
					<li class="breadcrumb-item"><a href="template.php?action=productos">Productos</a></li>
					<li class="breadcrumb-item active">Stock</li>
				</ol>
			</div>
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-md-6 m-auto ">
			<!-- general form elements -->
			<div class="card card-success  d-flex">
				<div class="card-header with-border">
					<h3 class="card-title">Agregar Stock</h3>
				</div>
				<form method="post">
					<div class="card-body">
						<?php

						$registro = new MvcController();
						$registro->obtenerStockController();

						?>
						<div class="form-group">
							<label for="AccionRegistro">Accion </label>
							<div class="radio">
								<label>
									<input type="radio" name="Radio" id="optionsRadios1" value="+" checked="">
									Aumentar
								</label>

								<label>
									<input type="radio" name="Radio" id="optionsRadios2" value="-">
									Disminuir
								</label>
							</div>
						</div>
						<div class="form-group">
							<label for="stockRegistro">Cantidad </label>
							<input type="number" class="form-control" placeholder="Stock" min=1 name="cantidad" id="stockRegistro" required>
						</div>

						<div class="form-group">
							<label for="referencia">Referencias</label>
							<input type="text" class="form-control" placeholder="Referencia" id="referencia" name="referencia" required>
						</div>


						<button type="submit" value="Enviar" class="btn btn-block btn-success">Agregar</button>
					</div>


			</div>


			</form>

		</div>
	</div>
	<div class="card card-primary">
		<div class="card-header">
			<h3 class="card-title">Historial de Movimientos</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<table id="example1" class="table table-bordered table-hover">

				<thead>

					<tr>
						<th>Fecha</th>
						<th>Descripcion</th>
						<th>Referencia</th>
						<th>Total</th>

					</tr>

				</thead>

				<tbody>

					<?php

					$registro->vistaHistorialController();

					?>

				</tbody>

			</table>

		</div>
		<!-- /.card-body -->
	</div>

	</div>
	</div>


</section>