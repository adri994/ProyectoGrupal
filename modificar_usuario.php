
<!doctype html>
<html lang="es">

<head>
    <title>Covid - Modificar Usuario</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="fedelleos@gmail.com" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!-- css -->
    <link rel="stylesheet" href="css/css.css">
    <link rel="shortcut icon" href="img/logo_1.png"/>
</head>

<body>
<?php
session_start();

include 'navbar.php';

$id = $nombre = $apellido1 = $apellido2 = $email = $pass = $dni = $telefono = $rol = '';

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
}

if (isset($_SESSION['nombre'])) {
    $nombre = $_SESSION['nombre'];
}

if (isset($_SESSION['apellido1'])) {
    $apellido1 = $_SESSION['apellido1'];
}

if (isset($_SESSION['apellido2'])) {
    $apellido2 = $_SESSION['apellido2'];
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
}

if (isset($_SESSION['password'])) {
    $pass = $_SESSION['password'];
}

if (isset($_SESSION['dni'])) {
    $dni = $_SESSION['dni'];
}

if (isset($_SESSION['telefono'])) {
    $telefono = $_SESSION['telefono'];
}

if (isset($_SESSION['rol'])) {
    $rol = $_SESSION['rol'];
}

?>

    <div class="container d-flex justify-content-center p-5">
        <div id="login-box" class="col-md-6">
            <form id="login-form" action="data_source/actualizar_usuario.php" method="post">    
                <?php
                if ($_SESSION['user_type'] == 'usuario') {
                echo'
                        <h3 class="text-center text-info">Modificar Usuario</h3>
                        <div class="form-group">
                            <label for="nombre" class="text-info">Nombre</label><br>
                            <input type="text" name="nombre" id="nombre" class="form-control" value="' . $nombre . '" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido1" class="text-info">Apellido1</label><br>
                            <input type="text" name="apellido1" id="apellido1" class="form-control" value="' . $apellido1 . '" required>
                        </div>
                        <div class="form-group">
                            <label for="apellido2" class="text-info">Apellido2</label><br>
                            <input type="text" name="apellido2" id="apellido2" class="form-control" value="' . $apellido2 . '" >
                        </div>
                        <div class="form-group">
                            <label for="email" class="text-info">Email</label><br>
                            <input type="email" name="email" id="email" class="form-control" value="' . $email . '" required>
                        </div>
                        <div class="form-group">
                            <label for="password" class="text-info">Password</label><br>
                            <input type="password" name="password" id="password" class="form-control" value="' . $pass . '" required>
                        </div>  
                            ';
                            if($rol == 'Administrador' && $email != $_SESSION['email'])
                                echo '
                                <div class="form-group">
                                    <label for="roll" class="text-info">Roll</label><br>
                                    <select id="select" name="rol" >
                                        <option value="' . $rol . '">' . $rol . '</option>
                                        <option value="Médico">Médico</option>
                                        <option value="Rastreador">Rastreador</option>
                                        <option value="Administrador">Administrador</option>
                                    </select>
                                </div>
                                ';
                    echo'
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-md" value="'. $id.'">Grabar</button>
                    </div>
                    ';
                } else {
                    echo '
                    <h3 class="text-center text-info">Modificar Paciente</h3>
                    <div class="form-group">
                        <label for="email" class="text-info">Email</label><br>
                        <input type="email" name="email" id="email" class="form-control" value="' . $email . '" >
                    </div>
                    <div class="form-group">
                        <label for="nombre" class="text-info">Nombre</label><br>
                        <input type="text" name="nombre" id="nombre" class="form-control" value="' . $nombre . '" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido1" class="text-info">Apellido1</label><br>
                        <input type="text" name="apellido1" id="apellido1" class="form-control" value="' . $apellido1 . '" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido2" class="text-info">Apellido2</label><br>
                        <input type="text" name="apellido2" id="apellido2" class="form-control" value="' . $apellido2 . '" >
                    </div>
                    <div class="form-group">
                        <label for="telefono" class="text-info">Teléfono</label><br>
                        <input type="text" name="telefono" id="telefono" class="form-control" value="' . $telefono . '" required>
                    </div>                    
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-md" value="'. $dni,'">Grabar</button>
                    </div>
                    ';
                }
                ?>                
               
            </form>
        </div>
    </div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="./js/scripts.js" type='module'></script>

</body>

</html>