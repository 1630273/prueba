<?php

include "../Models/crud.php";

# code...

$id = $_POST["id"];
echo $id;

$productos = Datos::ObtenerProductos($id);

foreach ($productos as $key => $value) {
    echo '<option value="' . $value["id_producto"] . '">' . $value["nombre_producto"] . '</option>';
}
