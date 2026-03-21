<?php
// Cierra la sesión del usuario.
// Afecta a todo el sistema porque destruye la sesión.

session_start();
session_unset();
session_destroy();
header("Location: views/login.php");
exit;