<?php
class Database {
    private $host = "127.0.0.1";
    private $port;
    private $db_name = "webcon";
    private $username;
    private $password;
    private $conn;

    public function __construct() {
        // Detectar si es MAMP (por puerto 8889) o XAMPP (3306)
        if (str_contains(__DIR__, "MAMP")) {
            $this->port = 8889;
            $this->username = "root";
            $this->password = "root";
        } else {
            $this->port = 3306;
            $this->username = "root";
            $this->password = "";
        }
    }

    public function getConnection() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset=utf8mb4",
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("❌ Error de conexión: " . $e->getMessage() . 
                    "<br>Host={$this->host}, Puerto={$this->port}, Usuario={$this->username}");
            }
        }
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}
