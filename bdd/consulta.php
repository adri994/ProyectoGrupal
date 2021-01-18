<?php

class Consulta
{
    /* autor:Autor */
    public static function verificarUser($conn)
    {
        $stmt = $conn->prepare("SELECT * FROM `user` WHERE Email = ? AND Contrasena = ?");
        $stmt->bind_param("ss", $_POST["email"], $_POST["password"]);
        $stmt->execute();
        $vista = $stmt->get_result();
        $conn->close();
        return $vista;
    }

    public static function listado_usuarios($conn)
    {

        $stmt = $conn->prepare("SELECT * FROM `user`");
        $stmt->execute();
        $vista = $stmt->get_result();
        $conn->close();
        return $vista;
    }

    public static function verificarEmail($conn)
    {

        $stmt = $conn->prepare("SELECT * FROM `user` WHERE Email = ?");
        $stmt->bind_param("s", $_POST["emailNew"]);
        $stmt->execute();
        $vista = $stmt->get_result();
        return $vista;
    }

    public static function ingresarUsuario($conn)
    {

        $stmt = $conn->prepare("INSERT INTO user (Nombre,Apellido_1,Apellido_2,Email,Contrasena,Roll) VALUES (?,?,?,?,?,?)");
        $stmt->bind_param("ssssss", $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["email"], $_POST["password"], $_POST["rol"]);
        $stmt->execute();
        return true;
    }

    public static function deteleUser($conn)
    {
        $stmt = $conn->prepare("DELETE FROM `user` WHERE ID = ?");
        $stmt->bind_param("s", $_GET["userDelete"]);
        $stmt->execute();
        $vista = $stmt->get_result();
    }

    public static function deteleUsers($conn)
    {
        $stmt = $conn->prepare("DELETE FROM `user` WHERE ID = ?");
        $stmt->bind_param("s", $_GET["userDelete"]);
        $stmt->execute();
        $vista = $stmt->get_result();
    }

    public static function updateUser($conn)
    {
        $stmt = $conn->prepare("UPDATE user SET Nombre=?,Apellido_1=?,Apellido_2=?,Email=?, Contrasena=? WHERE ID = ?");
        $stmt->bind_param("sssssd", $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["email"], $_POST["password"], $_POST['submit']);
        $stmt->execute();
        $_SESSION['nombre'] = $_POST["nombre"];
        $_SESSION['apellido1'] = $_POST["apellido1"];
        $_SESSION['apellido2'] = $_POST["apellido2"];
        $_SESSION['email'] = $_POST["email"];
        $_SESSION['password'] = $_POST["password"];

        return true;

    }

    // Actualiza los usuarios del listado, no el de la session
    public static function updateUsuarios($conn)
    {
        if (isset($_POST['rol'])) {
            $stmt = $conn->prepare("UPDATE user SET Nombre=?,Apellido_1=?,Apellido_2=?,Email=?, Contrasena=?,Roll=? WHERE ID = ?");
            $stmt->bind_param("ssssssd", $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["email"], $_POST["password"], $_POST["rol"], $_POST['submit']);
            $stmt->execute();
            if ($_POST['submit'] == $_SESSION['id']) {
                    $_SESSION['nombre'] = $_POST["nombre"];
                    $_SESSION['apellido1'] = $_POST["apellido1"];
                    $_SESSION['apellido2'] = $_POST["apellido2"];
                    $_SESSION['email'] = $_POST["email"];
                    $_SESSION['password'] = $_POST["password"];
            }
        } else {
            $stmt = $conn->prepare("UPDATE user SET Nombre=?,Apellido_1=?,Apellido_2=?,Email=?, Contrasena=? WHERE ID = ?");
            $stmt->bind_param("sssssd", $_POST["nombre"], $_POST["apellido1"], $_POST["apellido2"], $_POST["email"], $_POST["password"], $_POST['submit']);
            $stmt->execute();
        }

        return true;
    }

    //JL

    public static function userId($conn, $id)
    {
        $stmt = $conn->prepare("SELECT Nombre, Apellido_1, Roll FROM `user` WHERE ID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $vista = $stmt->get_result();
        $datos = $vista->fetch_assoc();
        return $datos;
    }

    public static function listadoAv($conn, $email)
    {

        $sql = $conn->prepare('SELECT * FROM user WHERE Email LIKE :email');
        $sql->bindValue(':email', $email);
        $sql->execute();
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        return $sql;

    }

}
