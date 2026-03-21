<?php
// ---------------------------------------------------------
// MIDDLEWARE PARA PROTEGER RUTAS DE ADMINISTRADORES
// ---------------------------------------------------------

session_start();

// Verificar que sea admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    die("Acceso denegado.");
}

// Verificar que tenga nivel asignado
if (!isset($_SESSION['admin_level'])) {
    die("No tienes nivel de administrador asignado.");
}