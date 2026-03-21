<?php
// ---------------------------------------------------------
// CONTROLADOR DE LOGIN
// Autentica usuarios y redirige según tipo y nivel
// ---------------------------------------------------------
session_start();
require_once "../config/database.php";
require_once "../models/UserCore.php";

class AuthController {

    public function login($input, $password) {

        // 1. Conexión
        $db   = new Database();
        $conn = $db->connect();

        // 2. Modelo
        $userCore = new UserCore($conn);

        // 3. Buscar usuario por email o teléfono
        $user = $userCore->findByEmailOrPhone($input);

        if (!$user) {
            return "Usuario no encontrado";
        }

        // 4. Verificar contraseña
        if (!password_verify($password, $user['password'])) {
            return "Contraseña incorrecta";
        }

        // 5. Crear sesión
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_type'] = $user['user_type'];

        // 6. Si es admin, obtener nivel desde users_admin
        if ($user['user_type'] === 'admin') {
            $sql = "SELECT admin_level FROM users_admin WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->execute([':id' => $user['id']]);
            $admin = $stmt->fetch(PDO::FETCH_ASSOC);

            $_SESSION['admin_level'] = $admin['admin_level'] ?? null;
        }

        // Regenerar ID de sesión
        session_regenerate_id(true);

        // 7. Redirecciones
        if ($user['user_type'] === 'user') {
            header("Location: ../views/usuario/dashboard_usuario.php");
            exit;
        }

        if ($user['user_type'] === 'admin') {
            switch ($_SESSION['admin_level']) {
                case 1:
                    header("Location: ../views/admin/dashboard_admin_n1.php");
                    exit;
                case 2:
                    header("Location: ../views/admin/dashboard_admin_n2.php");
                    exit;
                case 3:
                    header("Location: ../views/admin/dashboard_admin_n3.php");
                    exit;
            }
        }

        return "Error inesperado.";
    }
}