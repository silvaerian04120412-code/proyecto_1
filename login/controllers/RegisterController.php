<?php
// ---------------------------------------------------------
// CONTROLADOR DE REGISTRO DE USUARIOS NORMALES
// Inserta en users_core + users_profile
// ---------------------------------------------------------

require_once "../config/database.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $db   = new Database();
    $conn = $db->connect();

    // Captura de datos
    $nombre   = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $email    = trim($_POST['email'] ?? '');
    $phone    = trim($_POST['phone'] ?? '');
    $password = trim($_POST['password'] ?? '');

    // Validación mínima
    if ($nombre === '' || $apellido === '' || $email === '' || $password === '') {
        die("Faltan datos obligatorios.");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    try {
        $conn->beginTransaction();

        // Insert en users_core
        $stmt = $conn->prepare("
            INSERT INTO users_core (email, phone, password, user_type)
            VALUES (:email, :phone, :password, 'user')
        ");

        $stmt->execute([
            ':email'    => $email,
            ':phone'    => $phone,
            ':password' => $password_hash
        ]);

        $id = $conn->lastInsertId();

        // Insert en users_profile
        $stmt2 = $conn->prepare("
            INSERT INTO users_profile (id, nombre, apellido)
            VALUES (:id, :nombre, :apellido)
        ");

        $stmt2->execute([
            ':id'       => $id,
            ':nombre'   => $nombre,
            ':apellido' => $apellido
        ]);

        $conn->commit();

        // Redirigir al login con mensaje de éxito
        header("Location: ../views/login.php?registro=ok");
        exit();

    } catch (Exception $e) {
        $conn->rollBack();
        echo "Error al registrar usuario: " . $e->getMessage();
    }
}