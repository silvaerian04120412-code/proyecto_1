<?php
/* ---------------------------------------------------------
   MIDDLEWARE PARA PROTEGER RUTAS DE ADMINISTRADORES
   osea ver si la persona que este en esa parte del sistema ademas de tenr una sesión activa
   sea un admin junto con su respectivo nivel de acceso
 ---------------------------------------------------------*/

session_start();

// Verificar que sea admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    die("Acceso denegado.");
}

// Verificar que tenga nivel asignado
if (!isset($_SESSION['admin_level'])) {
    die("No tienes nivel de administrador asignado.");
}