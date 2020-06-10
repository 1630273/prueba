<?php

class Paginas
{

    public function enlacesPaginasModel($enlaces)
    {
        if (
            $enlaces == 'ingresar' || $enlaces == 'usuarios' || $enlaces == 'editar' ||
            $enlaces == 'empresas' || $enlaces == 'proveedores' || $enlaces == 'tipos' ||
            $enlaces == 'agregar_empresas' || $enlaces == 'agregar_proveedores' || $enlaces == 'agregar_tipos' ||
            $enlaces == 'editar_empresa' || $enlaces == 'editar_proveedor' || $enlaces == 'editar_tipo' ||


            $enlaces == 'salir'
        ) {

            $module = 'Views/modules/' . $enlaces . '.php';
        } else if ($enlaces == 'index') {
            $module = 'Views/modules/registro.php';
        } else if ($enlaces == 'ok') {
            $module = 'Views/modules/registro.php';
        } else if ($enlaces == 'fallo') {
            $module = 'Views/modules/ingresar.php';
        } else if ($enlaces == 'cambio') {
            $module = 'Views/modules/usuarios.php';
        } else if ($enlaces == 'ok_empresa') {
            $module = 'Views/modules/agregar_empresas.php';
        } else if ($enlaces == 'cambio_empresa') {
            $module = 'Views/modules/empresas.php';
        } else if ($enlaces == 'ok_tipo') {
            $module = 'Views/modules/agregar_tipos.php';
        } else if ($enlaces == 'cambio_tipo') {
            $module = 'Views/modules/tipos.php';
        } else if ($enlaces == 'ok_proveedor') {
            $module = 'Views/modules/agregar_proveedores.php';
        } else if ($enlaces == 'ok_proveedor_fallo') {
            $module = 'Views/modules/agregar_proveedores.php';
        } else if ($enlaces == 'cambio_proveedor') {
            $module = 'Views/modules/proveedores.php';
        } else {
            $module = 'Views/modules/registro.php';
        }

        return $module;

        //INCLUIR LAS URL DE LAS VISTAS 
    }
}
