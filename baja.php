<?php
	require_once('clases/Personas.php');

	$mensaje ="";
	if(isset($_POST['dniParaBorrar']))//paso por grilla y luego guardo
	{
		$unaPersona = Persona::Borrar($_POST['dniParaBorrar']);
		$mensaje = "SE HA BORRADO EXITOSAMENTE!!!";
	}
?>
<html>
<head>
		<title>Ejemplos de ABM - con archivo de texto</title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!--final de Estilos-->
		   <meta name="viewport" content="width=device-width, initial-scale=1">
          <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" href="estilo.css">

</head>
<body>
	  <div class="container">
	  	  <div class="page-header">
                <h1>ABM</h1>      
            </div>
			<h2><?php echo $mensaje; ?></h2>
					<div class="CajaInicio animated bounceInRight">
							<h1>PERSONAS - BAJA</h1>
						
							<form id="FormIngreso">
 										
									    <a href="index.html" class="list-group-item  list-group-item list-group-item-info">
									      <h4 class="list-group-item-heading">Men&uacute; Principal</h4>
									    </a>
										
										<a href="grilla.php" class="list-group-item  list-group-item list-group-item-info">
									      <h4 class="list-group-item-heading">Grilla de Personas</h4>
									    </a>
									
									  </div>									
							</form>
						</div>
		</div>
</body>
</html>