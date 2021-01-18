<?php
/* Autor fede */
require '../bddsx/config.php';
require '../bdd/config.php';
require '../bdd/consulta.php';
session_start();

if (isset($_POST['submit'])) {   
    $conn = Cuentas::loginAdmin();
    $result = Consulta::updateUsuarios($conn);  //Actualiza usuarios de la lista
    if ($result) {
        switch ($_SESSION['rol']) {
            case 'Administrador':               
                header("Location:../administrador.php");
                break;
            case 'Rastreador':header("Location:../rastreador.php");
                break;
            case 'Médico':header("Location:../medico.php");
                break;
        }
    } else {

        header("Location: cerrarUsuario.php?error='1'");
    }
}

// añadido José Luis


