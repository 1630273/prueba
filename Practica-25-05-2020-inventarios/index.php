<?php

/* se activa el alamacenamiento del bufer para poder acceder a los valores 
gurdados en los arreglos asociativos $_GET y $_SESSION sin ningun problema */
ob_start();

/* llamamaos al archivo que contiene los controladore y modelos que se nesecitan
para que el sistema funcione correctamente */
require_once "models/enlaces.php";
require_once "models/crud.php";
require_once "controllers/controller.php";


$mvc = new MvcController();
// Llamamos a la plantilla de sistema
$mvc->plantilla();
