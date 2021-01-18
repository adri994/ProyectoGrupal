<?php
session_start();
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Rastreador') {
    header("Location: data_source/cerrarUsuario.php?error=1");
}

?>


<!doctype html>
<html lang="es">
<head>
<title>Covid - Rastreador</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="fedelleos@gmail.com" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="./css/css.css">

    <link rel="shortcut icon" href="img/logo_1.png"/>
</head>
<body>
<?php include 'navbar.php';?>
    <div class="container d-flex justify-content-between p-5">
        <button id='newPaciente' class="btn btn-success">Nuevo Paciente</button>
        <button id='buscar' class="btn btn-success" value=''>Buscar</button>
    </div>
    <div class='container-fluid'>
        <div id='infoRastreador' class='d-flex justify-content-center'></div>
        <div id='infoModal' class='d-flex justify-content-center'></div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
    <script src="./js/rastreador.js" type='module'></script>

</body>

</html>