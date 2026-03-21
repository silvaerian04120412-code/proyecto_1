<?php
// ---------------------------------------------------------
// MODELO: users_admin
// Guarda nivel de admin y auditoría (creado_por)
// ---------------------------------------------------------

class UserAdmin {

    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Inserta nivel de admin y quién lo creó
    public function insert($id, $nivel, $creado_por) {
        $sql = "INSERT INTO users_admin (id, admin_level, creado_por)
                VALUES (:id, :nivel, :creado_por)";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ':id'        => $id,
            ':nivel'     => $nivel,
            ':creado_por'=> $creado_por
        ]);
    }
}