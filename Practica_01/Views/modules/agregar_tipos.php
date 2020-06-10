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
            <p class="h2 text-primary ">REGISTRO DE TIPO DE PROVEEDOR </p>
        </div>
        <form method="post">
            <div class="form-group">
                <label for="Nombre">Nombre de la empresa</label>
                <input type="text" class="form-control" placeholder="Nombre de la Tipo" name="nombre_tipo" required>

            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>

        </form>

        <?php

        //Enviar los registros al controlador

        $registro = new MvcController;
        $registro->registroTipoController();

        if (isset($_GET["action"])) {
            if ($_GET["action"] == "ok_tipo") {
                echo "Registro exitoso";
            }
        }
        ?>