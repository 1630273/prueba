<div class="col-4 m-auto p-5 ">

    <div class="bg-light p-3">
        <h2>Registro</h2>

    </div>
    <div class=" border">
        <form class="px-4 py-3" action="index.php?m=RegistrarUsuario" method="post">
            <div class="form-group">
                <label for="usuario">Usuario</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Usuaario" required>
            </div>
            <div class="form-group">
                <label for="Contraseña">Contraseña</label>
                <input type="password" class="form-control" id="Contraseña" name="password" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <label for="Contraseña">Email</label>
                <input type="email" class="form-control" id="Contraseña" name="email" placeholder="Email" required>
            </div>

            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
        <div class="dropdown-divider"> </div>
        <a class="dropdown-item" href="index.php?m=index">Ya tienes cuenta ?</a>


    </div>

</div>