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
					<li class="breadcrumb-item"><a href="template.php?action=usuarios">Usuarios</a></li>
					<li class=" breadcrumb-item active">Registro</li>
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
					<h3 class="card-title">Resgistro de Usuarios</h3>
				</div>
				<form method="post">
					<div class="card-body">
						<div class="form-group">
							<label for="nombre">Nombre</label>
							<input type="text" class="form-control" placeholder="Nombre" id="nombreRegistro" name="nombreRegistro" required>
						</div>

						<div class="form-group">
							<label for="apellidos">Apelllidos</label>
							<input type="text" class="form-control" placeholder="Apellidos" id="apellidos" name="apellidosRegistro" required>
						</div>

						<div class="form-group">
							<label for="usuario">Usuario</label>
							<input type="text" class="form-control" placeholder="Usuario" id="usuario" name="usuarioRegistro" required>
						</div>

						<div class="form-group">
							<label for="password">Contraseña</label>
							<input type="password" class="form-control" placeholder="Contraseña" name="passwordRegistro" required>
						</div>

						<div class="form-group">
							<label>Selecciona Tipo de Usuario</label>
							<div>
								<select name="tipoRegistro" class="form-control">
									<?php
									$tipos = Datos::ObtenerTipos("tipo_user");

									foreach ($tipos as $a) : ?>
										<option value="<?php echo $a['id_tipo'] ?>"><?php echo $a['nombre'] ?></option>
									<?php endforeach; ?>

								</select>

							</div>
						</div>

						<div class="form-group">
							<label for="correo">correo</label>
							<input type="email" class="form-control" placeholder="Correo" name="emailRegistro" required>
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
$registro->registroUsuarioController();

if (isset($_GET["action"])) {

	if ($_GET["action"] == "ok") {

		echo "Registro Exitoso";
	}
}

?>