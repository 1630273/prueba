<?php

session_start();
if (!$_SESSION["validar"]) {
    header("location:index.php?action=ingresar");
    exit();
}

?>
<div class="row  justify-content-around">
    <div class="col-4  ">
        <div class="d-flex justify-content-center">
            <p class="h2 text-primary ">LISTAR TIPOS DE PROVEEDOR </p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nombre Tipo de Proveedor</th>

                    <th>Editar</th>
                    <th>Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $vistaTipo = new MvcController();
                $vistaTipo->vistaTiposController();
                $vistaTipo->borrarTipoController();

                ?>
            </tbody>
        </table>


        <?php

        if (isset($_GET["action"])) {
            if ($_GET["action"] == "cambio_tipo") {
                echo '<div class="bg-success text-white">
                
                <h4>Cambio exitoso</h4>
                
                <div>';
            }
        }
        ?>
    </div>
</div>