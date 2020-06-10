<div class="row  justify-content-around">
    <div class="col-4  ">
        <div class="d-flex justify-content-center">
            <p class="h2 text-primary ">Ingresar </p>
        </div>

        <form method="post">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" placeholder="usuario" name="usuarioIngreso" required>
            </div>
            <div class="form-group">
                <label for="contrasena">Contraseña</label>
                <input type="password" class="form-control" placeholder="contraseña" name="passwordIngreso" required>
            </div>


            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>



        </form>

        <?php

        $ingresar = new MvcController;
        $ingresar->ingresoUsuarioController();

        if (isset($_post["action"])) {
            if ($_post["action"] == "fallo") {
                echo "Fallo al ingresar";
            }
        }

        ?>
    </div>
</div>