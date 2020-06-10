<?php

class Paginas
{

	public function enlacesPaginasModel($enlaces)
	{


		if ($enlaces == "ingresar" || $enlaces == "inicio" || $enlaces == "registro" ||   $enlaces == "clientes" || $enlaces == "usuarios" || $enlaces == "editar" || $enlaces == "registro_categoria" || $enlaces == "registro_cliente" || $enlaces == "categorias" || $enlaces == "editar_categoria"  || $enlaces == "editar_cliente"  || $enlaces == "salir" || $enlaces == "registro_producto" || $enlaces == "productos" || $enlaces == "editar_producto" || $enlaces == "ventas" || $enlaces == "historial_venta" || $enlaces == "stock") {

			$module =  "../views/modules/" . $enlaces . ".php";
		} else if ($enlaces == "ok_usuario") {
			$module =  "../views/modules/usuarios.php";
		} else if ($enlaces == "cambio_usuario") {
			$module =  "../views/modules/usuarios.php";
		} else if ($enlaces == "borrar_usuario") {
			$module =  "../views/modules/usuarios.php";
		} else if ($enlaces == "ok_categoria") {
			$module =  "../views/modules/categorias.php";
		} else if ($enlaces == "cambio_categoria") {
			$module =  "../views/modules/categorias.php";
		} else if ($enlaces == "borrar_categoria") {
			$module =  "../views/modules/categorias.php";
		} else if ($enlaces == "ok_producto") {
			$module =  "../views/modules/productos.php";
		} else if ($enlaces == "cambio_producto") {
			$module =  "../views/modules/productos.php";
		} else if ($enlaces == "borrar_producto") {
			$module =  "../views/modules/productos.php";
		} else if ($enlaces == "ok_cliente") {
			$module =  "../views/modules/clientes.php";
		} else if ($enlaces == "cambio_cliente") {
			$module =  "../views/modules/clientes.php";
		} else if ($enlaces == "borrar_cliente") {
			$module =  "../views/modules/clientes.php";
		} else if ($enlaces == "ok_carrito") {
			$module =  "../views/modules/ventas.php";
		} else if ($enlaces == "cambio_carrito") {
			$module =  "../views/modules/ventas.php";
		} else if ($enlaces == "fallo_carrito") {
			$module =  "../views/modules/ventas.php";
		} else if ($enlaces == "cambio_fallo_carrito") {
			$module =  "../views/modules/ventas.php";
		} else if ($enlaces == "supera_stock") {
			$module =  "../views/modules/ventas.php";
		} else if ($enlaces == "ok_venta") {
			$module =  "../views/modules/ventas.php";
		} else {

			$module =  "../views/modules/ingresar.php";
		}

		return $module;
	}
}
