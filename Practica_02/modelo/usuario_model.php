<?php
class usuario_model
{

    private $DB; //Variable de la conexion de la base de datos
    private $usuarios; // Variable que guardara  las propiedades del obejto usuarios dentro del modelo

    //contructuctor 
    function __construct()
    {
        //Se manda a llamar la conexion de la base datos

        $this->DB = Database::connect();
    }

    //Funcion get para la obtencion de datos de la tabla usuarios
    function VerUsuarios()
    {
        //Se crea la consulta en la variable $sql
        $sql = 'SELECT * FROM usuario ORDER BY id DESC';
        // La variable $fila ejecuta la consulta en la viariable $sql
        $fila = $this->DB->query($sql);
        //El resultado se guarda en la $fila y es igulado a la vaiable  estuduante
        $this->usuarios = $fila;
        // Se retorna la variable usuario
        return  $this->usuarios;
    }
    //Funcion Crear Usuario para dar de alta un usuario

    function CrearUsuario($data)
    {
        //Se llama a la base de datos
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //se crea la consulta a utilizar y se gurada en la variable $sql como la plantilla a utilizar
        // se hace el uso de  ?? en los values ya que se usan sentencias preparadas
        $sql = "INSERT INTO usuario(usuario,password,email)VALUES (?,?,?)";

        $query = $this->DB->prepare($sql); //se hace la llama a  la plantilla de la sentencias de la variable $sql

        //Se envian los parametros para la ejecucion de la sentencia
        $query->execute(array($data['usuario'], $data['password'], $data['email']));
        Database::disconnect();
    }

    function Ingresar($data)
    {

        //Se llama a la base de datos
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Se crea la consulta en la variable $sql
        $sql = 'SELECT usuario,password FROM usuario WHERE usuario = ?';
        $query = $this->DB->prepare($sql); //se hace la llama a  la plantilla de la sentencias de la variable $sql

        //Se envian los parametros para la ejecucion de la sentencia
        $query->execute(array($data['usuario']));
        // se crea un arreglo asociativo
        $respuesta = $query->fetch(PDO::FETCH_ASSOC);

        return $respuesta;
    }


    //Funcion para trer la informacion de  un id -> requiere el paramatre del id
    function InformacionUsuario($id)
    {
        //Se llama la base de datos
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Se prepara la palntilla del sql
        $sql = "SELECT * FROM usuario where id = ?";
        //se llama a la plantilla 
        $q = $this->DB->prepare($sql);
        //se ejecuta la plantilla
        $q->execute(array($id));
        // una vez ejecutado se crea la variable $data para gurdaro en formato de arreglo asociativo
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    //Fuccion de modificacion
    function ModificarUsuario($data, $date)
    {
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //se crea la plantilla  de la sentencia a ejecutar
        $sql = "UPDATE usuario  set  usuario=?, password =?, email=? WHERE id = ? ";
        //se llama a la plantilla 
        $q = $this->DB->prepare($sql);
        //se ejecuta la plantilla
        $q->execute(array($data['usuario'], $data['password'], $data['email'],  $date));
        Database::disconnect();
    }

    //Funcion para elmiminar
    function Eliminar($date)
    {
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //se crea la plantilla  de la sentencia a ejecutar
        $sql = "DELETE FROM usuario where id=?";
        //se llama a la plantilla 
        $q = $this->DB->prepare($sql);
        //se ejecuta la plantilla
        $q->execute(array($date));
        Database::disconnect();
    }
}
