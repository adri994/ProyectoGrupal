<?php
    /* Autor Adrian */
    class Cuentas{

        public static function login(){
            $host = "localhost";
            $db = "covid_usuario";
            $usuarios = "login";
            $pass = "1234";
            $conn = new mysqli($host, $usuarios, $pass,$db);

            return $conn;
        }

        public static function loginAdmin(){
            $host = "localhost";
            $db = "covid_usuario";
            $usuarios = "admin";
            $pass = "1234";
            $conn = new mysqli($host, $usuarios, $pass,$db);

            return $conn;
        }

        public static function loginPDO(){

            $db = [
                'host' => 'localhost;charset=utf8',
                'username' => 'root',
                'password' => '',
                'db' => 'covid_usuario' //Cambiar al nombre de tu base de datos
            ];

            try {
                $conn = new PDO("mysql:host={$db['host']};dbname={$db['db']}", $db['username'], $db['password']);
      
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      
                return $conn;
            } catch (PDOException $exception) {
                exit($exception->getMessage());
            }
        }
    }

?>