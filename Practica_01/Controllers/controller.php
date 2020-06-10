<?php
class MvcController
{
    //Muestra una plantilla al usuario


    #LLAMADA A LA PLANTILLA
    #-------------------------------------

    public function pagina()
    {

        include "views/template.php";
    }

    #ENLACES
    #-------------------------------------

    public function enlacesPaginasController()
    {

        if (isset($_GET['action'])) {

            $enlaces = $_GET['action'];
        } else {

            $enlaces = "index";
        }

        $respuesta = Paginas::enlacesPaginasModel($enlaces);

        include $respuesta;
    }



    #REGISTRO DE USUARIOS
    #------------------------------------
    public function registroUsuarioController()
    {

        if (isset($_POST["usuarioRegistro"])) {
            //Recibe a traves del método POST el name (html) de usuario,
            // password y email, se almacenan los datos en una variable de tipo array
            // con sus respectivas propiedades (usuario, password y email):
            $datosController = array(
                "usuario" => $_POST["usuarioRegistro"],
                "password" => $_POST["passwordRegistro"],
                "email" => $_POST["emailRegistro"]
            );

            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),
            //que en la clase "Datos", la funcion "registroUsuarioModel" reciba en
            // sus 2 parametros los valores "$datosController" y el nombre de la tabla a
            // conectarnos la cual es "usuarios":
            $respuesta = Datos::registroUsuarioModel($datosController, "usuarios");

            //se imprime la respuesta en la vista
            if ($respuesta == "success") {

                header("location:index.php?action=ok");
            } else {

                header("location:index.php");
            }
        }
    }


    #INGRESO DE USUARIOS
    #------------------------------------
    public function ingresoUsuarioController()
    {

        if (isset($_POST["usuarioIngreso"])) {

            $datosController = array(
                "usuario" => $_POST["usuarioIngreso"],
                "password" => $_POST["passwordIngreso"]
            );

            $respuesta = Datos::ingresoUsuarioModel($datosController, "usuarios");
            //Valiación de la respuesta del modelo para ver si es un usuario correcto.
            if ($respuesta["usuario"] == $_POST["usuarioIngreso"] && $respuesta["password"] == $_POST["passwordIngreso"]) {

                session_start();

                $_SESSION["validar"] = true;

                header("location:index.php?action=usuarios");
            } else {

                header("location:index.php?action=fallo");
            }
        }
    }

    #VISTA DE USUARIOS
    #------------------------------------

    public function vistaUsuariosController()
    {

        $respuesta = Datos::vistaUsuariosModel("usuarios");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<tr>
                <td>' . $item["usuario"] . '</td>
                <td>' . $item["password"] . '</td>
                <td>' . $item["email"] . '</td>
                <td> <a href="index.php?action=editar&id=' . $item["id_usuario"] . '"><button title="Editar" class="bg-warning   text-white">Editar</button></a></td>
                <td><a href="index.php?action=usuarios&idBorrar=' . $item["id_usuario"] . '"><button title="Eliminar" class="bg-danger   text-white">Eliminar</button></a></td>
                </tr>';
        }
    }



    #EDITAR USUARIO
    #------------------------------------

    public function editarUsuarioController()
    {

        $datosController = $_GET["id"];
        $respuesta = Datos::editarUsuarioModel($datosController, "usuarios");

        echo '<input type="hidden" value="' . $respuesta["id_usuario"] . '" name="idEditar">

        <div class="form-group">
        <label for="usuario">Usuario</label> <input type="text" class="form-control"  value="' . $respuesta["usuario"] . '" name="usuarioEditar" required> </div>

        <div class="form-group">
        <label for="usuario">Contraseña</label><input type="text" class="form-control" value="' . $respuesta["password"] . '" name="passwordEditar" required> </div>

        <div class="form-group">
        <label for="usuario">Email</label>    <input type="email" class="form-control" value="' . $respuesta["email"] . '" name="emailEditar" required> </div>

        <button type="submit"  value="Actualizar" class="btn btn-primary btn-block">Actualizar</button>';
    }



    #ACTUALIZAR USUARIO
    #------------------------------------
    public function actualizarUsuarioController()
    {

        if (isset($_POST["usuarioEditar"])) {

            $datosController = array(
                "id" => $_POST["idEditar"],
                "usuario" => $_POST["usuarioEditar"],
                "password" => $_POST["passwordEditar"],
                "email" => $_POST["emailEditar"]
            );

            $respuesta = Datos::actualizarUsuarioModel($datosController, "usuarios");

            if ($respuesta == "success") {

                header("location:index.php?action=cambio");
            } else {

                echo "error";
            }
        }
    }


    #BORRAR USUARIO
    #------------------------------------
    public function borrarUsuarioController()
    {

        if (isset($_GET["idBorrar"])) {

            $datosController = $_GET["idBorrar"];

            $respuesta = Datos::borrarUsuarioModel($datosController, "usuarios");

            if ($respuesta == "success") {

                header("location:index.php?action=usuarios");
            }
        }
    }





    #//////////////////////////////////      EMPRESAS   ///////////////////////////////////////

    #REGISTRO DE EMPRESAS
    #------------------------------------
    public function registroEmpresaController()
    {

        if (isset($_POST["nombre_empresa"])) {
            //Recibe a traves del método POST el name (html) de empresa,
            //  se almacenan los datos en una variable de tipo array
            // con sus respectivas propiedades (nombre_empresa):
            $datosController = array(
                "nombre_empresa" => $_POST["nombre_empresa"]
            );

            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),
            //que en la clase "Datos", la funcion "registroUsuarioModel" reciba en
            // sus 2 parametros los valores "$datosController" y el nombre de la tabla a
            // conectarnos la cual es "usuarios":
            $respuesta = Datos::registroEmpresaModel($datosController, "empresas");

            //se imprime la respuesta en la vista
            if ($respuesta == "success") {

                header("location:index.php?action=ok_empresa");
            } else {

                header("location:index.php");
            }
        }
    }

    #VISTA DE EMPRESAS
    #------------------------------------

    public function vistaEmpresasController()
    {

        $respuesta = Datos::vistaEmpresasModel("empresas");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<tr>
                <td>' . $item["nombre_empresa"] . '</td>
                <td><a href="index.php?action=editar_empresa&id=' . $item["id_empresa"] . '"><button title="Editar" class="bg-warning   text-white">Editar</button></a></td>
                <td><a href="index.php?action=empresas&idBorrar=' . $item["id_empresa"] . '"><button title="Eliminar" class="bg-danger   text-white">Eliminar</button></a></td>
                </tr>';
        }
    }



    #EDITAR EMPRESAS
    #------------------------------------

    public function editarEmpresaController()
    {

        $datosController = $_GET["id"];
        $respuesta = Datos::editarEmpresaModel($datosController, "empresas");

        echo '<input type="hidden" value="' . $respuesta["id_empresa"] . '" name="idEditar">

        <div class="form-group">
        <label for="usuario">Nombre de la Empresa</label> <input type="text" class="form-control"  value="' . $respuesta["nombre_empresa"] . '" name="nombre_empresaEditar" required></div>


          
        <button type="submit"  value="Actualizar" class="btn btn-primary btn-block">Actualizar</button>';
    }



    #ACTUALIZAR EMPRESA
    #------------------------------------
    public function actualizarEmpresaController()
    {

        if (isset($_POST["nombre_empresaEditar"])) {

            $datosController = array(
                "id" => $_POST["idEditar"],
                "nombre_empresa" => $_POST["nombre_empresaEditar"]

            );

            $respuesta = Datos::actualizarEmpresaModel($datosController, "empresas");

            if ($respuesta == "success") {

                header("location:index.php?action=cambio_empresa");
            } else {

                echo "error";
            }
        }
    }


    #BORRAR EMPRESA
    #------------------------------------
    public function borrarEmpresaController()
    {

        if (isset($_GET["idBorrar"])) {

            $datosController = $_GET["idBorrar"];

            $respuesta = Datos::borrarEmpresaModel($datosController, "empresas");

            if ($respuesta == "success") {

                header("location:index.php?action=empresas");
            }
        }
    }



    #//////////////////////////////////      TIPOS   ///////////////////////////////////////

    #REGISTRO DE TIPO_PORVEEDRO
    #------------------------------------
    public function registroTipoController()
    {

        if (isset($_POST["nombre_tipo"])) {
            //Recibe a traves del método POST el name (html) de tipo,
            //  se almacenan los datos en una variable de tipo array
            // con sus respectivas propiedades (nombre_tipo):
            $datosController = array(
                "nombre_tipo" => $_POST["nombre_tipo"]
            );

            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),
            //que en la clase "Datos", la funcion "registroUsuarioModel" reciba en
            // sus 2 parametros los valores "$datosController" y el nombre de la tabla a
            // conectarnos la cual es "usuarios":
            $respuesta = Datos::registroTipoModel($datosController, "tipos_proveedor");

            //se imprime la respuesta en la vista
            if ($respuesta == "success") {

                header("location:index.php?action=ok_tipo");
            } else {

                header("location:index.php");
            }
        }
    }

    #VISTA DE TIPO_PORVEEDRO
    #------------------------------------

    public function vistaTiposController()
    {

        $respuesta = Datos::vistaTiposModel("tipos_proveedor");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<tr>
            <td>' . $item["nombre_tipo"] . '</td>
            <td><a href="index.php?action=editar_tipo&id=' . $item["id_tipo"] . '"><button title="Editar" class="bg-warning   text-white">Editar</button></a></td>
            <td><a href="index.php?action=tipos&idBorrar=' . $item["id_tipo"] . '"><button title="Eliminar" class="bg-danger   text-white">Eliminar</button></a></td>
            </tr>';
        }
    }



    #EDITAR TIPO DE PROVEEDOR
    #------------------------------------

    public function editarTipoController()
    {

        $datosController = $_GET["id"];
        $respuesta = Datos::editarTipoModel($datosController, "tipos_proveedor");

        echo '<input type="hidden" value="' . $respuesta["id_tipo"] . '" name="idEditar">

        <div class="form-group">
        <label for="usuario">Nombre del Tipo</label> <input type="text" class="form-control" value="' . $respuesta["nombre_tipo"] . '" name="nombre_tipoEditar" required></div>


          
        <button type="submit"  value="Actualizar" class="btn btn-primary btn-block">Actualizar</button>';
    }





    #ACTUALIZAR TIPO_PORVEEDRO
    #------------------------------------
    public function actualizarTipoController()
    {

        if (isset($_POST["nombre_tipoEditar"])) {

            $datosController = array(
                "id" => $_POST["idEditar"],
                "nombre_tipo" => $_POST["nombre_tipoEditar"]

            );

            $respuesta = Datos::actualizarTipoModel($datosController, "tipos_proveedor");

            if ($respuesta == "success") {

                header("location:index.php?action=cambio_tipo");
            } else {

                echo "error";
            }
        }
    }


    #BORRAR TIPO_PORVEEDRO
    #------------------------------------
    public function borrarTipoController()
    {

        if (isset($_GET["idBorrar"])) {

            $datosController = $_GET["idBorrar"];

            $respuesta = Datos::borrarTipoModel($datosController, "tipos_proveedor");

            if ($respuesta == "success") {

                header("location:index.php?action=tipos");
            }
        }
    }




    #//////////////////////////////////      PROVEEDORES   ///////////////////////////////////////

    #REGISTRO DE PROVEEDORES
    #------------------------------------
    public function registroProveedorController()
    {

        if (isset($_POST["clave"])) {
            //Recibe a traves del método POST el name (html) de proveedor,
            //  se almacenan los datos en una variable de tipo array
            // con sus respectivas propiedades (clave,nombre_proveedor,rfc,id_empresa, id_tipo):
            $datosController = array(
                "clave" => $_POST["clave"],
                "nombre_proveedor" => $_POST["nombre_proveedor"],
                "rfc" => $_POST["rfc"],
                "id_empresa" => $_POST["id_empresa"],
                "id_tipo" => $_POST["id_tipo"]

            );

            //Se le dice al modelo models/crud.php (Datos::registroUsuarioModel),
            //que en la clase "Datos", la funcion "registroUsuarioModel" reciba en
            // sus 2 parametros los valores "$datosController" y el nombre de la tabla a
            // conectarnos la cual es "proveedores":
            $respuesta = Datos::registroProveedorModel($datosController, "proveedores");

            //se imprime la respuesta en la vista
            if ($respuesta == "success") {

                header("location:index.php?action=ok_proveedor");
            } else {

                header("location:index.php?action=ok_proveedor_fallo");
            }
        }
    }

    #VISTA DE PROVEEDORES
    #------------------------------------

    public function vistaProveedorController()
    {

        $respuesta = Datos::vistaProveedorModel("proveedores", "empresas", "tipos_proveedor");

        #El constructor foreach proporciona un modo sencillo de iterar sobre arrays. foreach funciona sólo sobre arrays y objetos, y emitirá un error al intentar usarlo con una variable de un tipo diferente de datos o una variable no inicializada.

        foreach ($respuesta as $row => $item) {
            echo '<tr>
                <td>' . $item["clave"] . '</td>
                <td>' . $item["nombre_proveedor"] . '</td>
                <td>' . $item["rfc"] . '</td>
                <td>' . $item["nombre_empresa"] . '</td>
                <td>' . $item["nombre_tipo"] . '</td>

                
                <td><a href="index.php?action=editar_proveedor&id=' . $item["id_proveedor"] . '"><button title="Editar" class="bg-warning   text-white">Editar</button></a></td>
                <td><a href="index.php?action=proveedores&idBorrar=' . $item["id_proveedor"] . '"><button title="Eliminar" class="bg-danger   text-white">Eliminar</button></a></td>
                </tr>';
        }
    }



    #EDITAR PROVEEDORES
    #------------------------------------

    public function editarProveedorController()
    {

        $datosController = $_GET["id"];
        $respuesta = Datos::editarProveedorModel($datosController, "proveedores");
        $datosEmpresas = Datos::vistaEmpresasModel("empresas");
        $datosTipos = Datos::vistaTiposModel("tipos_proveedor");

        echo '<input type="hidden" value="' . $respuesta["id_proveedor"] . '" name="idEditar">

        <div class="form-group">
        <label for="nombre_proveedor">Nombre del Proveedor</label> <input type="text" class="form-control"  value="' . $respuesta["nombre_proveedor"] . '" name="nombre_proveedorEditar" required></div>

        <div class="form-group">
        <label for="clave">Clave</label> <input type="text" class="form-control"  value="' . $respuesta["clave"] . '" name="claveEditar" required></div>
          
        <div class="form-group">
        <label for="rfc">RFC</label> <input type="text" class="form-control"  value="' . $respuesta["rfc"] . '" name="rfcEditar" required></div>

        <div class="form-group">
                <label>Empresa</label>
                <select name="id_empresaEditar" class="custom-select">';


        foreach ($datosEmpresas as $Empresa) :
            echo ' <option value="' .
                $Empresa['id_empresa'] .
                '">' .
                $Empresa['nombre_empresa']
                . ' </option>';
        endforeach;

        echo '

                </select>
            </div>


      <div class="form-group">
        <label>Tipo de Proveedor</label>
          <select name="id_tipoEditar" class="custom-select">
          
          ';

        foreach ($datosTipos as $Tipo) :
            echo '<option value=" ' .
                $Tipo['id_tipo']
                . ' ">' .
                $Tipo['nombre_tipo'] .
                '</option>';
        endforeach;

        echo '
          </select>
      </div>
        <button type="submit"  value="Actualizar" class="btn btn-primary btn-block">Actualizar</button>';
    }



    #ACTUALIZAR EMPRESA
    #------------------------------------
    public function actualizarProveedorController()
    {

        if (isset($_POST["nombre_proveedorEditar"])) {

            $datosController = array(
                "id" => $_POST["idEditar"],
                "clave" => $_POST["claveEditar"],
                "nombre_proveedor" => $_POST["nombre_proveedorEditar"],
                "rfc" => $_POST["rfcEditar"],
                "id_empresa" => $_POST["id_empresaEditar"],
                "id_tipo" => $_POST["id_tipoEditar"]

            );

            $respuesta = Datos::actualizarProveedorModel($datosController, "proveedores");

            if ($respuesta == "success") {

                header("location:index.php?action=cambio_proveedor");
            } else {

                echo "error";
            }
        }
    }


    #BORRAR EMPRESA
    #------------------------------------
    public function borrarProveedorController()
    {

        if (isset($_GET["idBorrar"])) {

            $datosController = $_GET["idBorrar"];

            $respuesta = Datos::borrarProveedorModel($datosController, "proveedores");

            if ($respuesta == "success") {

                header("location:index.php?action=proveedores");
            }
        }
    }
}
