<?php

$user = '';

if (isset($_SESSION['nombre'])) {
    $user = $_SESSION['nombre'];
}

?>
<!-- author: fedelleos@gmail.com -->

<nav class="navbar navbar-expand-sm navbar-light bg-light">
    <a class="navbar-brand" href="index.php"><img id='logo' src="img/logo_1.png"><span class="ml-4 text-success">Centro Covid 2020</span></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
    <span class="navbar-toggler-icon"></span>
  </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <div class="d-flex ml-auto">
            <?php
                if ($user == 'recuperacion') {} elseif ($user == '') {
                    echo '






                        <a class="nav-link text-info" href="index.php?log=us">Usuarios<span class="sr-only">(current)</span></a>
                        <a class="nav-link text-info" href="index.php?log=pa">Pacientes</a>
                    ';
                }
                else {
                    if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'paciente') {
                        echo '<a id="user" class="nav-link text-success" href="#">' . $user . '<span class="sr-only">(current)</span></a>';
                    }
                    else {
                        echo '<a id="user" class="nav-link text-success" href="modificar_usuario.php">' . $user . '<span class="sr-only">(current)</span></a>';
                    }
                    echo '<a class="nav-link text-secondary" href="./data_source/cerrarUsuario.php">Salir<span class="sr-only">(current)</span></a>';
                }
            ?>
        </div>
    </div>
</nav>