<!-- 
    Archivo: dashboard_admin_n3.php
    Ubicación: proyecto_1/login/views/admin/dashboard_admin_n3.php

    Este archivo representa el panel del ADMINISTRADOR NIVEL 3.
    Es el nivel más bajo de administrador, con acceso limitado.

    Más adelante se crearán:
    - dashboard_admin_n2.php (nivel intermedio)
    - dashboard_admin_n1.php (nivel máximo)

    No tiene CSS porque el diseño aún no está definido.
-->

<?php
// Middleware que protege esta página.
// Si no hay sesión activa, redirige al login.
require_once "../../middleware/admin_level.php";

// Verificamos que sea admin
if ($_SESSION['user_type'] !== 'admin') {
    header("Location: ../dashboard.php");
    exit;
}

// Verificamos que sea nivel 3 o superior (1 y 2 también pueden entrar)
if ($_SESSION['admin_level'] > 3) {
    die("Acceso denegado: No tienes permisos para este panel.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador Nivel 3</title>
</head>
<body>

    <!-- Título principal del panel -->
    <h1>Panel de Administrador Nivel 3</h1>

    <!-- Información básica del usuario -->
    <p><strong>ID de usuario:</strong> <?php echo $_SESSION['user_id']; ?></p>
    <p><strong>Tipo de usuario:</strong> Administrador</p>
    <p><strong>Nivel de administrador:</strong> <?php echo $_SESSION['admin_level']; ?></p>

    <hr>

    <!-- MENÚ DEL ADMIN NIVEL 3 -->
    <h3>Opciones disponibles (Nivel 3)</h3>

    <ul>
        <li><a href="#">Ver usuarios</a></li>
        <li><a href="#">Ver inventario</a></li>
        <li><a href="#">Ver reportes básicos</a></li>
        <li><a href="#">Ver historial de actividad</a></li>
        <li><a href="#">Soporte técnico</a></li>
    </ul>

    <hr>

    <!-- Botón para cerrar sesión -->
    <a href="../../logout.php">Cerrar sesión</a>

</body>
</html>