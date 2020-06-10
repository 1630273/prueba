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
            <p class="h2 text-primary ">REGISTRO DE PROVEEDORES </p>
        </div>
        <form method="post">


            <div class="form-group">
                <label for="clave">Clave</label>
                <input type="text" class="form-control" name="clave" required></div>

            <div class="form-group">
                <label for="nombre_proveedor">Nombre del Proveedor</label>
                <input type="text" class="form-control" name="nombre_proveedor" required></div>

            <div class="form-group">
                <label for="rfc">RFC</label>
                <input type="text" class="form-control" name="rfc" required></div>


            <div class="form-group">
                <label>Empresa</label>
                <select name="id_empresa" class="custom-select">
                    <?php
                    $datosEmpresas = Datos::vistaEmpresasModel("empresas");

                    foreach ($datosEmpresas as $Empresa) : ?>
                        <option value="<?php echo $Empresa['id_empresa'] ?>"> <?php echo $Empresa['nombre_empresa'] ?> </option>
                    <?php endforeach; ?>

                </select>
            </div>

            <div class="form-group">
                <label>Tipo de Proveedor</label>
                <select name="id_tipo" class="custom-select">
                    <?php
                    $datosTipos = Datos::vistaTiposModel("tipos_proveedor");

                    foreach ($datosTipos as $Tipo) : ?>
                        <option value="<?php echo $Tipo['id_tipo'] ?>"> <?php echo $Tipo['nombre_tipo'] ?> </option>
                    <?php endforeach; ?>


                </select>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Registrar</button>

        </form>

        <?php

        //Enviar los registros al controlador

        $registro = new MvcController;
        $registro->registroProveedorController();

        if (isset($_GET["action"])) {
            if ($_GET["action"] == "ok_proveedor") {
                echo "Registro exitoso";
            }
        }



        if (isset($_GET["action"])) {
            if ($_GET["action"] == "ok_proveedor_fallo") {
                echo "Error";
            }
        }
        ?>

    </div>
</div>