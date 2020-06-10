<?php

class estudiante_model
{

    private $DB; //Variable de la conexion de la base de datos
    private $estudiantes; // Variable que guardara  las propiedades del obejto estudiantes dentro del modelo

    //contructuctor 
    function __construct()
    {
        //Se manda a llamar la conexion de la base datos

        $this->DB = Database::connect();
    }

    //Funcion get para la obtencion de datos de la tabla estudiantes
    function get()
    {
        //Se crea la consulta en la variable $sql
        $sql = 'SELECT * FROM estudiante ORDER BY id DESC';
        // La variable $fila ejecuta la consulta en la viariable $sql
        $fila = $this->DB->query($sql);
        //El resultado se guarda en la $fila y es igulado a la vaiable  estuduante
        $this->estudiantes = $fila;
        // Se retorna la variable estudiante
        return  $this->estudiantes;
    }

    //Funcion Create es para dar de alta un estudiante
    function create($data)
    {
        //Se llama a la base de datos
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //se crea la consulta a utilizar y se gurada en la variable $sql como la plantilla a utilizar
        // se hace el uso de  ?? en los values ya que se usan sentencias preparadas
        $sql = "INSERT INTO estudiante(id,cedula,nombre,apellidos,promedio,edad,fecha)VALUES (?,?,?,?,?,?,?)";

        $query = $this->DB->prepare($sql); //se hace la llama a  la plantilla de la sentencias de la variable $sql

        //Se envian los parametros para la ejecucion de la sentencia
        $query->execute(array($data['id'], $data['cedula'], $data['nombre'], $data['apellidos'], $data['promedio'], $data['edad'], $data['fecha']));
        Database::disconnect();
    }

    //Funcion para trer la informacion de  un id -> requiere el paramatre del id
    function get_id($id)
    {
        //Se llama la base de datos
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //Se prepara la palntilla del sql
        $sql = "SELECT * FROM estudiante where id = ?";
        //se llama a la plantilla 
        $q = $this->DB->prepare($sql);
        //se ejecuta la plantilla
        $q->execute(array($id));
        // una vez ejecutado se crea la variable $data para gurdaro en formato de arreglo asociativo
        $data = $q->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    //Fuccion de modificacion
    function update($data, $date)
    {
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //se crea la plantilla  de la sentencia a ejecutar
        $sql = "UPDATE estudiante  set  cedula=?, nombre =?, apellidos=?,promedio=?, edad=?, fecha=? WHERE id = ? ";
        //se llama a la plantilla 
        $q = $this->DB->prepare($sql);
        //se ejecuta la plantilla
        $q->execute(array($data['cedula'], $data['nombre'], $data['apellidos'], $data['promedio'], $data['edad'], $data['fecha'], $date));
        Database::disconnect();
    }

    //Funcion para elmiminar
    function delete($date)
    {
        $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //se crea la plantilla  de la sentencia a ejecutar
        $sql = "DELETE FROM estudiante where id=?";
        //se llama a la plantilla 
        $q = $this->DB->prepare($sql);
        //se ejecuta la plantilla
        $q->execute(array($date));
        Database::disconnect();
    }
}
