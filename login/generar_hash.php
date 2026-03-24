<?php
// Archivo temporal para generar hashes seguros con password_hash()
/* Ubicación recomendada: proyecto_1/login/generar_hash.php. una vez no se nececite borrar. para usarlo ir con url al navegador para generar la contraseña(hash)
que usa el propio sistema al subirlo a la base de datos*/ 

if (!empty($_GET['pass'])) {
    $password = $_GET['pass'];
    $hash = password_hash($password, PASSWORD_BCRYPT);

    echo "<h3>Contraseña ingresada:</h3>";
    echo "<pre>$password</pre>";

    echo "<h3>Hash generado:</h3>";
    echo "<pre>$hash</pre>";

    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Generar Hash</title>
</head>
<body>
    <h2>Generador de Hash BCRYPT</h2>

    <form method="GET">
        <label>Escribe la contraseña que quieres convertir en hash:</label><br>
        <input type="text" name="pass" required>
        <button type="submit">Generar</button>
    </form>
</body>
</html>