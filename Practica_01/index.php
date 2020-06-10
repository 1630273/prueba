    <?php
    //El index. En el mostraremos la salida de las vistas al usuario y también a través de él enviaremos las distintas acciones que el usuario envíe al controlador

    require_once 'Models/enlaces.php';
    require_once 'Models/crud.php';
    require_once 'Controllers/controller.php';

    //para ver el template se hace la peticion mediante el controlador 

    //creamos un objeto

    $mvc = new MvcController();

    //Mostrar la función o método "página" disponible en controllers/controller.php 

    $mvc->pagina();

    ?>