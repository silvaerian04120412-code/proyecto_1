<!-- 
    Archivo: dashboard_usuario.php
    Ubicación: proyecto_1/login/views/usuario/dashboard_usuario.php

    Este archivo representa el panel principal del USUARIO NORMAL.
    Aquí NO se muestran funciones administrativas.
    Más adelante se agregarán módulos reales (perfil, historial, etc.).

    No tiene CSS porque el diseño aún no está definido.
-->

<?php
// Middleware que protege esta página.
// Si no hay sesión activa, redirige al login.
require_once "../../middleware/auth.php";

// Si el usuario es admin, no debería estar aquí.
// Esto evita que un admin entre accidentalmente al panel de usuario.
if ($_SESSION['user_type'] !== 'user') {
    header("Location: ../dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Usuario</title>
</head>
<body>

    <!-- Título principal del panel -->
    <h1>Panel del Usuario</h1>

    <!-- Información básica del usuario -->
    <p><strong>ID de usuario:</strong> <?php echo $_SESSION['user_id']; ?></p>
    <p><strong>Tipo de usuario:</strong> Usuario normal</p>

    <hr>

    <!-- MENÚ DEL USUARIO NORMAL -->
    <h3>Opciones disponibles</h3>

    <ul>
        <li><a href="#">Mi perfil</a></li>
        <li><a href="#">Cambiar contraseña</a></li>
        <li><a href="#">Mis notificaciones</a></li>
        <li><a href="#">Historial de actividad</a></li>
        <li><a href="#">Soporte</a></li>
    </ul>

    <hr>

    <!-- Botón para cerrar sesión -->
    <a href="../../logout.php">Cerrar sesión</a>

</body>
</html>