<?php
include '../bddsx/config.php';
$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_URL => $ser_ext.'/serv_usu.php?accion=update&dni=' . $_POST['submit'] . '&nombre=' . $_POST['nombre']. '&apellido1=' . $_POST['apellido1']. '&apellido2=' . $_POST['apellido2']. '&telefono=' . $_POST['telefono'].'&cas='.$cod_acc_serv,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
));   
$response = curl_exec($curl);
curl_close($curl);
if ($response != null) {
    header("Location:../paciente.php");
} else {
    
}

?>