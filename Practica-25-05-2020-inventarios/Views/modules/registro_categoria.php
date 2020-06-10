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
					<li class="breadcrumb-item"><a href="template.php?action=categorias">Categoriass</a></li>
					<li class=" breadcrumb-item active">Registro de Categorias</li>
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
					<h3 class="card-title">Resgistro de Categorias</h3>
				</div>
				<form method="post">
					<div class="card-body">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" placeholder="Nombre de la Categoria" id="nombreRegistro" name="nombreRegistro" required>
						</div>

						<div class="form-group">
							<label for="des">Descripcion</label>
							<input type="text" class="form-control" placeholder="Descripcion" id="des" name="desRegistro" required>
						</div>


						<button type="submit" value="Enviar" class="btn btn-block btn-success">Agregar</button>
					</div>

				</form>
			</div>
		</div>
	</div>
</section>
<?php

$registro = new MvcController();
$registro->registroCategoriaController();

if (isset($_GET["action"])) {

	if ($_GET["action"] == "ok") {

		echo "Registro Exitoso";
	}
}

?>