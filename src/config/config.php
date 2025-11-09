<?php
// src/config/config.php
class Database {
    private $host = "127.0.0.1";
    private $port = "8889"; // 👈 puerto MySQL en MAMP
    private $db_name = "webcon";
    private $username = "root";
    private $password = "root"; // 👈 por defecto MAMP usa 'root' en ambos
    private $conn = null;

    public function getConnection() {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8mb4";
                $opts = [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ];
                $this->conn = new PDO($dsn, $this->username, $this->password, $opts);
            } catch (PDOException $e) {
                die("<h3 style='color:red'>DB Connection error:</h3> " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
