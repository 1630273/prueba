<!--Es la plantilla que vera el usuario al ejecutar la aplicación -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Template</title>


	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

</head>


<?php

include "Views/modules/navegacion.php";
?>

<section>
	<?php
	$mvc = new MvcController();
	$mvc->enlacesPaginasController();

	?>

</section>



</body>

</html>