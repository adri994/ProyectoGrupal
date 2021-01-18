<?php

require 'bddsx/config.php';
session_start();
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Médico') header("Location: data_source/cerrarUsuario.php?error=1");

?>

<!DOCTYPE html>
	<html lang="es">
	<head>
	<title>Covid - Médico: edición paciente</title>
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


	   	</style>
	</head>
	<body>
	<?php include 'navbar.php';
	?>
		<div class="container">
			<h4 id="titulo">Notas del paciente</h4>
		</div>

		<div class="container" id="seccion">
			<div class='row'>
				<div class='col-xl-4 col-lg-6 col-md-8' id="nombreApell">
					<b>Nombre: </b>
				</div>
				<div class='col-xl-2 col-lg-3 col-md-4' id="dni">
					<b>DNI: </b>
				</div>
				<div class='col-xl-2 col-lg-3 col-md-4' id="telefono">
					<b>Teléfono: </b>
				</div>
				<div class='col-xl-4 col-lg-6 col-md-8' id="email">
					<b>Email: </b>
				</div>

				<div class='col-xl-4 col-lg-3 col-md-4' id="cap">
					<b>Código de acceso: </b>
				</div>
				<div class='col-xl-4 col-lg-3 col-md-4' id="estado">
					<b>Estado actual: </b>
				</div>
			</div>

			<hr>
			<form id="nueva_nota" action="data_source/nueva_nota.php">
	    		<div class='form-group'>
		    		
		    			<div class='row pb-2' >
		    				<label for='nota'><b>  Nota: </b></label>
		    		    	<textarea class='form-control' rows='5' name='nueva_nota' id='nota' required></textarea>
		    		  	</div>
	    		    	<div class='row '>
	    		    		<div class='col-8 text-left'>
		    		           	<div class='form-check-inline'>
		    		            	<label class='form-check-label' for='est_cont'> <input type='radio' class='form-check-input' name='nuevo_estado' id='est_cont' value='contagiado' checked>Contagiado</label>
								</div>
		    		          	<div class='form-check-inline'>
		    		            	<label class='form-check-label' for='est_cur'> <input type='radio' class='form-check-input' name='nuevo_estado' id='est_cur' value='curado'>Curado</label>
		    		          	</div>
		    		          	<div class='form-check-inline'>
		    		            	<label class='form-check-label' for='est_fall'> <input type='radio' class='form-check-input' name='nuevo_estado' id='est_fall' value='fallecido'>Fallecido</label>
		    		          	</div>
		    		    	</div>

		    		      	<div class='col-4 text-right'>
		    		        	<input type='submit' class='btn btn-secondary btn-sm' title='Añadir nota al historial del paciente' name='bot_modif' value='Añadir' id='bot_modif'>
		    		        	<button class='btn btn-secondary btn-sm' title='Salir sin guardar los datos' onclick='confirmar()'>Salir</button>
		    		      	</div>
		    		  	</div>
		    		</div>
					<input type='hidden' name='dni' value='<?php echo $_GET['dni'] ?>'>
					<input type='hidden' name='id_nota' id='id_nota'>	
	    		</form>

		</div>
		
		<div class="container" id="tituloadicional">
			<b><u>HISTORIA CLÍNICA</b></u><br>
		</div>

		<div class="container" id="adicional">
			Solicitando datos
			<img src="img/progresbar.gif" height="13">
		</div>




    	   
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	    </script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	    </script>

	    <script type="text/javascript">datosPaciente("<?php echo $_GET['dni'] ?>")</script>
	    <script type="text/javascript">editar("<?php echo $_GET['dni'] ?>")</script>

	</body>
</html>

