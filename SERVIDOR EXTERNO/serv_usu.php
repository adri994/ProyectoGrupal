<?php
include "config.php";
include "utils.php";


$dbConn =  connect($db_usu);

//Servicios de excritura

	
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	if($_POST['cas']==$cod_acc_serv) {

	    if ($_POST['accion']=='alta') {
	        // Alta de un nuevo paciente
	        // recibe: dni, nombre, apellido, apellido_2, email, teléfono, estado, id_usuario,
	        // devuelve: nada
	
		$resp = array();
	        $cod_acc=substr(md5(uniqid(srand(time()))),0,8);
	
	        $secuencia = "INSERT INTO paciente (dni, codigo_acceso, email, nombre, apellido_1, apellido_2, telefono, estado) VALUES (:dni, :cod, :ema, :nom, :ap1, :ap2, :tel, :est);";
	
			try {
				$sql = $dbConn->prepare($secuencia);
				$sql->bindValue(':dni', $_POST["dni"]);
				$sql->bindValue(':cod', $cod_acc);
				$sql->bindValue(':ema', $_POST["email"]);
				$sql->bindValue(':nom', $_POST["nombre"]);
				$sql->bindValue(':ap1', $_POST["apellido_1"]);
				$sql->bindValue(':ap2', $_POST["apellido_2"]);
				$sql->bindValue(':tel', $_POST["telefono"]);
				$sql->bindValue(':est', $_POST["estado"]);
				$sql->execute();  
				
		
				//header("HTTP/1.1 200 OK");
				array_push($resp, "Se ha Agregado Correctamente", "cerrar");
				
			} catch (PDOException $exception) {
				//header("HTTP/1.1 400 PASO ALGO");
				//echo "mal";
				array_push($resp, "Fallo el agregado", "cerra");
				
			}
		$vista = json_encode($resp);

		print_r($vista);

	        exit();
	    }
	
	    else if ($_POST['accion']=="nota"){
	        // Nota de rastreador o médico. Añade la nueva nota, y actualiza el estado en la tabla de pacientes al de la última nota registrada.
	        // recibe: dni, id_usuario, estado, nota
	        // devuelve: nada
	
	        // Insertamos la nota
	        $fecha=date("Y-m-d H:i:s");
	        $secuencia = "INSERT INTO  nota (dni_paciente, fecha, nota, id_usuario, estado) VALUES (:dni, :fec, :not, :idd, :est);";
	        $sql = $dbConn->prepare($secuencia);
	        $sql->bindValue(':dni', $_POST["dni"]);
	        $sql->bindValue(':fec', $fecha);
	        $sql->bindValue(':not', $_POST["nota"]);
	        $sql->bindValue(':idd', $_POST["id_usuario"]);
	        $sql->bindValue(':est', $_POST["estado"]);    
	        $sql->execute();
	
	        // modificamos el estado del paciente
	        $secuencia = "UPDATE paciente SET estado=:est WHERE dni=:dni";    
	        $sql = $dbConn->prepare($secuencia);
	        $sql->bindValue(':dni', $_POST["dni"]);
	        $sql->bindValue(':est', $_POST["estado"]);    
	        $sql->execute();
	        echo "ok";
	        header("HTTP/1.1 200 OK");
	        exit();    
	
	    }
	    
	    else if ($_POST['accion']=="actualizar_nota"){
	        // Actualiza nota del médico.
	        // recibe: dni, estado, nota, y la id de la nota
	        // devuelve: nada
	
	        // modificamos la nota
	        
	        $fecha=date("Y-m-d H:i:s");
	        $secuencia = "UPDATE nota SET nota=:not, estado=:est WHERE id=:idn;";
	        $sql = $dbConn->prepare($secuencia);
	        $sql->bindValue(':not', $_POST["nota"]);
	        $sql->bindValue(':est', $_POST["estado"]);
	        $sql->bindValue(':idn', $_POST["id_nota"]);
	 
	        $sql->execute();
	
	        // modificamos el estado del paciente si fuera necesario
	        // para ello, buscamos en la tabla nota el último estado de ese paciente y lo ponemos en la tabla paciente.
	        $secuencia = "SELECT estado FROM nota WHERE dni_paciente=:dni ORDER BY fecha DESC LIMIT 1;";  
	        $sql = $dbConn->prepare($secuencia);
	        $sql->bindValue(':dni', $_POST["dni"]);
	        $sql->execute();
	        $sql->setFetchMode(PDO::FETCH_ASSOC);
	        $ult_est_nota=$sql->fetchAll();
	        
	        $secuencia = "SELECT estado FROM paciente WHERE dni=:dni;";
	        $sql = $dbConn->prepare($secuencia);
	        $sql->bindValue(':dni', $_POST["dni"]);
	        $sql->execute();
	        $sql->setFetchMode(PDO::FETCH_ASSOC);
	        $ult_est_paciente=$sql->fetchAll();
	        
	        if ($ult_est_nota[0]['estado']!=$ult_est_paciente[0]['estado']) {
	        	$secuencia = "UPDATE paciente SET estado=:est WHERE dni=:dni;";
	        	$sql->bindValue(':dni', $_POST["dni"]);
		        $sql->bindValue(':est', $ult_est_nota[0]['estado']);    
		        $sql->execute();
	      	 
	      	 }
			        
	        
	        echo "ok";
	        header("HTTP/1.1 200 OK");
	        exit();  
		}else if ($_POST['accion']=="actualizar_paciente"){
			
			$resp = array();

			$secuencia = "UPDATE paciente SET nombre=:nom,apellido_1=:ap1,apellido_2=:ap2,email=:ema,telefono=:tel WHERE codigo_acceso=:cod";
			$sql = $dbConn->prepare($secuencia);

			try{
				$sql->bindValue(':cod', $_POST['codigo']);
				$sql->bindValue(':ema', $_POST["email"]);
				$sql->bindValue(':nom', $_POST["nombre"]);
				$sql->bindValue(':ap1', $_POST["apellido_1"]);
				$sql->bindValue(':ap2', $_POST["apellido_2"]);
				$sql->bindValue(':tel', $_POST["telefono"]);
				$sql->execute(); 
				array_push($resp, "Se ha agregado exitosamente", "cerrar");
				
			}catch (PDOException $exception) {
				//header("HTTP/1.1 400 PASO ALGO");
				//echo "mal";
				array_push($resp, "Fallo el agregado", "cerra");
				
			}
		$vista = json_encode($resp);

		print_r($vista);
		exit();
		}
	}
	else {
	    header("HTTP/1.1 403 No tiene permisos de acceso");
	    exit();  		
	} 
}


// Servicios de consulta
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	if($_GET['cas']==$cod_acc_serv) {	
	    if(isset($_GET['accion'])){
	        switch ($_GET['accion']) {
	            case 'lista':
	                // Listados de pacientes
	            	if (isset($_GET['filtro'])){
						switch ($_GET['filtro']) {
							case 'id':
								// Recibe el id del usuario
								// Devuelve el listado de pacientes con dni, nombre, apellidos, codigo de acceso y estado actual de los pacientes con notas registradas por el usuario concreto.
								$secuencia="SELECT DISTINCT dni, nombre, apellido_1, apellido_2, codigo_acceso, paciente.estado FROM paciente INNER JOIN nota ON nota.dni_paciente=paciente.dni WHERE nota.id_usuario=:idu ORDER BY apellido_1, apellido_2;";
								$sql = $dbConn->prepare($secuencia);
								$sql->bindValue(':idu', $_GET["valor"]);
								break;
							case 'dni':
								// Recibe el dni del paciente
								// Devuelve el paciente que tenga ese dni, con dni, nombre, apellidos, codigo de acceso y estado actual.
								$secuencia="SELECT dni, nombre, apellido_1, apellido_2, codigo_acceso, estado FROM paciente WHERE dni=:dni;";
								$sql = $dbConn->prepare($secuencia);
								$sql->bindValue(':dni', $_GET["valor"]);
								break;
							case 'codigo_acceso':
								// Recibe el código de acceso del paciente
								// Devuelve el paciente que tenga ese dni, con dni, nombre, apellidos, codigo de acceso y estado actual.
								$secuencia="SELECT dni, nombre, apellido_1, apellido_2, codigo_acceso, estado FROM paciente WHERE codigo_acceso=:cac;";
								$sql = $dbConn->prepare($secuencia);
								$sql->bindValue(':cac', $_GET["valor"]);
								break;
							case 'apellidos':
								// Recibe el primer apellido, y el segundo y el nombre separados por , si se envían
								// Devuelve el o los pacientes que respondan a los criterios de búsqueda de apellidos y nombre, con dni, nombre, apellidos, codigo de acceso y estado actual. Basta con las primeras letras
								$identidad=explode(',', $_GET['valor']);
								$secuencia="SELECT dni, nombre, apellido_1, apellido_2, codigo_acceso, estado FROM paciente WHERE apellido_1 LIKE :ap1 AND apellido_2 LIKE :ap2 AND nombre LIKE :nom ORDER BY apellido_1 ASC, apellido_2 ASC;";
								$sql = $dbConn->prepare($secuencia);
								$sql->bindValue(':ap1', $identidad[0].'%');
								$sql->bindValue(':ap2', $identidad[1].'%');
								$sql->bindValue(':nom', $identidad[2].'%');
								break;
							case 'estado':
								// Recibe tres valores booleanos para saber filtro de estado se aplica
								// Devuelve todos los pacientes que cumplan las condiciones de estado, con dni, nombre, apellidos, codigo de acceso y estado actual.
								$secuencia="SELECT dni, nombre, apellido_1, apellido_2, codigo_acceso, estado FROM paciente WHERE ";
								$estado=explode(',', $_GET['valor']);
								if ($estado[0]=='true') {$secuencia.="estado='contagiado' OR ";}
								if ($estado[1]=='true') {$secuencia.="estado='curado' OR ";}
								if ($estado[2]=='true') {$secuencia.="estado='fallecido' OR ";}
								$secuencia=substr($secuencia,0,strlen($secuencia)-3)."ORDER BY apellido_1 ASC, apellido_2 ASC;";
								$sql = $dbConn->prepare($secuencia);
								break;
							case '':
								// Recibe nada
								// Devuelve todos los pacientes con dni, nombre, apellidos, codigo de acceso y estado actual.
								$secuencia="SELECT dni, nombre, apellido_1, apellido_2, codigo_acceso, estado FROM paciente ORDER BY apellido_1 ASC, apellido_2 ASC;";
								$sql = $dbConn->prepare($secuencia);
								break;					
						}
					}
	                $sql->execute();
	                $sql->setFetchMode(PDO::FETCH_ASSOC);
	                echo json_encode($sql->fetchAll(),JSON_INVALID_UTF8_IGNORE);
	                header("HTTP/1.1 200 OK");        
	                exit();
	                break;
	            
	            case 'datos':
	                // Datos del paciente para el rastreador
	                // recibe: dni del paciente
	                // Devuelve: nombre, apellidos, dni, email, teléfono, fecha primer contagio, número de notas registradas
						
	               if (isset($_GET['dni'])){
						$secuencia = "SELECT * FROM paciente WHERE dni=:dni;";
	                    $sql = $dbConn->prepare($secuencia);
	                    $sql->bindValue(':dni', $_GET["dni"]);
	
	                    $sql->execute();
	                    $sql->setFetchMode(PDO::FETCH_ASSOC);
	                    $sql0=$sql->fetchAll();
	                    
	                    $secuencia = "SELECT id_usuario, fecha FROM nota WHERE dni_paciente=:dni ORDER BY fecha ASC;";
	                    $sql = $dbConn->prepare($secuencia);
	                    $sql->bindValue(':dni', $_GET["dni"]);
	
	                    $sql->execute();
	                    $sql->setFetchMode(PDO::FETCH_ASSOC);                    
	                    $sql1=$sql->fetchAll();
	                     
	                    //print_r($sql0);
	                    //print_r($sql1);
	                    
	                    $sql2=$sql0;
	                    $sql2[0]['id_usuario']=$sql1[0]['id_usuario'];
	                    $sql2[0]['fecha']=$sql1[0]['fecha'];
	                    $sql2[0]['notas']=count($sql1);
	                    //print_r($sql2);
	                    //print_r($sql->fetchAll());
	                    echo json_encode($sql2,JSON_INVALID_UTF8_IGNORE);
	                    header("HTTP/1.1 200 OK");        
	                 	exit();
					}
		           	break;
				
				case 'notas':
	         		// historia clínica del paciente
	         		// recibe: dni del paciente
	         		// devuelve todas las notas asociadas.
	         		$sql = $dbConn->prepare("SELECT id, nota, fecha, id_usuario, estado FROM nota WHERE dni_paciente=:dni ORDER BY fecha DESC;");
		      		$sql->bindValue(':dni', $_GET['dni']);
	    	  		$sql->execute();
	      			$sql->setFetchMode(PDO::FETCH_ASSOC);
	      			echo json_encode($sql->fetchAll(),JSON_INVALID_UTF8_IGNORE);
		      	
			    	header("HTTP/1.1 200 OK");
	        		exit();
	         		break;
			}
	    }
	}
	else{
	    header("HTTP/1.1 403 No tiene permisos de acceso");
	    exit();  		
	}
}



//En caso de que ninguna de las opciones anteriores se haya ejecutado
header("HTTP/1.1 400 Problema de comunicación");

?>
