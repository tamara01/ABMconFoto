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
		function Validar()
		{
			var ape = document.getElementById('apellido').value;
			var nom = document.getElementById('nombre').value;
			var dni = document.getElementById('dni').value;
			var envio = true;
			
			if(!ValidarCadena(ape)){
				document.getElementById('lblApellido').style.display = "block";
				envio = false;
			}
			else{
				document.getElementById('lblApellido').style.display = "none";
			}
			
			if(!ValidarCadena(nom)){
				document.getElementById('lblNombre').style.display = "block";
				envio = false;
			}
			else{
				document.getElementById('lblNombre').style.display = "none";
			}

			if(!ValidarCadena(dni)){
				document.getElementById('lblDni').style.display = "block";
				envio = false;
			}
			else{
				document.getElementById('lblDni').style.display = "none";
			}

			if(envio){
				document.getElementById("hdnAgregar").value="Guardar";
				document.getElementById("FormIngreso").submit();
			}
		}
		function ValidarCadena(cad)
		{
			if(cad === "")
				return false;
			return true;
		}
        </script>
</head>
<body>
	<a class="btn btn-info" href="index.html">Menu principal</a>
	<a class="btn btn-info" href="grilla.php">Grilla</a>
<?php     
	require_once("clases\Personas.php");

	$titulo = "ALTA";
	if(isset($_POST['dniParaModificar'])) //viene de la grilla
	{
		$unaPersona = Persona::TraerUnaPersona($_POST['dniParaModificar']);
		$titulo = "MODIFICACION";
	} 
?>
	<div class="container">
		
		<div class="CajaInicio animated bounceInRight">
			<h1> <?php echo $titulo; ?></h1>

			<form id="FormIngreso" method="post" action="alta.php" enctype="multipart/form-data">
				<input type="text" name="apellido" id="apellido" placeholder="ingrese apellido" value="<?php echo isset($unaPersona) ?  $unaPersona->GetApellido() : "" ; ?>" /><span id="lblApellido" style="display:none;color:#FF0000;width:1%;float:right;font-size:80">*</span>
				<input type="text" name="nombre" id="nombre" placeholder="ingrese nombre" value="<?php echo isset($unaPersona) ?  $unaPersona->GetNombre() : "" ; ?>" /> <span id="lblNombre" style="display:none;color:#FF0000;width:1%;float:right;font-size:80">*</span>
				<input type="text" name="dni" id="dni" placeholder="ingrese dni" value="<?php echo isset($unaPersona) ?  $unaPersona->GetDni() : "" ; ?>" /> <span id="lblDni" style="display:none;color:#FF0000;width:1%;float:right;font-size:80">*</span>
				<input type="file" class="MiBotonUTN" name="archivo" >
				<input type="hidden" name="dniModif" value="<?php echo isset($unaPersona) ? $unaPersona->GetDni() : "" ; ?>" />
				<br>
				<input type="button" class="btn btn-danger" name="guardar" value="Guardar" onclick="Validar()" />
				<input type="hidden" value="" id="hdnAgregar" name="agregar" />
				</div>

			</form>
		
<?php 

if(isset($_POST['agregar']) && $_POST['agregar'] === "Guardar")// si esto no se cumple ingreso por primera vez.
{

	if($_POST['dniModif'] != "")//paso por grilla y luego guardo
	{
		$unaPersona = Persona::TraerUnaPersona($_POST['dni']);

		$nombreFoto = $_POST['dni'].".".pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
		move_uploaded_file($_FILES['archivo']['tmp_name'], "Fotos/$nombreFoto");
		

		$unaPersona->SetApellido($_POST['apellido']);
		$unaPersona->SetNombre($_POST['nombre']);
		$unaPersona->SetDni($_POST['dni']);
		$unaPersona->SetFoto($nombreFoto);
		
		$retorno = Persona::Modificar($unaPersona);
	}
	else// si es un alta
	{
		$p = new Persona();

		$nombreFoto = $_POST['dni'].".".pathinfo($_FILES['archivo']['name'], PATHINFO_EXTENSION);
		move_uploaded_file($_FILES['archivo']['tmp_name'], "Fotos/$nombreFoto");
			
		$p->SetApellido($_POST['apellido']);
		$p->SetNombre($_POST['nombre']);
		$p->SetDni($_POST['dni']);
		$p->SetFoto($nombreFoto);

		$p->Insertar();
	}	
}
?>
		</div>
	</div>
</body>
</html>