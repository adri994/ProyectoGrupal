<?php
session_start();
if(!isset($_SESSION['user_type']) || $_SESSION['user_type'] !== 'paciente') header("Location: data_source/cerrarUsuario.php?error=1");
require 'bddsx/config.php';
require('bdd/config.php');
require('bdd/consulta.php');
if(isset($_SESSION['dni']) && isset($_SESSION['codigo_acceso'])) {
	// consulta para el paciente
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $ser_ext.'serv_pac.php?accion=notas&dni='.$_SESSION['dni'].'&codigo_acceso='.$_SESSION['codigo_acceso'].'&cas='.$cod_acc_serv,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
    ));

    $response = json_decode(curl_exec($curl),true);
    curl_close($curl);

}

?>

	<!DOCTYPE html>
	<html lang="es">
	<head>
	<title>Covid - Paciente</title>
	    <!-- Required meta tags -->
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta name="author" content="fedelleos@gmail.com" />  
	    <!-- Bootstrap CSS -->
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
	        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	    <!-- css -->
	    <link rel="stylesheet" href="css/css.css">
	    <link rel="shortcut icon" href="img/logo_1.png"/>
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
	        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
	    </script>
	</head>
	<body>
	<?php include 'navbar.php'; 
	?>
	    <div class="container d-flex flex-column justify-content-center p-5">
	     	<div class="row-1 p-3 my-3 bg-info text-white" id="datos_paciente">
	     		<?php
	     			echo '<h6>Nombre: '.$_SESSION['nombre']." ".$_SESSION['apellido_1']." ". $_SESSION['apellido_2']."</h6><br>".
						  '<h6>Estado actual: <b>'.$_SESSION['estado'].'</b></h6>';
	    		?>	
	     	</div>
	     	<div class="row d-flex flex-column ">
	     		<?php 
	     			for ($i=0; $i<count($response);$i++) {
	     				// cosulta de los usuarios
	     				$conn = Cuentas::login();
						$result = Consulta::userId($conn,$response[$i]['id_usuario']);
						if ($result['Roll']=='Rastreador') {$rol="Rastreador: ";}
						elseif ($result['Roll']=='Médico') {$rol="Profesional Sanitario: ";}


						$fecha_formato = date('d-m-Y (H:i)',strtotime($response[$i]['fecha']));	

	     				$salida= '<div class="border p-3 my-3">';
						 $salida.= '<div class="row table-info" > <div class="col-sm-8 p-2">';
						if(isset($rol))
			     			$salida.=$rol.$result['Nombre']." ".$result['Apellido_1'];
			     		$salida.='</div> <div class="col-sm-4 text-right font-weight-bold table-info">';
			     		if(isset($response[$i]['estado'])) 
							$salida.=$fecha_formato."<br>Estado: ".$response[$i]['estado'];
						$salida.='</div> </div>';

			     		
			     		// $salida.=$fecha_formato;
			     		// $salida.='</div> </div>';

			     		$salida.='<div class="m-1">';
			     		$salida.=$response[$i]['nota'];
			     		$salida.='</div> </div>';
						echo $salida;

			     	}

		     	?>
		    </div>
	    </div>
   
	    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
	        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
	    </script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
	        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
	    </script>
	</body>

</html>
