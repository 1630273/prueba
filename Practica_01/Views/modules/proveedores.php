<?php

session_start();
if (!$_SESSION["validar"]) {
    header("location:index.php?action=ingresar");
    exit();
}

?>
<div class="row  justify-content-around">
    <div class="col-6  ">
        <div class="d-flex justify-content-center">
            <p class="h2 text-primary ">LISTAR PROVEEDORES</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Clave</th>
                    <th>Nombre</th>
                    <th>RFC</th>
                    <th>Empresa</th>
                    <th>Tipo</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $vistaproveedor = new MvcController();
                $vistaproveedor->vistaProveedorController();
                $vistaproveedor->borrarProveedorController();

                ?>
            </tbody>
        </table>

        <?php

        if (isset($_GET["action"])) {
            if ($_GET["action"] == "cambio_proveedor") {
                echo '<div class="bg-success text-white">
                
                <h4>Cambio exitoso</h4>
                
                <div>';
            }
        }
        ?>

    </div>
</div>