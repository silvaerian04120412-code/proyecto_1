<?php
// ---------------------------------------------------------
// MODELO: users_profile
// Guarda datos personales del usuario (no críticos)
// ---------------------------------------------------------

class UserProfile {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Inserta nombre y apellido del usuario
    public function insert($id, $nombre, $apellido) {
        $sql = "INSERT INTO users_profile (id, nombre, apellido)
                VALUES (:id, :nombre, :apellido)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id'       => $id,
            ':nombre'   => $nombre,
            ':apellido' => $apellido
        ]);
    }
}