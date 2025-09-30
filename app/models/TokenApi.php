<?php
require_once __DIR__ . '/../core/Database.php';

class ApiToken {

    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }

    // 📋 Obtener todos los tokens
    public function getAll() {
        $stmt = $this->db->prepare("
            SELECT t.id, t.token, t.client_id, c.razon_social AS cliente, t.fecha_creacion, t.estado
            FROM tokens_api t
            LEFT JOIN client_api c ON t.client_id = c.id
            ORDER BY t.id DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 Obtener un token por ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tokens_api WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ➕ Crear un nuevo token
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO tokens_api (token, client_id, fecha_creacion, estado) 
            VALUES (?, ?, NOW(), ?)
        ");
        return $stmt->execute([
            $data['token'],
            $data['client_id'],
            $data['estado'] ?? 1
        ]);
    }

    // ✏ Actualizar token
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE tokens_api SET token = ?, client_id = ?, estado = ? WHERE id = ?
        ");
        return $stmt->execute([
            $data['token'],
            $data['client_id'],
            $data['estado'],
            $id
        ]);
    }

    // 🗑 Eliminar token
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tokens_api WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
