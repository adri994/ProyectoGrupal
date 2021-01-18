<?php

require '../bddsx/config.php';
session_start();
if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Médico') header("Location: data_source/cerrarUsuario.php?error=1");

$curl = curl_init();

$parametros=array('accion' => 'nota','cas' => $cod_acc_serv,'dni' => $_GET['dni'],'nota' => $_GET['nueva_nota'],'id_usuario' => $_SESSION['id'], 'estado' => $_GET['nuevo_estado']);
if ($_GET['bot_modif']=='Actualizar') {
	$parametros['accion']='actualizar_nota';
	$parametros += [ 'id_nota' => $_GET['id_nota']];
}

curl_setopt_array($curl, array(
  CURLOPT_URL => $ser_ext.'serv_usu.php',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $parametros));





$response = curl_exec($curl);

curl_close($curl);
header("Location: ../editar_paciente.php?dni=".$_GET['dni']);

?>