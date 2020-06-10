<div class="row  justify-content-around">
    <div class="col-4  ">
        <div class="d-flex justify-content-center">
            <p class="h2 text-primary ">Registro </p>
        </div>

        <form method="post">

            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" placeholder="usuario" name="usuarioRegistro" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" placeholder="contraseña" name="passwordRegistro" required>
            </div>
            <div class="form-group">
                <label for="Email">Email</label>
                <input type="email" class="form-control" placeholder="Email" name="emailRegistro" required>
            </div>

            <button type="submit" class="btn btn-primary btn-block">Registrar</button>



        </form>

        <?php

        //Enviar los registros al controlador

        $registro = new MvcController;
        $registro->registroUsuarioController();

        if (isset($_GET["action"])) {
            if ($_GET["action"] == "ok") {
                echo "Registro exitoso";
            }
        }
        ?>
    </div>
</div>