<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuario</title>
    <!-- Carga de validaciones en el cliente -->
    <script src="../js/validaciones.js" defer></script>
</head>
<body>

<h2>Registro de usuario</h2>

<form method="POST" action="../controllers/RegisterController.php">

    <!-- Nombre -->
    <label>Nombre</label><br>
    <input type="text" name="nombre" id="nombre" required><br>
    <div class="error" id="errNombre"></div><br>

    <!-- Apellido -->
    <label>Apellido</label><br>
    <input type="text" name="apellido" id="apellido" required><br>
    <div class="error" id="errApellido"></div><br>

    <!-- Teléfono -->
    <label>Teléfono</label><br>
    <input type="text" name="phone" id="phone"><br>
    <div class="error" id="errPhone"></div><br>

    <!-- Email -->
    <label>Correo electrónico</label><br>
    <input type="text" name="email" id="email" required><br>
    <div class="error" id="errEmail"></div><br>

    <!-- Contraseña -->
    <label>Contraseña</label><br>
    <input type="password" name="password" id="password" required><br>
    <div class="error" id="errPassword"></div><br>

    <!-- Botones -->
    <button type="submit">Registrarse</button>
    <button type="button" onclick="window.history.back()">Volver</button>

</form>

</body>
</html>