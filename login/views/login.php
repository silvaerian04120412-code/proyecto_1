<?php
// ---------------------------------------------------------
// LOGIN.PHP
// Vista del login. Procesa el formulario y muestra mensajes.
// ---------------------------------------------------------

// Si el formulario fue enviado, procesamos el login
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    require_once "../controllers/AuthController.php";

    $auth = new AuthController();

    // Enviamos los datos al controlador
    $msg = $auth->login($_POST['input'], $_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar sesión</title>
</head>
<body>

    <h2>Iniciar sesión</h2>

    <!-- Mensaje si el usuario se registró correctamente -->
    <?php if (isset($_GET['registro']) && $_GET['registro'] === 'ok') : ?>
        <p style="color: green;">Usuario registrado correctamente. Ahora puedes iniciar sesión.</p>
    <?php endif; ?>

    <!-- Formulario de login -->
    <form method="POST">

        <label for="input">Celular o correo electrónico</label><br>
        <input type="text" id="input" name="input" required><br><br>

        <label for="password">Contraseña</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Acceder</button>
    </form>

    <!-- Mensaje de error si el login falla -->
    <?php if (!empty($msg)) : ?>
        <p style="color: red;"><?php echo $msg; ?></p>
    <?php endif; ?>

    <br>

    <!-- Enlaces -->
    <a href="#">¿Olvidaste tu contraseña?</a><br>

    <!-- Enlace correcto para ir al registro -->
    <a href="register.php">Registrarse</a><br>

    <a href="#">Omitir</a>

</body>
</html>

<br>
<a href="#">¿Olvidaste tu contraseña?</a><br>
<a href="register.php">Registrarse</a><br>
<a href="#">Omitir</a>