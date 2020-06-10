<?php
require_once('modelo/estudiante_model.php');
require_once('modelo/usuario_model.php');
require_once('modelo/carrera_model.php');
require_once('modelo/universidad_model.php');

class estudiante_controller
{
    //Variable donde se almacenara el objeto estudiante 
    private $model_e;
    private $model_u;
    private $model_c;
    private $model_uni;

    //contructor del controlador
    function __construct()
    {
        $this->model_e = new estudiante_model();
        $this->model_u = new usuario_model();
        $this->model_c = new carrera_model();
        $this->model_uni = new universidad_model();
    }


    //index direcciona a el login
    function   index()
    {
        include_once('vistas/headervacio.php');
        include_once('vistas/index.php');
        include_once('vistas/footer.php');
    }

    //Direciona a el regitro de usuarios
    function   Registro()
    {
        include_once('vistas/headervacio.php');
        include_once('vistas/registro.php');
        include_once('vistas/footer.php');
    }

    //Regitra los usuarios
    function   RegistrarUsuario()
    {
        $data['usuario'] = $_REQUEST['usuario'];
        $data['password'] = $_REQUEST['password'];
        $data['email'] = $_REQUEST['email'];

        $this->model_u->CrearUsuario($data);

        include_once('vistas/headervacio.php');
        include_once('vistas/index.php');
        include_once('vistas/footer.php');
    }

    //Funcion para iniciar session
    function   Ingresar()
    {
        //Se traen los datos
        $data['usuario'] = $_REQUEST['usuario'];
        $data['password'] = $_REQUEST['password'];

        //se pasan al modelo y se retorna  la seleccion
        $query =  $this->model_u->Ingresar($data);

        //Se combrueba que lo que retorno sea igual a lo que esta en la cajas de texto
        if ($query["usuario"] == $data["usuario"] && $query["password"] == $data["password"]) {

            include_once('vistas/header.php');
            include_once('vistas/F_carrera.php');
            include_once('vistas/footer.php');
        } else {

            include_once('vistas/headervacio.php');
            include_once('vistas/registro.php');
            include_once('vistas/footer.php');
        }
    }

    //Funcion  para llamar la tabla estudiantes

    function verEstudiantes()
    {
        //se llama al modelo que contiene los datos de la tabala Estudiantes
        $query = $this->model_e->get();

        include_once('vistas/header.php');
        include_once('vistas/estudiantes.php');
        include_once('vistas/footer.php');
    }

    //Funcion que llama al formulario de estudiantes
    function formularioEstudiante()
    {
        $data = NULL;
        if (isset($_REQUEST['id'])) {
            $data = $this->model_e->get_id($_REQUEST['id']);
        }
        $query = $this->model_e->get();
        include_once('vistas/header.php');
        include_once('vistas/F_estudiante.php');
        include_once('vistas/footer.php');
    }

    //Funcion que tre los datos del fomrmulario y decide si se agrega ao modifica , si en la entrada encuentra un id
    function get_datosE()
    {

        $data['id'] = $_REQUEST['txt_id'];
        $data['cedula'] = $_REQUEST['txt_cedula'];
        $data['nombre'] = $_REQUEST['txt_nombre'];
        $data['apellidos'] = $_REQUEST['txt_apellidos'];
        $data['promedio'] = $_REQUEST['txt_promedio'];
        $data['edad'] = $_REQUEST['txt_edad'];
        $data['fecha'] = $_REQUEST['txt_fecha'];

        if ($_REQUEST['id'] == "") {
            $this->model_e->create($data);
        }

        if ($_REQUEST['id'] != "") {
            $date = $_REQUEST['id'];
            $this->model_e->update($data, $date);
        }

        header("Location:index.php?m=verEstudiantes");
    }

    //Funccion para borrar un estudiante
    //Si se devuele un 0 
    function confirmarDelete()
    {

        $data = NULL;

        if ($_REQUEST['id'] != 0) {
            $data = $this->model_e->get_id($_REQUEST['id']);
        }

        if ($_REQUEST['id'] == 0) {
            $date['id'] = $_REQUEST['txt_id'];
            //
            $this->model_e->delete($date['id']);
            header("Location:index.php?m=verEstudiantes");
        }

        include_once('vistas/header.php');
        include_once('vistas/confirm.php');
        include_once('vistas/footer.php');
    }


    /////////////////////////////// CARRERAS //////////////////////////////////////////////////
    //Funcion  para llamar la tabla Carreras

    function verCarreras()
    {
        //se llama al modelo que contiene los datos de la tabala Carreras
        $query = $this->model_c->get();

        include_once('vistas/header.php');
        include_once('vistas/carreras.php');
        include_once('vistas/footer.php');
    }

    //Funcion que llama al formulario de Carreras
    function formularioCarrera()
    {
        $data = NULL;
        if (isset($_REQUEST['id'])) {
            $data = $this->model_c->get_id($_REQUEST['id']);
        }
        $query = $this->model_c->get();
        include_once('vistas/header.php');
        include_once('vistas/F_carrera.php');
        include_once('vistas/footer.php');
    }

    //Funcion que tre los datos del fomrmulario y decide si se agrega ao modifica , si en la entrada encuentra un id
    function get_datosC()
    {
        $data['id'] = $_REQUEST['txt_id'];
        $data['nombre'] = $_REQUEST['txt_nombre'];

        if ($_REQUEST['id'] == "") {
            $this->model_c->create($data);
        }

        if ($_REQUEST['id'] != "") {
            $date = $_REQUEST['id'];
            $this->model_c->update($data, $date);
        }

        header("Location:index.php?m=verCarreras");
    }

    //Funccion para borrar una carrera
    //Si se devuele un 0 
    function confirmarDeleteC()
    {

        $data = NULL;

        if ($_REQUEST['id'] != 0) {
            $data = $this->model_c->get_id($_REQUEST['id']);
        }

        if ($_REQUEST['id'] == 0) {
            $date['id'] = $_REQUEST['txt_id'];
            //
            $this->model_c->delete($date['id']);
            header("Location:index.php?m=verCarreras");
        }

        include_once('vistas/header.php');
        include_once('vistas/confirmCarrera.php');
        include_once('vistas/footer.php');
    }


    /////////////////////////////// UNIVERSIDADES //////////////////////////////////////////////////
    //Funcion  para llamar la tabla Universidads

    function verUniversidads()
    {
        //se llama al modelo que contiene los datos de la tabala Universidads
        $query = $this->model_uni->get();

        include_once('vistas/header.php');
        include_once('vistas/universidads.php');
        include_once('vistas/footer.php');
    }

    //Funcion que llama al formulario de Universidads
    function formularioUniversidad()
    {
        $data = NULL;
        if (isset($_REQUEST['id'])) {
            $data = $this->model_uni->get_id($_REQUEST['id']);
        }
        $query = $this->model_uni->get();
        include_once('vistas/header.php');
        include_once('vistas/F_universidad.php');
        include_once('vistas/footer.php');
    }

    //Funcion que tre los datos del fomrmulario y decide si se agrega ao modifica , si en la entrada encuentra un id
    function get_datosU()
    {
        $data['id'] = $_REQUEST['txt_id'];
        $data['nombre'] = $_REQUEST['txt_nombre'];

        if ($_REQUEST['id'] == "") {
            $this->model_uni->create($data);
        }

        if ($_REQUEST['id'] != "") {
            $date = $_REQUEST['id'];
            $this->model_uni->update($data, $date);
        }

        header("Location:index.php?m=verUniversidads");
    }

    //Funccion para borrar una universidad
    //Si se devuele un 0 
    function confirmarDeleteU()
    {

        $data = NULL;

        if ($_REQUEST['id'] != 0) {
            $data = $this->model_uni->get_id($_REQUEST['id']);
        }

        if ($_REQUEST['id'] == 0) {
            $date['id'] = $_REQUEST['txt_id'];
            //
            $this->model_uni->delete($date['id']);
            header("Location:index.php?m=verUniversidads");
        }

        include_once('vistas/header.php');
        include_once('vistas/confirmUniversidad.php');
        include_once('vistas/footer.php');
    }
}
