<div class="col-10 m-auto">
    <div class="bg-light p-3">
        <h2>Tabla de Estudiantes</h2>

    </div>
    <div class="col-12 p-2">
        <table class="table table-striped ">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">cedula</th>
                    <th scope="col">nombre</th>
                    <th scope="col">apellidos</th>
                    <th scope="col">promedio</th>
                    <th scope="col">edad</th>
                    <th scope="col">fecha</th>
                    <th scope="col">acción</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($query as $data) : ?>
                    <tr>
                        <th><?php echo $data['id']; ?></th>
                        <th><?php echo $data['cedula']; ?></th>
                        <th><?php echo $data['nombre']; ?></th>
                        <th><?php echo $data['apellidos']; ?></th>
                        <th><?php echo $data['promedio']; ?></th>
                        <th><?php echo $data['edad']; ?></th>
                        <th><?php echo $data['fecha']; ?></th>
                        <th>
                            <a href="index.php?m=formularioEstudiante&id=<?php echo $data['id'] ?>" class="btn btn-primary">Editar</a>
                            <a href="index.php?m=confirmarDelete&id=<?php echo $data['id'] ?>" class="btn btn-danger">Eliminar</a>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>