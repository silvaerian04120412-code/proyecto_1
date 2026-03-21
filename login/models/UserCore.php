<?php
// ---------------------------------------------------------
// MODELO: users_core
// Maneja datos mínimos del usuario (login)
// ---------------------------------------------------------
class UserCore {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Buscar usuario por email o teléfono
    public function findByEmailOrPhone($input) {
        $sql = "SELECT * FROM users_core WHERE email = :input OR phone = :input";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':input' => $input]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}