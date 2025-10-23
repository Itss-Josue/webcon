<?php
class Database {
    private $host = "localhost";
    private $db_name = "webcon2.0"; 
    private $username = "root"; 
    private $password = "root"; 
    private $conn;

    public function getConnection() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO(
                    "mysql:host={$this->host};dbname={$this->db_name};charset=utf8mb4",
                    $this->username,
                    $this->password
                );
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                // Para API, retornar JSON en lugar de die()
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
                exit;
            }
        }
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn = null;
    }
}

// Crear instancia global para la API
$database = new Database();
$conn = $database->getConnection();
?>