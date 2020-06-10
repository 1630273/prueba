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
					<li class="breadcrumb-item"><a href="template.php?action=categorias">Categorias</a></li>
					<li class=" breadcrumb-item active">Editar de Categoria</li>
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
					<h3 class="card-title">Editar de Categoria</h3>
				</div>

				<form method="post">

					<?php

					$editarUsuario = new MvcController();
					$editarUsuario->editarCategoriaController();
					$editarUsuario->actualizarCategoriaController();

					?>

				</form>


			</div>
		</div>
	</div>
</section>