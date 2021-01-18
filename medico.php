<?php

require 'bddsx/config.php';
session_start();
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Médico') header("Location: data_source/cerrarUsuario.php?error=1");

?>

<!DOCTYPE html>
	<html lang="es">
	<head>
	<title>Covid - Médico</title>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="author" content="fedelleos@gmail.com" />  
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <!-- css -->
	    <link rel="stylesheet" href="css/css.css">
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	    </script>
	   	<script type="text/javascript" src="js/cliente.js"></script>



	   	<link rel="shortcut icon" href="img/logo_1.png"/>
	   	<style type="text/css">
	   		
	   		#editable{
	   			cursor: pointer;
	   		}
	   		#editable:hover {
	   			color: blue;
	   		}
	   		input{
	   			width: 100%;
	   		}


	   	</style>
	</head>
	<body>
	<?php include 'navbar.php';
	?>


		<div class="container" id="listas">
			<button type="button" onclick="lista(<?php echo $_SESSION['id']; ?>)" class="btn btn-primary btn-sm">Mis pacientes</button>
			<button type="button" onclick="lista('')" class="btn btn-primary btn-sm">Lista completa</button>
			<button type='button' onclick='busqueda()' class='btn btn-primary btn-sm' title="Para buscar, introduzca un dni, un código de acceso o un primer apellido. La prioridad de búsqueda se hará en ese orden obviando el resto de datos. Para filtrar por estado, únicamente marque los estados que quiere recuperar">Buscar</button>
		</div>


		<div class="container" id="menu_medico">
	
				<div class='row'>
					<div class='col-lg-3 col-md-6'>
						<label for="apellido_1">Primer apellido</label><br>
						<input type='text' name='apellido_1' id="apellido_1">
					</div>
					<div class='col-lg-3 col-md-6'>
						<label for="apellido_2">Segundo apellido</label><br>
						<input type='text' name='apellido_2' id="apellido_2"></div>
					<div class='col-lg-2 col-md-3'>
						<label for="nombre">Nombre</label><br>
						<input type='text' name='nombre' id="nombre"></div>
					<div class='col-lg-2 col-md-3'>
						<label for="dni">D.N.I / N.I.E</label><br>
						<input type='text' name='dni' id="dni"></div>
					<div class='col-lg-2 col-md-3'>
						<label for="codigo_acceso">Código de acceso</label><br>
						<input type='text' name='codigo_acceso' id="codigo_acceso"></div>
				</div>
				<div class="container">
					<label class="checkbox-inline">
						<input type="checkbox" id="contagiado" value=""> Contagiado
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" id="curado" value=""> Curado
					</label>
					<label class="checkbox-inline">
						<input type="checkbox" id="fallecido" value=""> Fallecido
					</label>
				</div>

			<hr>
			


		</div>
		<div class="container">
			<h4 id="titulo"></h4>
		</div>

		<div class="container" id="seccion">

		</div>
		<div class="container" id="adicional">

		</div>




    	   
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	    </script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	    </script>
	    <script type="text/javascript">lista(<?php echo $_SESSION['id']; ?>)</script>
	</body>

	</html>

