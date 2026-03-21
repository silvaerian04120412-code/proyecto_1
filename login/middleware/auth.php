<?php
// ---------------------------------------------------------
// MIDDLEWARE GENERAL DE AUTENTICACIÓN
// Verifica que exista una sesión activa del usuario
// ---------------------------------------------------------

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../views/login.php");
    exit;
}