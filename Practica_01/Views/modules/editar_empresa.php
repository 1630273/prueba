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
            <p class="h2 text-primary ">EDITAR EMPRESA </p>
        </div>
        <form method="post">
            <?php
            $editarEmpresa = new MvcController();
            $editarEmpresa->editarEmpresaController();
            $editarEmpresa->actualizarEmpresaController();
            ?>

        </form>

    </div>
</div>