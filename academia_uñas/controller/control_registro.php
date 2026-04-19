<?php
include "config/conexion.php";

if (!empty($_POST["btnregistrar"])) {
    $errores = []; // Aquí guardaremos los mensajes

    // Validar Primer Nombre
    if (empty($_POST["n1"])) {
        $errores[] = "Falta el Primer Nombre.";
    }
        // Validar Segundo Nombre
    if (empty($_POST["n2"])) {
        $errores[] = "Falta el Segundo Apellido.";
    }

    // Validar Primer Apellido
    if (empty($_POST["a1"])) {
        $errores[] = "Falta el Primer Apelliddo.";
    }
        // Validar Segundo Apellido
    if (empty($_POST["a2"])) {
        $errores[] = "Falta el Segundo Apellido.";
    }

    // Validar Email
    if (empty($_POST["email"])) {
        $errores[] = "Falta en Correo electrónico.";
    }

    // Validar Contraseñas
    if (empty($_POST["password"])) {
        $errores[] = "Debes ingresar una contraseña.";
    } elseif ($_POST["password"] !== $_POST["password_confirm"]) {
        $errores[] = "Las contraseñas no coinciden.";
    }

    // SI NO HAY ERRORES, PROCEDEMOS
    if (empty($errores)) {
        $n1 = $_POST["n1"];
        $n2 = $_POST["n2"];
        $a1 = $_POST["a1"];
        $a2 = $_POST["a2"];
        $email = $_POST["email"];
        $password_hashed = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre1, nombre2, apellido1, apellido2, email, password) 
                VALUES ('$n1', '$n2', '$a1', '$a2', '$email', '$password_hashed')";
        
        if (mysqli_query($conexion, $sql)) {
            echo '<div class="success">¡Registro exitoso!</div>';
        } else {
            echo '<div class="alert">Error en la base de datos: ' . mysqli_error($conexion) . '</div>';
        }
    } else {
        // MOSTRAR ERRORES INDEPENDIENTES
        foreach ($errores as $error) {
            echo '<div class="alert">' . $error . '</div>';
        }
    }
}
?>