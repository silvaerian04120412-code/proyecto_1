<?php
session_start(); // Iniciamos sesión para que el usuario sea recordado
include "config/conexion.php";

if (!empty($_POST["btningresar"])) {
    if (!empty($_POST["email"]) && !empty($_POST["password"])) {
        
        $email = $_POST["email"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = mysqli_query($conexion, $sql);

        if ($datos = mysqli_fetch_object($resultado)) {
            // Verificamos si la contraseña coincide con el hash guardado
            if (password_verify($password, $datos->password)) {
                $_SESSION["id"] = $datos->id;
                $_SESSION["nombre"] = $datos->nombre;
                header("location: home.php"); // Redirigir a la página principal
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "El usuario no existe";
        }
    } else {
        echo "Campos vacíos";
    }
}
?>
