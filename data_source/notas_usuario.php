<?php 

session_start();
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Médico') header("Location: data_source/cerrarUsuario.php?error=1");
// print_r($_SESSION);
// exit();

require '../bddsx/config.php';
require '../bdd/config.php';
require '../bdd/consulta.php';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $ser_ext.'serv_usu.php?accion=notas&dni='.$_GET['dni'].'&cas='.$cod_acc_serv,
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

	if ($response[$i]['id_usuario']==$_SESSION['id']){
		$salida.="<div id='editable' class='m-1' onclick='editar(\"".$_GET['dni']."\",\"".$response[$i]['nota']."\",\"".$response[$i]['estado']."\",\"".$response[$i]['id']."\")'>";
	}
	else {
		$salida.='<div class="m-1">';
	}

	$salida.=$response[$i]['nota'];
	$salida.='</div> </div>';
	echo $salida;

}



?>