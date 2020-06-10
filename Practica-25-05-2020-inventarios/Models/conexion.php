<?php

class Conexion
{

	public function conectar()
	{

		$link = new PDO("mysql:host=localhost;dbname=simple_stock", "root", "");
		return $link;
	}
}

class lista
{

	static function ObtenerProductos($id, $tabla)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $id");

		$stmt->execute();

		return $stmt->fetchAll();

		$stmt->close();
	}
}
