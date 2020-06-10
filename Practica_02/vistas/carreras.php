<div class="col-4 m-auto">
    <div class="bg-light p-3">
        <h2>Tabla de Carreras</h2>

    </div>
    <div class=" p-2">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th scope="col">id</th>

                    <th scope="col">nombre</th>

                    <th scope="col">acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($query as $data) : ?>
                    <tr>
                        <th><?php echo $data['id']; ?></th>
                        <th><?php echo $data['nombre']; ?></th>

                        <th>
                            <a href="index.php?m=formularioCarrera&id=<?php echo $data['id'] ?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?m=confirmarDeleteC&id=<?php echo $data['id'] ?>" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>