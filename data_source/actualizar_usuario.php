<?php
/* Autor fede */
require '../bddsx/config.php';
require '../bdd/config.php';
require '../bdd/consulta.php';
session_start();

if (isset($_POST['submit'])) { 
    if($_SESSION['user_type'] == 'usuario')  {
        $conn = Cuentas::loginAdmin();
        $result = Consulta::updateUser($conn);  //Actualiza usuario logueado
        if ($result) {
            switch ($_SESSION['rol']) {
                case 'Administrador':header("Location:../administrador.php");
                    break;
                case 'Rastreador':header("Location:../rastreador.php");
                    break;
                case 'Médico':header("Location:../medico.php");
                    break;
            }
        } else {
    
            header("Location: cerrarUsuario.php?error='1'");
        }
    } else {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $ser_ext.'serv_pac.php?accion=update&dni=' . $_POST['submit'] .'&email='.$_POST['email']. '&nombre=' . $_POST['nombre']. '&apellido1=' . $_POST['apellido1']. '&apellido2=' . $_POST['apellido2']. '&telefono=' . $_POST['telefono'].'&cas='.$cod_acc_serv,
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

        if ($response!==0) {
            $_SESSION['dni'] = $_POST['submit']; 
            $_SESSION['email'] = $_POST['email'];            
            $_SESSION['nombre'] = $_POST['nombre']; 
            $_SESSION['apellido1'] = $_POST['apellido1'] ;
            $_SESSION['apellido2'] = $_POST['apellido2'];
            $_SESSION['telefono'] = $_POST['telefono'];
            header("Location:../paciente.php");
        }
        
    }
  
}

