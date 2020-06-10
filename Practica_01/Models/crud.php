<?php

#EXTENSIÓN DE CLASES: Los objetos pueden ser extendidos, y pueden heredar propiedades y métodos. Para definir una clase como extensión, debo definir una clase padre, y se utiliza dentro de una clase hija.

require_once "conexion.php";

//heredar la clase conexion de conexion.php para poder utilizar "Conexion" del archivo conexion.php.
// Se extiende cuando se requiere manipuar una funcion, en este caso se va a manipular la función "conectar" del models/conexion.php:
class Datos extends Conexion
{

    #REGISTRO DE USUARIOS
    #-------------------------------------
    public function registroUsuarioModel($datosModel, $tabla)
    {

        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (usuario, password, email) VALUES (:usuario,:password,:email)");

        #bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente
        # de la sentencia SQL que fue usada para preparar la sentencia.

        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #INGRESO USUARIO
    #-------------------------------------
    public function ingresoUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT usuario, password FROM $tabla WHERE usuario = :usuario");
        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->execute();

        #fetch(): Obtiene una fila de un conjunto de resultados asociado al objeto PDOStatement.
        return $stmt->fetch();

        $stmt->close();
    }

    #VISTA USUARIOS
    #-------------------------------------

    public function vistaUsuariosModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_usuario, usuario, password, email FROM $tabla");
        $stmt->execute();

        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
        return $stmt->fetchAll();

        $stmt->close();
    }

    #EDITAR USUARIO
    #-------------------------------------

    public function editarUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_usuario, usuario, password, email FROM $tabla WHERE id_usuario = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }

    #ACTUALIZAR USUARIO
    #-------------------------------------

    public function actualizarUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario = :usuario, password = :password, email = :email WHERE id_usuario = :id");

        $stmt->bindParam(":usuario", $datosModel["usuario"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datosModel["password"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datosModel["email"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #BORRAR USUARIO
    #------------------------------------
    public function borrarUsuarioModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #/////////////////////////////////////////   EMPRESAS   ////////////////////////////////////////////////////////////
    #REGISTRO DE EMPRESA
    #-------------------------------------
    public function registroEmpresaModel($datosModel, $tabla)
    {

        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_empresa) VALUES (:nombre_empresa)");

        #bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente
        # de la sentencia SQL que fue usada para preparar la sentencia.

        $stmt->bindParam(":nombre_empresa", $datosModel["nombre_empresa"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #VISTA EMPRESAS
    #-------------------------------------

    public function vistaEmpresasModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_empresa, nombre_empresa FROM $tabla");
        $stmt->execute();

        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
        return $stmt->fetchAll();

        $stmt->close();
    }

    #EDITAR EMPRESA
    #-------------------------------------

    public function editarEmpresaModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_empresa, nombre_empresa FROM $tabla WHERE id_empresa = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }



    #ACTUALIZAR USUARIO
    #-------------------------------------

    public function actualizarEmpresaModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_empresa = :nombre_empresa WHERE id_empresa = :id");

        $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_empresa", $datosModel["nombre_empresa"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #BORRAR EMPRESA
    #------------------------------------
    public function borrarEmpresaModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_empresa = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #/////////////////////////////////////////   TIPO DE PROVEEDOR   ////////////////////////////////////////////////////////////
    #REGISTRO DE TIPO DE PROVEEDOR
    #-------------------------------------
    public function registroTipoModel($datosModel, $tabla)
    {

        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (nombre_tipo) VALUES (:nombre_tipo)");

        #bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente
        # de la sentencia SQL que fue usada para preparar la sentencia.

        $stmt->bindParam(":nombre_tipo", $datosModel["nombre_tipo"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #VISTA TIPO DE PROVEEDOR
    #-------------------------------------

    public function vistaTiposModel($tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_tipo, nombre_tipo FROM $tabla");
        $stmt->execute();

        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
        return $stmt->fetchAll();

        $stmt->close();
    }

    #EDITAR TIPO DE PROVEEDOR
    #-------------------------------------

    public function editarTipoModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_tipo, nombre_tipo FROM $tabla WHERE id_tipo = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }



    #ACTUALIZAR TIPO DE PROVEEDOR
    #-------------------------------------

    public function actualizarTipoModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_tipo = :nombre_tipo WHERE id_tipo = :id");

        $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
        $stmt->bindParam(":nombre_tipo", $datosModel["nombre_tipo"], PDO::PARAM_STR);


        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #BORRAR TIPO DE PROVEEDOR
    #------------------------------------
    public function borrarTipoModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_tipo = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #/////////////////////////////////////////   PROVEEDRES   ////////////////////////////////////////////////////////////
    #REGISTRO DE PROVEEDRES
    #-------------------------------------
    public function registroProveedorModel($datosModel, $tabla)
    {

        #prepare() Prepara una sentencia SQL para ser ejecutada por el método PDOStatement::execute(). La sentencia SQL puede contener cero o más marcadores de parámetros con nombre (:name) o signos de interrogación (?) por los cuales los valores reales serán sustituidos cuando la sentencia sea ejecutada. Ayuda a prevenir inyecciones SQL eliminando la necesidad de entrecomillar manualmente los parámetros.

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (clave, nombre_proveedor, rfc, id_empresa, id_tipo) VALUES (:clave, :nombre_proveedor, :rfc, :id_empresa, :id_tipo)");

        #bindParam() Vincula una variable de PHP a un parámetro de sustitución con nombre o de signo de interrogación correspondiente
        # de la sentencia SQL que fue usada para preparar la sentencia.

        $stmt->bindParam(":clave", $datosModel["clave"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_proveedor", $datosModel["nombre_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa", $datosModel["id_empresa"], PDO::PARAM_INT);
        $stmt->bindParam(":id_tipo", $datosModel["id_tipo"], PDO::PARAM_INT);
        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #VISTA PROVEEDRES
    #-------------------------------------

    public function vistaProveedorModel($t1, $t2, $t3)
    {

        $stmt = Conexion::conectar()->prepare("SELECT $t1.id_proveedor, $t1.clave,$t1.nombre_proveedor,$t1.rfc,$t2.id_empresa,$t2.nombre_empresa,$t3.nombre_tipo,$t3.id_tipo FROM $t1  JOIN $t2 ON $t1.id_empresa = $t2.id_empresa
        JOIN $t3 ON  $t1.id_tipo = $t3.id_tipo");
        $stmt->execute();

        #fetchAll(): Obtiene todas las filas de un conjunto de resultados asociado al objeto PDOStatement.
        return $stmt->fetchAll();

        $stmt->close();
    }

    #EDITAR PROVEEDRES
    #-------------------------------------

    public function editarProveedorModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("SELECT id_proveedor,clave,nombre_proveedor,rfc,id_empresa,id_tipo FROM $tabla WHERE id_proveedor = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();

        $stmt->close();
    }



    #ACTUALIZAR PROVEEDRES
    #-------------------------------------

    public function actualizarProveedorModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET clave = :clave, nombre_proveedor= :nombre_proveedor, rfc= :rfc, id_empresa = :id_empresa , id_tipo = :id_tipo WHERE id_proveedor = :id");

        $stmt->bindParam(":id", $datosModel["id"], PDO::PARAM_INT);
        $stmt->bindParam(":clave", $datosModel["clave"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre_proveedor", $datosModel["nombre_proveedor"], PDO::PARAM_STR);
        $stmt->bindParam(":rfc", $datosModel["rfc"], PDO::PARAM_STR);
        $stmt->bindParam(":id_empresa", $datosModel["id_empresa"], PDO::PARAM_INT);
        $stmt->bindParam(":id_tipo", $datosModel["id_tipo"], PDO::PARAM_INT);


        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }


    #BORRAR PROVEEDRES
    #------------------------------------
    public function borrarProveedorModel($datosModel, $tabla)
    {

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_proveedor = :id");
        $stmt->bindParam(":id", $datosModel, PDO::PARAM_INT);

        if ($stmt->execute()) {

            return "success";
        } else {

            return "error";
        }

        $stmt->close();
    }
}
//
