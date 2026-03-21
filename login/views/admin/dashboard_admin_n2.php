<!-- 
    Archivo: dashboard_admin_n2.php
    Ubicación: proyecto_1/login/views/admin/dashboard_admin_n2.php

    Este archivo representa el panel del ADMINISTRADOR NIVEL 2.
    Tiene acceso a funciones intermedias del sistema.

    Este panel incluye:
    - Todo lo que puede hacer el nivel 3
    - Funciones adicionales como editar usuarios, inventario y aprobar solicitudes

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

// Verificamos que sea nivel 2 o superior (nivel 1 también puede entrar)
if ($_SESSION['admin_level'] > 2) {
    die("Acceso denegado: No tienes permisos para este panel.");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Administrador Nivel 2</title>
</head>
<body>

    <!-- Título principal del panel -->
    <h1>Panel de Administrador Nivel 2</h1>

    <!-- Información básica del usuario -->
    <p><strong>ID de usuario:</strong> <?php echo $_SESSION['user_id']; ?></p>
    <p><strong>Tipo de usuario:</strong> Administrador</p>
    <p><strong>Nivel de administrador:</strong> <?php echo $_SESSION['admin_level']; ?></p>

    <hr>

    <!-- MENÚ DEL ADMIN NIVEL 2 -->
    <h3>Opciones disponibles (Nivel 2)</h3>

    <ul>
        <!-- Funciones heredadas del nivel 3 -->
        <li><a href="#">Ver usuarios</a></li>
        <li><a href="#">Ver inventario</a></li>
        <li><a href="#">Ver reportes básicos</a></li>
        <li><a href="#">Ver historial de actividad</a></li>
        <li><a href="#">Soporte técnico</a></li>

        <hr>

        <!-- Funciones exclusivas del nivel 2 -->
        <li><a href="#">Editar usuarios</a></li>
        <li><a href="#">Editar inventario</a></li>
        <li><a href="#">Aprobar solicitudes</a></li>
        <li><a href="#">Gestionar reportes intermedios</a></li>
        <li><a href="#">Control de operaciones</a></li>
    </ul>

    <hr>

    <!-- Botón para cerrar sesión -->
    <a href="../../logout.php">Cerrar sesión</a>

</body>
</html>