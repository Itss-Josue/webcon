<?php
class Database {
    private $host = "localhost";
    private $port = "8889"; // Puerto de MySQL en MAMP
    private $db_name = "webcon";
    private $username = "root";
    private $password = "root"; // Contraseña por defecto de MAMP
    private $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8mb4",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            die("DB Connection error: " . $exception->getMessage());
        }
        return $this->conn;
    }
}
