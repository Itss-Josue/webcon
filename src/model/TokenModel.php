<?php
require_once __DIR__ . '/../config/config.php';

class TokenModel {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // ✅ Obtener todos los tokens con datos del cliente
    public function getAll() {
        $sql = "SELECT t.*, c.name AS client_name 
                FROM tokens_api t
                INNER JOIN clients c ON t.client_id = c.id
                ORDER BY t.id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Crear token automáticamente
    public function createToken($clientId) {
        $token = bin2hex(random_bytes(20)); // Token seguro aleatorio
        $sql = "INSERT INTO tokens_api (token, client_id, status) VALUES (:token, :client_id, 'Activo')";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':token' => $token,
            ':client_id' => $clientId
        ]);
        return ['id' => $this->conn->lastInsertId(), 'token' => $token];
    }

    // ✅ Buscar token por ID
    public function findById($id) {
        $sql = "SELECT * FROM tokens_api WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Buscar token por cadena
    public function findByToken($token) {
        $sql = "SELECT * FROM tokens_api WHERE token = :token AND status = 'Activo'";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Refrescar token (actualizar automáticamente)
    public function refreshToken($oldToken) {
        $newToken = bin2hex(random_bytes(20));
        $sql = "UPDATE tokens_api SET token = :newToken, created_at = NOW() WHERE token = :oldToken";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':newToken' => $newToken,
            ':oldToken' => $oldToken
        ]);
        return ['token' => $newToken];
    }

    // ✅ Eliminar token
    public function delete($id) {
        $sql = "DELETE FROM tokens_api WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }
}
