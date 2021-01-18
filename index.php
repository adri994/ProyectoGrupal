<?php

session_start();

?>
<!doctype html>
<html lang="es">
<head>
<title>Covid - Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="fedelleos@gmail.com" />  
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- css -->
    <link rel="stylesheet" href="css/css.css">
    <link rel="shortcut icon" href="img/logo_1.png"/>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
</head>
<body>
<?php include 'navbar.php'; 

if(isset($_GET['log'])) {
    if($_GET['log'] == 'pa') {        
        $_SESSION['user_type'] = 'paciente';       
    } else {
        $_SESSION['user_type'] = 'usuario';        
    }
}



  
?>
    <div class="container d-flex justify-content-center p-5">
     
        <div id="login-box" class="col-md-6">
            <form id="login-form" action="./data_source/validar_login.php" method="post">
                <h3 class="text-center text-info">Login</h3>
                <?php

                    if(isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'usuario') {

                        echo '
                    <div class="form-group">
                        <label for="email" class="text-info">Email</label><br>
                        <input type="email" name="email" id="email" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <label for="password" class="text-info">Password:</label><br>
                        <input type="password" name="password" id="password" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-md">Entrar</button>
                        <a href="recuperacion.php?usu">¿No recuerdas tú contraseña?</a>
                    </div>
                    ';
                    }  else {
                        echo '
                    <div class="form-group">
                        <label for="dni" class="text-info">Dni</label><br>
                        <input type="dni" name="dni" id="dni" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <label for="code" class="text-info">Código de acceso</label><br>
                        <input type="text" name="code" id="code" class="form-control"  required>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="submit" class="btn btn-info btn-md">Entrar</button>
                        <a href="recuperacion.php?pac">¿No recuerdas tú código de acceso?</a>
                    </div>
                    ';
                    }
                ?>
               
            </form>
        </div>

    </div>


   
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src='js/scripts.js' type='module'></script>
</body>

</html>