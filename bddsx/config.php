<?php

// dirección del servidor externo:
//$ser_ext='http://192.168.0.57/vcserver/';
//$ser_ext='http://192.168.1.10/covid/';
$ser_ext='http://192.168.1.17/servidor/';

// código de acceso al servidor
$cod_acc_serv='a2b7878e96994cfdf318';

if(isset($_POST['envio'])){
    $codigo = [$ser_ext,$cod_acc_serv];
    echo json_encode($codigo,JSON_INVALID_UTF8_IGNORE);
}
