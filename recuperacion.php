<?php
include 'bdd/config.php';
include 'bdd/consulta.php';
include 'bddsx/config.php';


$_SESSION['nombre'] = 'recuperacion';
if (isset($_POST['emailNew'])) {
    // Recuperacion pass para usuario
    if (isset($_GET['usu'])) {       
        $conn = Cuentas::login();
        $result = Consulta::verificarEmail($conn);
        $num_row = $result->num_rows;
        if ($num_row === 1) {
            foreach ($result as $key) {
                $pass = $key['Contrasena'];
                echo $pass;
                envia($pass);
            }
        }
    } else {       
        // Recuperacion codigo para paciente
        envia(recuperaCod());        
    }
}

function envia($pass)
{
    // the message
    $msg = "Recuperación de Credenciales\nTu clave es: " . $pass;
    // En windows hay que hcer conviersion
    $msg = str_replace("\n.", "\n..", $msg);
    // use wordwrap() if lines are longer than 70 characters
    // $msg = wordwrap($msg, 70,"\r\n");
    // localhost no permite enviar correos entonces,
    // Nos descargamos un emulador de servidor de correo: git clone https://github.com/rnwood/smtp4dev.git y ejecutamos el .exe para ver los correos enviados: http://localhost:5000/
    // send email, los headers la doc dicen que son opcionales pero no, son obligatorios si no no envia.
    $email = $_POST['emailNew'];
    $headers = array(
        'From' => 'fedelleos@gmail.com',
        'Reply-To' => 'fedelleos@gmail.com',
        'X-Mailer' => 'PHP/' . phpversion()
    );
    if (mail($email, "Covid - Recuperación de Credenciales", $msg, $headers)) {
        header("Location: index.php?enviado!");
    }
}

function recuperaCod() {
    global $cod_acc_serv, $ser_ext ;
    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $ser_ext.'serv_pac.php?cas='.$cod_acc_serv.'&accion=recupera_codigo&email='.$_POST['emailNew'],
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
         return $response[0]['codigo_acceso'];        
    }
    
}


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
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <link rel="shortcut icon" href="img/logo_1.png"/>
</head>

<body>
    <?php
include 'navbar.php';

?>

    <div class="container d-flex justify-content-center p-5">
        <div id="login-box" class="col-md-6">
            <form id="login-form" action="" method="post">
                <h3 class="text-center text-info">Recuperación de claves</h3>
                <div class="form-group">
                    <label for="email" class="text-info">Email</label><br>
                    <input type="email" name="emailNew"  class="form-control" required>
                </div>

                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-info btn-md">Enviar</button>
                </div>
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

