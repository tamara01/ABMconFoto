<?php
	require_once('clases/Personas.php');
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

       <script type="text/javascript">
		function Borrar(dni)
		{
			document.getElementById('dniParaBorrar').value = dni;
			document.frmBorrar.submit();
		}
		function Modificar(dni)
		{
			document.getElementById('dniParaModificar').value = dni;
			document.frmModificar.submit();
		}
        </script>
</head>
<body>
 <a class="btn btn-info" href="index.html">Menu principal</a>
<?php
	if(isset($_POST['dniParaBorrar']))
	{
		$resultado = Persona::Borrar($_POST['dniParaBorrar']);
	}
?>	
	<form name="frmBorrar" method="POST" action="baja.php">
		<input type="hidden" name="dniParaBorrar" id="dniParaBorrar" />
	</form>
	
	<form name="frmModificar" method="POST" action="alta.php" >
		<input type="hidden" name="dniParaModificar" id="dniParaModificar" />
	</form>

	<div class="container">
	
		<div class="CajaInicio animated bounceInRight">
			<h1> ABM </h1>

<?php 

$ArrayDePersonas = Persona::TraerTodasLasPersonas();

echo "<table class='table'>
		<thead>
			<tr>
				<th>  Apellido   </th>
				<th>  Nombre     </th>
				<th>  Dni        </th>
				<th>  Foto   	 </th>
				<th>  BORRAR     </th>
				<th>  MODIFICAR  </th>
			</tr> 
		</thead>";   	

	foreach ($ArrayDePersonas as $p){
		
		echo " 	<tr>
					<td>".$p->GetApellido()."</td>
					<td>".$p->GetNombre()."</td>
					<td>".$p->GetDni()."</td> 
					<td><img src=Fotos/".$p->GetFoto()." height=50px width=50px </td>
					<td><button class='btn btn-danger' name='Borrar' onclick='Borrar(".$p->GetDni().")'>Borrar</button></td>
					<td><button class='btn btn-warning' name='Modificar' onclick='Modificar(".$p->GetDni().")'>Modificar</button></td>
				</tr>";
	}	
echo "</table>";		
?>
		</div>
	</div>
</body>
</html>