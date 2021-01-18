<?php
/* Autor fede */
session_start();
require '../bdd/config.php';
require '../bdd/consulta.php';


if (isset($_POST['submit'])) {   
    $conn = Cuentas::loginAdmin();
    $result = Consulta::ingresarUsuario($conn);
    if ($result) {
       header("Location:../administrador.php");              
    } else {
        header("Location:cerrarUsuario.php?error='1'");
    }
}



