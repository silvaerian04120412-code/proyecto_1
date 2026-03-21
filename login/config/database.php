<?php
// ---------------------------------------------------------
// CONEXIÓN PDO A LA BASE DE DATOS
// ---------------------------------------------------------
class Database {

    private $host = "localhost";
    private $db   = "proyecto_1"; // Ajusta al nombre real de tu BD
    private $user = "root";       // Ajusta usuario
    private $pass = "";           // Ajusta contraseña

    public function connect() {
        try {
            $conn = new PDO(
                "mysql:host={$this->host};dbname={$this->db};charset=utf8",
                $this->user,
                $this->pass
            );

            // Modo de errores con excepciones
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }
}