<?php

require_once "conexion.php";

class Datos extends Conexion
{


	#-------------------------------------------------------
	#CONTAR FILAS DE LAS TABLAS

	public function ContRowsModel($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT count(*) FROM $tabla ");


		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_NUM);

		$stmt->close();
	}


	#-------------------------------------------------------
	#REGRESAR VALOR DEL STOCK

	public function valorStockModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT stock FROM $tabla WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);


		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}


	#-------------------------------------------------------
	#REGRESAR PRECIO PORDUCTO

	public function precioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT precio_producto FROM $tabla WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);


		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}






	#Editar Stock
	#-------------------------------------
	public function editarStockModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  stock = :cantidad WHERE id_producto = :id_producto");

		$stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datosModel["id_producto"], PDO::PARAM_INT);


		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}

	#INGRESO USUARIO
	#-------------------------------------
	public function ingresoUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT user_id, firstname, lastname, user_name, user_password_hash FROM $tabla WHERE user_name = :user_name");
		$stmt->bindParam(":user_name", $datosModel["user_name"], PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();

		$stmt->close();
	}


	#REGISTRO USUARIO
	#-----------------------------------------
	public function registroUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (firstname, lastname, user_name, user_password_hash,id_tipo, user_email, date_added) VALUES (:firstname,:lastname, :user_name, :user_password_hash, :id_tipo,:user_email, :date_added)");

		$stmt->bindParam(":firstname", $datosModel["firstname"], PDO::PARAM_STR);
		$stmt->bindParam(":lastname", $datosModel["lastname"], PDO::PARAM_STR);
		$stmt->bindParam(":user_name", $datosModel["user_name"], PDO::PARAM_STR);
		$stmt->bindParam(":user_password_hash", $datosModel["user_password_hash"], PDO::PARAM_STR);
		$stmt->bindParam(":id_tipo", $datosModel["tipo"], PDO::PARAM_INT);
		$stmt->bindParam(":user_email", $datosModel["user_email"], PDO::PARAM_STR);
		$stmt->bindParam(":date_added", $datosModel["date_added"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}

	#VISTA USUARIOS
	#-------------------------------------

	public function vistaUsuariosModel($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT user_id, firstname, lastname, user_name, user_email, date_added FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}

	#EDITAR USUARIO
	#-------------------------------------

	public function editarUsuarioModel($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT user_id, firstname, lastname, user_name, user_email  FROM $tabla WHERE user_id = :user_id");

		$stmt->bindParam(":user_id", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET user_id = :user_id, firstname = :firstname, lastname = :lastname, user_name = :user_name, user_password_hash =:user_password_hash, id_tipo =:id_tipo , user_email = :user_email WHERE user_id = :user_id");

		$stmt->bindParam(":firstname", $datosModel["firstname"], PDO::PARAM_STR);
		$stmt->bindParam(":lastname", $datosModel["lastname"], PDO::PARAM_STR);
		$stmt->bindParam(":user_name", $datosModel["user_name"], PDO::PARAM_STR);
		$stmt->bindParam(":user_password_hash", $datosModel["user_password_hash"], PDO::PARAM_STR);
		$stmt->bindParam(":user_email", $datosModel["user_email"], PDO::PARAM_STR);
		$stmt->bindParam(":user_id", $datosModel["user_id"], PDO::PARAM_INT);
		$stmt->bindParam(":id_tipo", $datosModel["id_tipo"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}


	#BORRAR USUARIO
	#------------------------------------
	public function borrarUsuarioModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE user_id = :idBorrar");
		$stmt->bindParam(":idBorrar", $datosModel, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}


	#REGISTRO DE CATEGORIAS
	#-------------------------------------
	public function registroCategoriaModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_categoria, descripcion_categoria) VALUES (:nombre,:descripcion)");

		$stmt->bindParam(":nombre", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion", $datosModel["descripcion"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}


	#-------------------------------------------------------
	#REGRESAR INFORMACION PORDUCTO

	public function info_ProductoModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);


		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}


	#VISTA CATEGORIAS
	#-------------------------------------

	public function vistaCategoriasModel($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}


	#EDITAR USUARIO
	#-------------------------------------

	public function editarCategoriaModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id_categoria, nombre_categoria, descripcion_categoria FROM $tabla WHERE id_categoria = :id_categoria");

		$stmt->bindParam(":id_categoria", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#ACTUALIZAR USUARIO
	#-------------------------------------
	public function actualizarCategoriaModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria, nombre_categoria = :nombre_categoria, descripcion_categoria = :descripcion_categoria WHERE id_categoria = :id_categoria");

		$stmt->bindParam(":nombre_categoria", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":descripcion_categoria", $datosModel["descripcion"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datosModel["id_categoria"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}



	#BORRAR CATEGORIAS
	#------------------------------------
	public function borrarCategoriaModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_categoria = :idBorrar");
		$stmt->bindParam(":idBorrar", $datosModel, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}




	#CONTAR SI HAY PRODUCTOS

	public function contarCategoriaProductosModel($datosModel, $tabla, $tabla1)
	{

		$stmt = Conexion::conectar()->prepare("SELECT COUNT(*) FROM $tabla INNER JOIN $tabla1 ON $tabla.id_categoria = $tabla1.id_categoria WHERE $tabla.id_categoria = :idBorrar");

		$stmt->bindParam(":idBorrar", $datosModel, PDO::PARAM_INT);

		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}




	public function ObtenerCategorias($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT id_categoria, nombre_categoria, descripcion_categoria FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}


	public function ObtenerTipos($tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT id_tipo, nombre FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}



	static function ObtenerProductos($id)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM products  WHERE id_categoria= $id ");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}



	public function registroProductoModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (codigo_producto, nombre_producto,imagen, date_added, precio_producto, stock, id_categoria) VALUES (:codigo_producto,:nombre_producto, :imagen , :date_added, :precio_producto, :stock, :id_categoria)");

		$stmt->bindParam(":codigo_producto", $datosModel["codigo_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_producto", $datosModel["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_LOB);
		$stmt->bindParam(":date_added", $datosModel["date_added"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_producto", $datosModel["precio_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":stock", $datosModel["stock"], PDO::PARAM_STR);
		$stmt->bindParam(":id_categoria", $datosModel["id_categoria"], PDO::PARAM_STR);



		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}



	#---------------------------------------------------


	# Vista Productos


	public function vistaProductosModel($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}


	#------------------------------------------------------


	#EDITAR PRODUCTO
	#-------------------------------------

	public function editarProductoModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id_producto, codigo_producto, nombre_producto, precio_producto, stock , imagen FROM $tabla WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#ACTUALIZAR PRODUCTO
	#-------------------------------------

	public function actualizarProductoModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET id_producto = :id_producto, codigo_producto = :codigo_producto, nombre_producto = :nombre_producto, imagen = :imagen, precio_producto = :precio_producto WHERE id_producto = :id_producto");

		$stmt->bindParam(":codigo_producto", $datosModel["codigo_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":nombre_producto", $datosModel["nombre_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":imagen", $datosModel["imagen"], PDO::PARAM_LOB);
		$stmt->bindParam(":precio_producto", $datosModel["precio_producto"], PDO::PARAM_STR);
		$stmt->bindParam(":id_producto", $datosModel["id_producto"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {
			return "error";
		}

		$stmt->close();
	}



	#BORRAR PRODUCTO
	#------------------------------------
	public function borrarProductoModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :idBorrar");
		$stmt->bindParam(":idBorrar", $datosModel, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}




	#----------------------------------------------------

	#VISTA HISTORIAL

	public function vistaHistorialModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}


	public function vistaHistorialAllModel($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}



	#INSERTAR HISTORIAL
	public function insertarHistorialModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (id_producto, user_id, fecha, nota, referencia, cantidad) VALUES (:id_producto, :user_id, :fecha, :nota, :referencia, :cantidad)");

		$stmt->bindParam(":id_producto", $datosModel["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":user_id", $datosModel["user_id"], PDO::PARAM_INT);

		$stmt->bindParam(":fecha", $datosModel["fecha"], PDO::PARAM_STR);
		$stmt->bindParam(":nota", $datosModel["nota"], PDO::PARAM_STR);
		$stmt->bindParam(":referencia", $datosModel["referencia"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}

	public function ExitenciaIDModel($tabla, $datosModel)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id_producto FROM $tabla  WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);


		if ($stmt->rowCount() == 0) {
			return "error";
		} else {


			return "success";
		}

		$stmt->close();
	}


	///////////////////////////////////// CLIENTES ////////////////////////////


	#REGISTRO CLIENTE
	#-----------------------------------------
	public function registroClienteModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_cliente, rfc, email_cliente ) VALUES (:nombre_cliente, :rfc , :email_cliente)");


		$stmt->bindParam(":nombre_cliente", $datosModel["nombre_cliente"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":email_cliente", $datosModel["email_cliente"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}

	#VISTA CLIENTE
	#-------------------------------------

	public function vistaClientesModel($tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id_cliente, nombre_cliente, rfc, email_cliente  FROM $tabla");
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}

	#EDITAR CLIENTE
	#-------------------------------------

	public function editarClienteModel($datosModel, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT id_cliente, nombre_cliente, rfc, email_cliente   FROM $tabla WHERE id_cliente = :id_cliente");

		$stmt->bindParam(":id_cliente", $datosModel, PDO::PARAM_INT);
		$stmt->execute();

		return $stmt->fetch();

		$stmt->close();
	}

	#ACTUALIZAR USUARIO
	#-------------------------------------

	public function actualizarClienteModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  nombre_cliente = :nombre_cliente , email_cliente = :email_cliente ,  rfc =:rfc WHERE id_cliente = :id_cliente");


		$stmt->bindParam(":nombre_cliente", $datosModel["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
		$stmt->bindParam(":email_cliente", $datosModel["email"], PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente", $datosModel["id"], PDO::PARAM_INT);


		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}


	#BORRAR USUARIO
	#------------------------------------
	public function borrarClienteModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_cliente = :idBorrar");
		$stmt->bindParam(":idBorrar", $datosModel, PDO::PARAM_INT);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}




	////////////////////////// Agregar al  Carrito ///////////////////////////


	public function agregarCarritoModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (cantidad, importe, id_producto) VALUES (:cantidad,:importe,:id_producto )");


		$stmt->bindParam(":id_producto", $datosModel["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":importe", $datosModel["importe"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}



	#REGRESAR INFORMACION CARRITO
	public function info_Carrito_Model($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE id_producto = $datosModel");


		$stmt->execute();

		return $stmt->fetchColumn();

		$stmt->close();
	}




	#-------------------------------------------------------
	#VERIFICA EXISTENCIA EN EL CARRITO

	public function Existencia_en_Carrito_Model($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("SELECT id_producto FROM $tabla WHERE id_producto = :id_producto");

		$stmt->bindParam(":id_producto", $datosModel, PDO::PARAM_INT);


		$stmt->execute();

		if ($stmt->fetchColumn() > 0) {
			$total = TRUE;
		} else {

			$total = FALSE;
		}

		return $total;
		$stmt->close();
	}

	public function actualizarCarritoModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  cantidad = :cantidad, importe=: importe WHERE id_detalle_venta = :id_detalle_venta");

		$stmt->bindParam(":id_detalle_venta", $datosModel["id_detalle_venta"], PDO::PARAM_INT);
		$stmt->bindParam(":cantidad", $datosModel["cantidad"], PDO::PARAM_INT);
		$stmt->bindParam(":importe", $datosModel["importe"], PDO::PARAM_STR);

		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}


	#VISTA HISTORIAL

	public function vistaCarritoModel($tabla, $tabla1)
	{

		$stmt = Conexion::conectar()->prepare("SELECT  A.id_producto,A.nombre_producto, A.precio_producto, B.cantidad,B.importe  FROM $tabla A INNER JOIN $tabla1 AS B ON A.id_producto=B.id_producto
		");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}



	public function vaciarCarritoModel()
	{

		$stmt = Conexion::conectar()->prepare("DELETE FROM detalle_venta");


		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}



	//////////////////////// Ventas ////////////

	public function registroVentaModel($datosModel, $tabla)
	{

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (total, fecha_venta) VALUES ( :total, :fecha_venta)");

		$stmt->bindParam(":total", $datosModel["total"], PDO::PARAM_STR);

		$stmt->bindParam(":fecha_venta", $datosModel["fecha_venta"], PDO::PARAM_STR);


		if ($stmt->execute()) {

			return "success";
		} else {

			return "error";
		}

		$stmt->close();
	}
}
