<?php
include "config/conexion.php"; // Traemos la conexión

if (!empty($_POST["btnregistrar"])) { // Si el usuario hizo clic en el botón
    if (!empty($_POST["nombre"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
        
        $nombre = $_POST["nombre"];
        $email = $_POST["email"];
        // Encriptamos la contraseña por seguridad
        $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, password) VALUES ('$nombre', '$email', '$password')";
        
        if (mysqli_query($conexion, $sql)) {
            echo "Usuario registrado correctamente";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    } else {
        echo "Por favor, rellena todos los campos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="assets/fonts.css">
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

    <?php
        include "config/conexion.php";
        include "controller/control_registro.php";
    ?>

    <div class="box_registro">
        <form action="" method="POST">
    <h1 class="titulo_registro" >Registrar Estudiante</h1>
    
    <div class="input-group">
        <div>
            <label class="text_form" for="n1">Primer Nombre</label>
            <input class="form_escribir type="text" name="n1" id="n1" placeholder="Ej: Juan" required>
        </div>
        <div>
            <label class="text_form" for="n2">Segundo Nombre</label>
            <input class="form_escribir type="text" name="n2" id="n2" placeholder="Ej: David" required>
        </div>
    </div>

    <div class="input-group">
        <div>
            <label class="text_form" for="a1">Primer Apellido</label>
            <input class="form_escribir" type="text" name="a1" id="a1" placeholder="Ej: Silva" required>
        </div>
        <div>
            <label class="text_form" for="a2">Segundo Apellido</label>
            <input class="form_escribir" type="text" name="a2" id="a2" placeholder="Ej: Peréz" required>
        </div>
    </div>

    <label class="text_form" for="email">Correo Electrónico</label>
    <input class="form_escribir" type="email" name="email" id="email" placeholder="ejemplo@gmail.com" required>

    <label class="text_form" for="password">Contraseña</label>
    <input class="form_escribir" type="password" name="password" id="password" required>

    <label class="text_form" for="password_confirm">Confirmar Contraseña</label>
    <input class="form_escribir" type="password" name="password_confirm" id="password_confirm" required>

    <input class="boton boton_registrar" type="submit" value="Registrar" name="btnregistrar">
</form>
    </div>

</body>
</html>