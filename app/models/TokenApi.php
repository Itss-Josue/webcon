<?php
class TokenApi {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los tokens con información del cliente
    public function getAll() {
        try {
            $stmt = $this->pdo->query("
                SELECT ta.*, ca.razon_social, ca.ruc
                FROM tokens_api ta 
                LEFT JOIN client_api ca ON ta.id_client_api = ca.id 
                ORDER BY ta.fecha_registro DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in TokenApi::getAll(): " . $e->getMessage());
            return [];
        }
    }

    // Crear nuevo token
    public function create($data) {
        // Generar token único
        $token = bin2hex(random_bytes(32));
        
        $stmt = $this->pdo->prepare("
            INSERT INTO tokens_api (id_client_api, token, fecha_registro, estado) 
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['id_client_api'],
            $token,
            $data['fecha_registro'] ?? date('Y-m-d'),
            $data['estado'] ?? 1
        ]) ? $token : false;
    }

    // Encontrar token por ID
    public function find($id) {
        $stmt = $this->pdo->prepare("
            SELECT ta.*, ca.razon_social, ca.ruc
            FROM tokens_api ta 
            LEFT JOIN client_api ca ON ta.id_client_api = ca.id 
            WHERE ta.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar token
    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE tokens_api SET 
            id_client_api=?, estado=?, fecha_registro=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['id_client_api'],
            $data['estado'] ?? 1,
            $data['fecha_registro'] ?? date('Y-m-d'),
            $id
        ]);
    }

    // Regenerar token
    public function regenerate($id) {
        $newToken = bin2hex(random_bytes(32));
        $stmt = $this->pdo->prepare("
            UPDATE tokens_api SET token=?, fecha_registro=? WHERE id=?
        ");
        return $stmt->execute([$newToken, date('Y-m-d'), $id]) ? $newToken : false;
    }

    // Eliminar token
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM tokens_api WHERE id=?");
        return $stmt->execute([$id]);
    }

    // Obtener estadísticas
    public function getStats() {
        return [];
    }
}
?>