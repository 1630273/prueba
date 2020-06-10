<div class="col-6 m-auto">
    <div class="bg-light p-3">
        <h2>Formulario de Carrera</h2>

    </div>
    <div class=" ">

        <?php if ($data['id'] == "") { ?>
            <form action="index.php?m=get_datosC" method="post">
            <?php } ?>
            <?php if ($data['id'] != "") { ?>
                <form action="index.php?m=get_datosC&id=<?php echo $data['id']; ?>" method="post">
                <?php } ?>

                <div class="form-group">

                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" name="txt_id" value="<?php echo $data['id']; ?>">
                    </div>

                </div>

                <div class="form-group">
                    <label class=" col-sm-2 control-label" for="txt_nombre">NOMBRE:</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txt_nombre" value="<?php echo $data['nombre']; ?>">
                    </div>

                </div>
                <div class="form-group">

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