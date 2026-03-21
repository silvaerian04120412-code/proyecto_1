<?php
// ---------------------------------------------------------
// CONTROLADOR PARA CREAR ADMINISTRADORES
// Aplica jerarquía y auditoría (creado_por)
// ---------------------------------------------------------

session_start();
require_once "../config/database.php";
require_once "../models/UserCore.php";
require_once "../models/UserProfile.php";
require_once "../models/UserAdmin.php";

// Verificar que sea admin
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'admin') {
    die("Acceso no autorizado.");
}

$nivel_creador = $_SESSION['admin_level'];

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $db   = new Database();
    $conn = $db->connect();

    $core    = new UserCore($conn);
    $profile = new UserProfile($conn);
    $admin   = new UserAdmin($conn);

    // Captura de datos
    $nombre      = trim($_POST['nombre']);
    $apellido    = trim($_POST['apellido']);
    $email       = trim($_POST['email']);
    $phone       = trim($_POST['phone']);
    $password    = trim($_POST['password']);
    $nivel_nuevo = (int)$_POST['admin_level'];

    // Validación de jerarquía
    if ($nivel_creador >= $nivel_nuevo) {
        die("No puedes crear un admin de tu mismo nivel o superior.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $conn->beginTransaction();

        // Insert en users_core
        $stmt = $conn->prepare("
            INSERT INTO users_core (email, phone, password, user_type)
            VALUES (:email, :phone, :password, 'admin')
        ");

        $stmt->execute([
            ':email'    => $email,
            ':phone'    => $phone,
            ':password' => $password_hash
        ]);

        $id = $conn->lastInsertId();

        // Insert en users_profile
        $profile->insert($id, $nombre, $apellido);

        // Insert en users_admin
        $admin->insert($id, $nivel_nuevo, $_SESSION['user_id']);

        $conn->commit();

        header("Location: ../views/crear_admin.php?creado=ok");
        exit();

    } catch (Exception $e) {
        $conn->rollBack();
        echo "Error al crear administrador: " . $e->getMessage();
    }
}