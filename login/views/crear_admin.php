<?php
// ---------------------------------------------------------
// VISTA PARA CREAR ADMINISTRADORES
// Muestra formulario y valida nivel del creador
// ---------------------------------------------------------

session_start();

// Verificar que sea admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    die("Acceso no autorizado.");
}

$nivel_creador = $_SESSION['admin_level'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear administrador</title>
</head>
<body>

<h2>Crear administrador</h2>

<!-- Mensaje de éxito -->
<?php if (isset($_GET['creado']) && $_GET['creado'] === 'ok') : ?>
    <p style="color: green;">Administrador creado correctamente.</p>
<?php endif; ?>

<form method="POST" action="../controllers/AdminController.php">

    <!-- Nombre -->
    <label>Nombre</label><br>
    <input type="text" name="nombre" required><br><br>

    <!-- Apellido -->
    <label>Apellido</label><br>
    <input type="text" name="apellido" required><br><br>

    <!-- Teléfono -->
    <label>Teléfono</label><br>
    <input type="text" name="phone"><br><br>

    <!-- Email -->
    <label>Email</label><br>
    <input type="email" name="email" required><br><br>

    <!-- Contraseña -->
    <label>Contraseña</label><br>
    <input type="password" name="password" required><br><br>

    <!-- Nivel de admin -->
    <label>Nivel de administrador</label><br>
    <select name="admin_level" required>
        <?php if ($nivel_creador == 1): ?>
            <option value="2">Nivel 2</option>
            <option value="3">Nivel 3</option>
        <?php elseif ($nivel_creador == 2): ?>
            <option value="3">Nivel 3</option>
        <?php endif; ?>
    </select><br><br>

    <button type="submit">Crear administrador</button>
    <button type="button" onclick="window.history.back()">Volver</button>

</form>

</body>
</html>