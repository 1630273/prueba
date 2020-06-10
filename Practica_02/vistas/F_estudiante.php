<div class="col-6 m-auto">
    <div class="bg-light p-3">
        <h2>Formulario de Estudiante</h2>

    </div>
    <div class="col-12 ">

        <?php if ($data['id'] == "") { ?>
            <form action="index.php?m=get_datosE" method="post">
            <?php } ?>
            <?php if ($data['id'] != "") { ?>
                <form action="index.php?m=get_datosE&id=<?php echo $data['id']; ?>" method="post">
                <?php } ?>

                <div class="form-group">

                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="txt_id" value="<?php echo $data['id']; ?>">
                    </div>

                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_cedula">CEDULA:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_cedula" value="<?php echo $data['cedula']; ?>">
                    </div>

                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_nombre">NOMBRE:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_nombre" value="<?php echo $data['nombre']; ?>">
                    </div>

                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_apellidos">APELLIDOS:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_apellidos" value="<?php echo $data['apellidos']; ?>">
                    </div>

                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_promedio">PROMEDIO:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_promedio" value="<?php echo $data['promedio']; ?>">
                    </div>

                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_edad">EDAD:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_edad" value="<?php echo $data['edad']; ?>">
                    </div>

                </div>
                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_fecha">fecha:</label>
                    <div class="col-sm-10">
                        <input type="date" class="form-control" min="1000-01-01" max="3000-12-31" class="form-control" name="txt_fecha" value="<?php echo $data['fecha']; ?>">
                    </div>

                </div>
                <div class="form-group">
                    <div class="col-md-12 col-md-off-set-3">
                        <?php if ($data['id'] == "") { ?>
                            <input type="submit" class="btn btn-primary form-control" name="" value="registrar">
                        <?php }  ?>
                        <?php if ($data['id'] != "") { ?>
                            <input type="submit" class="btn btn-primary form-control" name="" value="Actualizar">
                        <?php }  ?>
                    </div>
                </div>
                </form>

    </div>

</div>