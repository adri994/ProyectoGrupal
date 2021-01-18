<?php
    session_start();
    // Jose Luis
    require '../bddsx/config.php';


    /* Autor adrian */
    require('../bdd/config.php');
    require('../bdd/consulta.php');


    if(isset($_POST['email']) &&  isset($_POST['password'])) {
        $conn = Cuentas::login();
        $result = Consulta::verificarUser($conn);
   
        $num_row = $result->num_rows;

        if($num_row === 1){

            foreach ($result as $key) {
                $_SESSION['user_type'] = 'usuario';
                $_SESSION['id'] = $key['ID'];
                $_SESSION['rol'] = $key['Roll'];               
                $_SESSION['nombre'] = $key['Nombre']; 
                $_SESSION['apellido1'] = $key['Apellido_1'] ;
                $_SESSION['apellido2'] = $key['Apellido_2'];
                $_SESSION['email'] = $key['Email'];
                $_SESSION['password'] = $key['Contrasena'];
                
                print_r($_SESSION);
                switch($_SESSION['rol']) {
                    case 'Administrador':   header("Location:../administrador.php");break;
                    case 'Rastreador':      header("Location:../rastreador.php");break;
                    case 'Médico':          header("Location:../medico.php");break;
                }
                
            }

        }else{
            
            header("Location: cerrarUsuario.php?error=1");
        } 
    }

    // añadido José Luis

    if(isset($_POST['dni']) &&  isset($_POST['code'])){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $ser_ext.'serv_pac.php?cas='.$cod_acc_serv.'&accion=datos&dni='.$_POST['dni'].'&codigo_acceso='.$_POST['code'],
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

        if (count($response)===1) {
            $_SESSION['user_type'] = 'paciente';
            $_SESSION['dni'] = $_POST['dni']; 
            $_SESSION['codigo_acceso'] = $_POST['code'];
            $_SESSION['nombre'] = $response[0]['nombre']; 
            $_SESSION['apellido_1'] = $response[0]['apellido_1'] ;
            $_SESSION['apellido_2'] = $response[0]['apellido_2'];
            $_SESSION['estado'] = $response[0]['estado'];
            header("Location:../paciente.php");
        }
        

    }


?>