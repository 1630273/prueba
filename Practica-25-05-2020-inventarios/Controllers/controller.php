<?php
/* Clzse paracrear los controladores que se utilizara elusuario mientras
navega en el sitio web */
class MvcController
{

	#LLAMADA A LA PLANTILLA
	#Funcion que sirve para devolver la estructura del sistema
	#-------------------------------------

	public function plantilla()
	{

		include "views/modules/ingresar.php";
	}

	#ENLACES
	//Funcion que sirve para mostrale al usuario la pantalla correspondiente a la accion seleccionada
	#-------------------------------------

	public function enlacesPaginasController()
	{
		//Se valida que halla un action
		if (isset($_GET['action'])) {

			$enlaces = $_GET['action'];
		} else {

			$enlaces = "template";
		}

		$respuesta = Paginas::enlacesPaginasModel($enlaces);

		include $respuesta;
	}

	#REGISTRO DE USUARIOS
	//Funcion para regirstar unsuario, toma la informacion del formulario de  registro y la convierte en un
	//arreglo para despues mandarla al controlador, en caso de ser relizada la oprecion por el modelo envia un mnesje de exito o de lo contrario un error
	#------------------------------------
	public function registroUsuarioController()
	{

		date_default_timezone_set("America/Mexico_City");
		$fecha_actual = date("Y-m-d H:i:s");

		if (isset($_POST["usuarioRegistro"])) {
			//Para enciptar la pass se hace uso del metodo password_hash 
			$pass = $_POST["passwordRegistro"];
			// encriptar  password
			$pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);


			$datosController = array(
				"firstname" => $_POST["nombreRegistro"],

				"lastname" => $_POST["apellidosRegistro"],

				"user_name" => $_POST["usuarioRegistro"],

				"user_password_hash" => $pass_cifrada,

				"user_email" => $_POST["emailRegistro"],

				"tipo" => $_POST["tipoRegistro"],

				"date_added" => $fecha_actual
			);

			//Se envia el arrelo $datosController al modelo
			$respuesta = Datos::registroUsuarioModel($datosController, "users");

			if ($respuesta == "success") {

				header("location:template.php?action=ok_usuario");
			} else {

				header("location:index.php");
			}
		}
	}

	#INGRESO DE USUARIOS
	/* Este controlador apartir de  la funcion password_verify compara para hash  la contraseña ingresada con la que esta la base de datos, en caso de ser correcto se envia a la pagina  de incio de lo contrario se mostrar el error*/
	#------------------------------------
	public function ingresoUsuarioController()
	{

		if (isset($_POST["usuarioIngreso"]) && isset($_POST["passwordIngreso"])) {

			//Guarda en  el aarry los valores de los inputs de la vista de ingresar 
			$datosController = array(
				"user_name" => $_POST["usuarioIngreso"],
				"user_password_hash" => $_POS["passwordIngreso"]
			);

			$respuesta = Datos::ingresoUsuarioModel($datosController, "users");
			//Respuesta del Modelo
			if ($respuesta["user_name"] == $_POST["usuarioIngreso"] && password_verify($_POST['passwordIngreso'], $respuesta['user_password_hash'])) {

				session_start();

				$_SESSION["validar"] = true;
				$_SESSION['user_id'] = $respuesta["user_id"];
				$_SESSION['user_name'] = $respuesta["user_name"];
				$_SESSION['nombre'] = $respuesta["firstname"] . " " . $respuesta["lastname"];
				$_SESSION['nombre1'] = $respuesta["firstname"];


				header("location:views/template.php?action=inicio");
			} else {

				header("location:index.php?action=fallo");
			}
		}
	}



	#VISTA DE USUARIOS
	#------------------------------------
	//Funcion que sirve para mostar toda la informacion del usuario en una tabla cabe destacar que la contraseña no se muestra porque esta incriptada

	public function vistaUsuariosController()
	{

		$respuesta = Datos::vistaUsuariosModel("users");

		//ciclo que imprime los valores que trae respuesta del modelo
		foreach ($respuesta as $row => $item) {
			echo '<tr>
				<td>' . $item["user_id"] . '</td>
				<td>' . $item["firstname"] . " " .
				$item["lastname"] . '</td>
				<td>' . $item["user_name"] . '</td>
				<td>' . $item["user_email"] . '</td>
				<td>' . $item["date_added"] . '</td>
				<td><a href="template.php?action=editar&user_id=' . $item["user_id"] . '"class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i></a></td>
				<td><a href="template.php?action=usuarios&idBorrar=' . $item["user_id"] . '"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
			</tr>';
		}
	}

	#EDITAR USUARIO
	#------------------------------------
	/* Esta funcion se encarga de mostrar el formulario para editar los datos del usuario, la contraseña no se carga debido a que esta encriptada, no es optimo mostrarle al usuario su contraseña como una cadena de caracteres y se deja en blanco , pero se verifica al momendo de hacer una modificacion que haya ingresado una contraseña , de los contrario no se podra ejecutar la modificacion */
	public function editarUsuarioController()
	{

		$datosController = $_GET["user_id"];
		$respuesta = Datos::editarUsuarioModel($datosController, "users");
		$tipos = Datos::ObtenerTipos("tipo_user");

		echo '<div class="card-body">
				<input type="hidden" value="' . $respuesta["user_id"] . '" name="user_idEditar">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" value="' . $respuesta["firstname"] . '" name="nombreEditar" required>
				</div>

				<div class="form-group">
					<label for="apllidos">Apellidos</label>
					<input type="text" class="form-control" value="' . $respuesta["lastname"] . '" name="apellidosEditar" required>
		
				</div>
				
				<div class="form-group">
					<label for="correo">Ususario</label>
					<input type="text"class="form-control"  value="' . $respuesta["user_name"] . '" name="usuarioEditar" required>				
				</div>
				

				<div class="form-group">
				<label for="correo">Contraseña</label>
				<input type="text" class="form-control" name="passwordEditar" required>

				<div class="form-group">
				<label>Selecciona Tipo de Usuario</label>
				<div>
					<select name="tipoEditar" class="form-control">
						';


		foreach ($tipos as $a) :
			echo '<option value="' . $a['id_tipo'] . '"> ' . $a['nombre'] . '</option>';
		endforeach;

		echo '	</select>

				</div>
			</div>

				<div class="form-group">
				<label for="correo">correo</label>
				<input type="text" class="form-control" value="' . $respuesta["user_email"] . '" name="emailEditar" required>

				</div>
				<button type="submit" value="Actualizar" class="btn btn-block btn-success">Actualizar</button>
		 </div>
	 </div> ';
	}

	#ACTUALIZAR USUARIO
	#------------------------------------
	//Sirve para  actulizar la informacion del usuario,notifica si se realizo el cambio o hubo un error
	public function actualizarUsuarioController()
	{

		if (isset($_POST["usuarioEditar"])) {

			$_POST["passwordEditar"] = password_hash($_POST["passwordEditar"], PASSWORD_DEFAULT);
			$datosController = array(
				"user_id" => $_POST["user_idEditar"],

				"firstname" => $_POST["nombreEditar"],

				"lastname" => $_POST["apellidosEditar"],

				"user_name" => $_POST["usuarioEditar"],

				"user_password_hash" => $_POST["passwordEditar"],

				"id_tipo" => $_POST["tipoEditar"],

				"user_email" => $_POST["emailEditar"]
			);

			$respuesta = Datos::actualizarUsuarioModel($datosController, "users");

			if ($respuesta == "success") {

				header("location:template.php?action=cambio_usuario");
			} else {

				echo "error";
			}
		}
	}

	#BORRAR USUARIO
	#------------------------------------
	//Esta  funcion sirve para eliminar un usuario y notifica si se relaizo con exito o fallo
	public function borrarUsuarioController()
	{

		if (isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarUsuarioModel($datosController, "users");

			if ($respuesta == "success") {

				header("location:template.php?action=borrar_usuario");
			}
		}
	}

	////////////////////////////////////// CATEGORIAS  ///////////////////////////////////////////

	#REGISTRO DE CATEGORIAS
	#------------------------------------
	//En esta funcion se  valida la entrada del post nomnreRegistro para poder crear el arreglo de datos que trae el formulario de categorias y asi enviarlas al modelo para que se ejecute la operacion insert
	public function registroCategoriaController()
	{

		if (isset($_POST["nombreRegistro"])) {

			$datosController = array(
				"nombre" => $_POST["nombreRegistro"],

				"descripcion" => $_POST["desRegistro"]
			);

			$respuesta = Datos::registroCategoriaModel($datosController, "categorias");

			if ($respuesta == "success") {

				header("location:template.php?action=ok_categoria");
			} else {

				header("location:index.php");
			}
		}
	}



	#VISTA DE CATEGORIAS
	#------------------------------------
	// Esta funcion regresa toda la infromacion de las categorias en una tabla
	public function vistaCategoriasController()
	{

		$respuesta = Datos::vistaCategoriasModel("categorias");


		//ciclo que imprime los valores que trae respuesta del modelo
		foreach ($respuesta as $row => $item) {
			echo '<tr>
				<td>' . $item["id_categoria"] . '</td>
				<td>' . $item["nombre_categoria"] . '</td>
				<td>' . $item["descripcion_categoria"] . '</td>
				<td><a href="template.php?action=editar_categoria&id_categoria=' . $item["id_categoria"] . '"class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i></a></td>
				<td><a href="template.php?action=categorias&idBorrar=' . $item["id_categoria"] . '"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
			</tr>';
		}
	}


	#EDITAR CATEGORIA

	//Esta funcion se encarga de mostrar el formualrio para editar la informacion de la categoria selecionada
	public function editarCategoriaController()
	{

		$datosController = $_GET["id_categoria"];

		$respuesta = Datos::editarCategoriaModel($datosController, "categorias");

		echo '
			<div class="card-body">
					<input type="hidden" value="' . $respuesta["id_categoria"] . '" name="id_categoriaEditar">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control" value="' . $respuesta["nombre_categoria"] . '" name="nombreEditar" required>
					</div>
					<div class="form-group">
						<label for="descripcion">Descripcion</label>
						<input type="text" class="form-control"  value="' . $respuesta["descripcion_categoria"] . '" name="desEditar" required>
					</div>

					<button type="submit"  value="Actualizar" class="btn btn-block btn-success">Actualizar</button>
					</div>
			 </div>';
	}

	#ACTUALIZAR CATEGORIA
	#------------------------------------
	public function actualizarCategoriaController()
	{

		if (isset($_POST["nombreEditar"])) {

			$datosController = array(
				"id_categoria" => $_POST["id_categoriaEditar"],

				"nombre" => $_POST["nombreEditar"],

				"descripcion" => $_POST["desEditar"]
			);

			$respuesta = Datos::actualizarCategoriaModel($datosController, "categorias");

			if ($respuesta == "success") {

				header("location:template.php?action=cambio_categoria");
			} else {

				echo "error";
			}
		}
	}


	#BORRAR CATEGORIA
	#------------------------------------
	public function borrarCategoriaController()
	{

		if (isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$contar = Datos::contarCategoriaProductosModel($datosController, "categorias", "products");

			if ($contar["COUNT(*)"] == 0) {
				$respuesta = Datos::borrarCategoriaModel($datosController, "categorias");

				if ($respuesta == "success") {

					header("location:template.php?action=borrar_categoria");
				}
			} else if ($contar > 0) {

				echo '
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
              <h4><i class="icon fa fa-ban"></i> Alerta!</h4>
              Categoria asociada con 1 o mas productos!.
            </div>
          ';
			}
		}
	}


	////////////////////////////////////////////// PRODUCTOS ///////////////////////////////////

	#REGISTRAR UN PRODUCTO
	#---------------------------------------------------
	//En esta funcion se  valida la entrada del post codigoRegistro para poder crear el arreglo de datos que trae el formulario de productos y asi enviarlas al modelo para que se ejecute la operacion insert

	public function registroProductoController()
	{
		// Funcion para establecer zona horaria
		date_default_timezone_set("America/Mexico_City");
		//Se asigna la hora con un formato  de año-mes-dia hora-minuto-segundo
		$fecha_actual = date("Y-m-d H:i:s"); //
		//Funcion para cargar el archivp
		$check = @getimagesize($_FILES['imagenRegistro']['tmp_name']);

		if ($check !== false) {

			$carpeta_destino = '../imagenes/';
			$archivo_subir = $carpeta_destino . $_FILES['imagenRegistro']['name'];
			move_uploaded_file($_FILES['imagenRegistro']['tmp_name'], $archivo_subir);
		}

		if (isset($_POST["codigoRegistro"])) {

			$datosController = array(
				"codigo_producto" => $_POST["codigoRegistro"],

				"nombre_producto" => $_POST["nombreProductoRegistro"],

				"date_added" => $fecha_actual,

				"imagen" => $_FILES['imagenRegistro']['name'],

				"id_categoria" => $_POST["categoriaRegistro"],

				"precio_producto" => $_POST["precioRegistro"],

				"stock" => $_POST["stockRegistro"]
			);

			$respuesta = Datos::registroProductoModel($datosController, "products");

			if ($respuesta == "success") {

				header("location:template.php?action=ok_producto");
			} else {

				header("location:index.php");
			}
		}
	}

	# VISTA PRODUCTOS
	#------------------------------------------
	// Esta funcion regresa la informacion de la tabla products en una tabla
	public function vistaProductosController()
	{

		$respuesta = Datos::vistaProductosModel("products");


		//ciclo que imprime los valores que trae respuesta del modelo
		foreach ($respuesta as $row => $item) {
			echo '<tr>
				<td>' . $item["codigo_producto"] . '</td>
				<td>' . $item["nombre_producto"] . '</td>
				<td>  <img src=" ../imagenes/' . $item["imagen"] . ' " width="100" heigth="100" ></td>
				<td>' . $item["date_added"] . '</td>
				<td>' . '$ ' . $item["precio_producto"] . '</td>
				<td>' . $item["stock"] . '</td>
				<td><a href="template.php?action=stock&id_producto=' . $item["id_producto"] . '"class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a></td>
				<td><a href="template.php?action=editar_producto&id_producto=' . $item["id_producto"] . '"class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i></a></td>
				<td><a href="template.php?action=productos&idBorrar=' . $item["id_producto"] . '"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
			</tr>';
		}
	}



	#EDITAR PRODUCTO

	//Esta funcion se encarga de mostrar el formualrio para editar la informacion del producto selecionado

	public function editarProductoController()
	{

		$datosController = $_GET["id_producto"];
		$respuesta = Datos::editarProductoModel($datosController, "products");


		echo '
			<div class="card-body">
					<input type="hidden" value="' . $respuesta["id_producto"] . '" name="id_productoEditar">
					<div class="d-flex justify-content-center">
					<img src=" ../imagenes/' . $respuesta["imagen"] . ' " width="200" heigth="300" >
					</div>

					
					<div class="form-group">
					<label for="imagenRegistro">Imagen</label>

					<input type="file" class="form-control" name="imagenRegistro" required>
				</div>

					<div class="form-group">
						<label for="codigoEditar">Codigo del Producto</label>
						<input type="number" class="form-control" value="' . $respuesta["codigo_producto"] . '" name="codigoEditar" required>
					</div>

					<div class="form-group">
						<label for="nombreProductoEditar">Nombre del Producto</label>
						<input type="text" class="form-control"  value="' . $respuesta["nombre_producto"] . '" name="nombreProductoEditar" required>
					</div>

					<div class="form-group">
						<label for="precioEditar">Precio</label>
						<input type="number" class="form-control"  value="' . $respuesta["precio_producto"] . '" name="precioEditar" required>
					</div>


					<button type="submit"  value="Actualizar" class="btn btn-block btn-success">Actualizar</button>
					</div>
			 </div>';
	}

	#ACTUALIZAR PRODUCTO
	#------------------------------------
	public function actualizarProductoController()
	{
		$check = @getimagesize($_FILES['imagenRegistro']['tmp_name']);

		if ($check !== false) {

			$carpeta_destino = '../imagenes/';
			$archivo_subir = $carpeta_destino . $_FILES['imagenRegistro']['name'];
			move_uploaded_file($_FILES['imagenRegistro']['tmp_name'], $archivo_subir);
		}

		if (isset($_POST["codigoEditar"])) {

			$datosController = array(
				"id_producto" => $_POST["id_productoEditar"],

				"codigo_producto" => $_POST["codigoEditar"],

				"nombre_producto" => $_POST["nombreProductoEditar"],

				"imagen" => $_FILES['imagenRegistro']['name'],

				"precio_producto" => $_POST["precioEditar"],

				"user_id" => $_SESSION['user_id'],

				"user_name" => $_SESSION['user_name']
			);

			$respuesta = Datos::actualizarProductoModel($datosController, "products");

			if ($respuesta == "success") {

				header("location:template.php?action=cambio_producto");
			} else {

				echo "error";
			}
		}
	}


	#BORRAR Producto
	#------------------------------------
	public function borrarProductoController()
	{

		if (isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarProductoModel($datosController, "products");

			if ($respuesta == "success") {

				header("location:template.php?action=borrar_producto");
			}
		}
	}


	//////////////////////////////////////////////// HISTORIAL //////////////////////////////////////////


	#VISTA HISTORIAL PARA UN PRODUCTO
	// Esta funcion  regresa la informacion del hisotrial de un producto en especifico
	public function vistaHistorialController()
	{

		$datosController = $_GET["id_producto"];
		$respuesta = Datos::vistaHistorialModel($datosController, "historial");


		//ciclo que imprime los valores que trae respuesta del modelo
		foreach ($respuesta as $row => $item) {
			echo '<tr>
				<td>' . $item["fecha"] . '</td>
				<td>' . $item["nota"] . '</td>
				<td>' . $item["referencia"] . '</td>
				<td>' . $item["cantidad"] . '</td>
			</tr>';
		}
	}



	#VISTA HISTORIAL PARA TODOS  LOS PRODUCTOS
	// Esta funcion  regresa la informacion del hisotrial de todos los productos

	public function vistaHistorialAllController()
	{

		$respuesta = Datos::vistaHistorialAllModel("historial");

		//ciclo que imprime los valores que trae respuesta del modelo
		foreach ($respuesta as $row => $item) {
			echo '<tr>
				<td>' . $item["fecha"] . '</td>
				<td>' . $item["nota"] . '</td>
				<td>' . $item["referencia"] . '</td>
				<td>' . $item["cantidad"] . '</td>
			</tr>';
		}
	}



	////////////////////////////////////////////// STOCK /////////////////////////////////////////////////
	#AGREGAR STOCK
	//Esta funcion sirve para el control de stock, depediendo de la entrada puede agregar o decrementar el stock del producto
	public function obtenerStockController()
	{
		//Funcion para establaecer la zona horaria
		date_default_timezone_set("America/Mexico_City");
		//se agrega la fecha y hora actual
		$fecha_actual = date("Y-m-d H:i:s");
		$datosController = $_GET["id_producto"];

		$obtener = Datos::valorStockModel($datosController, "products");

		$actual = $obtener["stock"];

		echo '
				<div class="form-group">
					<label for="stockEditar">Valor actual</label>
					<input type="number" disabled class="form-control"  value="' . $actual . '" name="actual" required>
				</div>';

		//Se verifica que exita un post de cantidad para relizar la operacion
		if (isset($_POST["cantidad"])) {
			$nuevo = intval($_POST["cantidad"]);

			//Se verifica si se aumentara o decrementara segun la entra del radio button
			if ($_POST["Radio"] == "+") {
				$stock = $actual + $nuevo;
				$nota = $_SESSION['nombre1'] . " " .
					"agrego " . $nuevo . " producto(S) al inventario.";
			} else {
				$stock = $actual - $nuevo;
				$nota = $_SESSION['nombre1'] . " " .
					"elimino " . $nuevo . " producto(S) al inventario.";
			}


			$datosController2 = array(
				"id_producto" => $datosController,
				"cantidad" => $stock
			);

			$datosController3 = array(
				"id_producto" => $datosController,
				"user_id" => $_SESSION['user_id'],
				"fecha" => $fecha_actual,
				"nota" => $nota,
				"referencia" => $_POST["referencia"],
				"cantidad" => $nuevo
			);

			//Se envia la oprecion de edicion de stock del producto
			$respuesta = Datos::editarStockModel($datosController2, "products");
			//Se inserta en el historial la oprecion que se realizo
			$respuesta2 = Datos::insertarHistorialModel($datosController3, "historial");

			// Se verifican las 2 respuetas de los modelos para pasar a notificar el exito de la operacion
			if ($respuesta == "success" && $respuesta2 == "success") {

				header("location:template.php?action=productos");
			} else {

				header("location:index.php");
			}
		}
	}

	////////////////////////////////////////// Lista dinamica ////////////////////////

	public function listaAnidada()
	{

		$id_categoria = $_POST["id_categoria"];

		$respuesta = Datos::ObtenerProductos($id_categoria, "productos");

		if ($respuesta == "success") {


			header("location:views/template.php?action=ventas");
		} else {

			header("location:index.php");
		}
	}


	//////////////////////////////////////////// CLIENTES /////////////////////////////////////

	////////////////////////////////////// CLIENTES  ///////////////////////////////////////////

	#REGISTRO DE CLIENTES
	#------------------------------------
	//En esta funcion se  valida la entrada del post nomnreRegistro para poder crear el arreglo de datos que trae el formulario de clientes y asi enviarlas al modelo para que se ejecute la operacion insert
	public function registroClienteController()
	{

		if (isset($_POST["nombreRegistro"])) {

			$datosController = array(
				"nombre_cliente" => $_POST["nombreRegistro"],
				"email_cliente" => $_POST["emailRegistro"],
				"rfc" => $_POST["rfcRegistro"]
			);

			$respuesta = Datos::registroClienteModel($datosController, "clientes");

			if ($respuesta == "success") {

				header("location:template.php?action=ok_cliente");
			} else {

				header("location:index.php");
			}
		}
	}



	#VISTA DE CLIENTES
	#------------------------------------
	// Esta funcion regresa toda la infromacion de las clientes en una tabla
	public function vistaClientesController()
	{

		$respuesta = Datos::vistaClientesModel("clientes");


		//ciclo que imprime los valores que trae respuesta del modelo
		foreach ($respuesta as $row => $item) {
			echo '<tr>
			<td>' . $item["id_cliente"] . '</td>
			<td>' . $item["nombre_cliente"] . '</td>
			<td>' . $item["rfc"] . '</td>
			<td>' . $item["email_cliente"] . '</td>
			<td><a href="template.php?action=editar_cliente&id_cliente=' . $item["id_cliente"] . '"class="btn btn-sm btn-warning text-white"><i class="fa fa-edit"></i></a></td>
			<td><a href="template.php?action=clientes&idBorrar=' . $item["id_cliente"] . '"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
		</tr>';
		}
	}


	#EDITAR CLIENTE

	//Esta funcion se encarga de mostrar el formualrio para editar la informacion de la cliente selecionada
	public function editarClienteController()
	{

		$datosController = $_GET["id_cliente"];

		$respuesta = Datos::editarClienteModel($datosController, "clientes");

		echo '
		<div class="card-body">
				<input type="hidden" value="' . $respuesta["id_cliente"] . '" name="id_clienteEditar">
				<div class="form-group">
					<label for="nombre">Nombre</label>
					<input type="text" class="form-control" value="' . $respuesta["nombre_cliente"] . '" name="nombreEditar" required>
				</div>
				<div class="form-group">
					<label for="email">RFC</label>
					<input type="text" class="form-control"  value="' . $respuesta["rfc"] . '" name="rfcEditar" required>
				</div>

				<div class="form-group">
					<label for="email">Email</label>
					<input type="text" class="form-control"  value="' . $respuesta["email_cliente"] . '" name="emailEditar" required>
				</div>

				<button type="submit"  value="Actualizar" class="btn btn-block btn-success">Actualizar</button>
				</div>
		 </div>';
	}

	#ACTUALIZAR CLIENTE
	#------------------------------------
	public function actualizarClienteController()
	{

		if (isset($_POST["nombreEditar"])) {

			$datosController = array(
				"id" => $_POST["id_clienteEditar"],
				"nombre" => $_POST["nombreEditar"],
				"email" => $_POST["emailEditar"],
				"rfc" => $_POST["rfcEditar"]
			);

			$respuesta = Datos::actualizarClienteModel($datosController, "clientes");

			if ($respuesta == "success") {

				header("location:template.php?action=cambio_cliente");
			} else {

				echo "error";
			}
		}
	}

	#BORRAR CLEINTE
	#------------------------------------
	public function borrarClienteController()
	{

		if (isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarClienteModel($datosController, "clientes");

			if ($respuesta == "success") {

				header("location:template.php?action=borrar_cliente");
			}
		}
	}



	////////////////////////////////////////// DETALLE DE VENTA //////////////////////////////////////////////

	#AGREGAR AL DETALLE DE VENTA

	//En esta funcion   valida la entrada del post cantidad para poder crear el arreglo de datos que trae el formulario de carrito y asi enviarlas al modelo para que se ejecute la operacion insert
	public function agregarCarritoController()
	{

		if (isset($_POST["cantidad"])) {

			$id_producto = $_POST["id_producto"];

			$info_producto = Datos::info_ProductoModel($id_producto, "products");

			$precio = $info_producto["precio_producto"];
			$exitencia = $info_producto["stock"];
			$cantidad = intval($_POST["cantidad"]);
			$importe = $precio * $cantidad;

			echo '<h1>' . $precio . '</h1>';

			///Validar que la  cantidad no supere el stock

			if ($exitencia > $cantidad) {
				$verificar = Datos::Existencia_en_Carrito_Model($id_producto, "detalle_venta");

				if ($verificar == TRUE) {

					$carrito = Datos::info_Carrito_Model($id_producto, "detalle_venta");
					$cantida_en_carrito = $carrito["cantidad"];
					$id_carrito = $carrito["id_detalle_venta"];

					$nueva_cantidad = $cantida_en_carrito + $cantidad;
					$nuevo_importe = $nueva_cantidad * $precio;

					$datos = array(
						"id_detalle_venta" => $id_carrito,
						"cantidad" => $nueva_cantidad,
						"importe" => $nuevo_importe
					);


					$actulizar = Datos::actualizarCarritoModel($datos, "detalle_venta");

					if ($actulizar == "success") {

						header("location:template.php?action=cambio_carrito");
					} else {

						header("location:template.php?action=cambio_fallo_carrito");
					}
				} else {

					$datosController = array(
						"id_producto" => $id_producto,
						"cantidad" => $cantidad,
						"importe" => $importe
					);


					$respuesta = Datos::agregarCarritoModel($datosController, "detalle_venta");

					if ($respuesta == "success") {



						header("location:template.php?action=ok_carrito");
					} else {

						header("location:template.php?action=fallo_carrito");
					}
				}
			} else {

				header("location:template.php?action=supera_stock");
			}
		}
	}



	# VISTA DEL DETALLE DE VENTA
	// Esta funcion muestra los producos que se almacenaron en el detalle de venta  y realiza las operaciones de el subtotal, iva, descuento y total
	public function vistaCarritoController()
	{

		$respuesta = Datos::vistaCarritoModel("products", "detalle_venta");
		$total = 0.0;
		$iva = 0.0;
		$descueto = 0;
		foreach ($respuesta as $row => $item) {

			echo '<tr>
				<td>' . $item["nombre_producto"] . '</td>
				<td>' . $item["precio_producto"] . '</td>
				<td>' . $item["cantidad"] . '</td>
				<td>' . '<span class="input-group-addon">$</span>' . $item["importe"] . '</td>
				<td><a href="template.php?action=ventas&idBorrar=' . $item["id_producto"] . '"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
			</tr>';

			// se genera el susbtotal de los productos
			$total = $total + $item["importe"];
		}
		// Se genera el  iva
		$iva =  ($total / 100) * 16;
		//Se genera el total final
		$final = ($total - $descueto) + $iva;
		echo '</tbody>

			</table>
		
			
		<div class="row  bg-light p-2 m-2">

	
			<div class="col-6">
			<h5> Numero de Productos</h5>
			</div>
			<div class="col-4 ">
				<div class="d-flex justify-content-end">
					<h5>Total Productos</h5>
				</div>
	
				<div class="d-flex justify-content-end">
					<h5> IVA</h5>
				</div>
				<div class="d-flex justify-content-end">
					<h5> Descuento</h5>
				</div>
				<div class="d-flex justify-content-end">
					<h5>Final Total</h5>
				</div>
				
			</div>

			<div class="col-2 ">
			<div class="d-flex justify-content-end">
			<h5>' . '<span class="input-group-addon">$</span>'  . $total . '</h5>	
		</div>
	
				<div class="d-flex justify-content-end">
					<h5>' . '<span class="input-group-addon">$</span>'  . $iva . '</h5>
				</div>

				<div class="d-flex justify-content-end">
					<h5>' . '<span class="input-group-addon">$</span>'  . $descueto . '</h5>	
				</div>
				<div class="d-flex justify-content-end">
					<h5>' . '<span class="input-group-addon">$</span>'  . $final . '</h5>	
				</div>

			
			</div>



	
		</div>
		
		 <div class="m-2">
		 
			 <form method="post">
				
				 <input type="hidden" class="form-control" name="total" value="' . $final . '">
				 <button type="submit" value="Enviar" class="btn btn-primary">Pagar</button> 

			</form>
		 </div>';
	}

	#BORRAR Producto
	#------------------------------------
	public function borrarProductoCarritoController()
	{

		if (isset($_GET["idBorrar"])) {

			$datosController = $_GET["idBorrar"];

			$respuesta = Datos::borrarProductoModel($datosController, "detalle_venta");

			if ($respuesta == "success") {

				header("location:template.php?action=ventas");
			}
		}
	}



	/////////////////////////////////////////// VENTAS ///////////////////////////////////////////////

	#Registro de Ventas
	#----------------------------------------------------------------


	//En esta funcion se  valida la entrada del post totla para poder crear el arreglo de datos que trae el formulario de ventas y asi enviarlas al modelo para que se ejecute la operacion insert
	public function registroVentaController()
	{
		date_default_timezone_set("America/Mexico_City");
		$fecha_actual = date("Y-m-d H:i:s");
		if (isset($_POST["total"])) {

			$datosController = array(
				"total" => $_POST["total"],


				"fecha_venta" => $fecha_actual,



			);

			$respuesta = Datos::registroVentaModel($datosController, "ventas");

			if ($respuesta == "success") {



				$vaciar = Datos::vaciarCarritoModel();
				header("location:template.php?action=ok_venta");
			} else {

				header("location:index.php");
			}
		}
	}



	#AGREGAR STOCK
	public function ModificarStockController()
	{
		date_default_timezone_set("America/Mexico_City");
		$fecha_actual = date("Y-m-d H:i:s");
		$datosController = $_POST["id_producto"];
		$obtener = Datos::valorStockModel($datosController, "products");

		$actual = $obtener["stock"];


		if (isset($_POST["cantidad"])) {
			$nuevo = intval($_POST["cantidad"]); {
				$stock = $actual - $nuevo;
				$nota = $_SESSION['nombre1'] . " " .
					"vendio " . $nuevo . " producto(S).";
			}


			$datosController2 = array(
				"id_producto" => $datosController,
				"cantidad" => $stock
			);

			$datosController3 = array(
				"id_producto" => $datosController,
				"user_id" => $_SESSION['user_id'],
				"fecha" => $fecha_actual,
				"nota" => $nota,
				"referencia" => $_POST["referencia"],
				"cantidad" => $nuevo
			);

			$respuesta = Datos::editarStockModel($datosController2, "products");
			$respuesta2 = Datos::insertarHistorialModel($datosController3, "historial");
			if ($respuesta == "success" && $respuesta2 == "success") {

				header("location:template.php?action=productos");
			} else {

				header("location:index.php");
			}
		}
	}
}
