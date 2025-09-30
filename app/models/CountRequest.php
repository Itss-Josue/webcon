<?php
class CountRequest {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // ✅ Obtener todas las requests con su token
    public function getAll() {
        $stmt = $this->db->query("
            SELECT r.*, t.token 
            FROM count_request r
            INNER JOIN tokens_api t ON r.id_token = t.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ✅ Obtener request por ID
    public function getById($id) {
        $stmt = $this->db->prepare("
            SELECT r.*, t.token 
            FROM count_request r
            INNER JOIN tokens_api t ON r.id_token = t.id
            WHERE r.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ✅ Crear request
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO count_request (id_token, tipo, fecha) 
            VALUES (?, ?, NOW())
        ");
        return $stmt->execute([
            $data['id_token'],
            $data['tipo']
        ]);
    }

    // ✅ Actualizar request
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE count_request 
            SET id_token=?, tipo=?, fecha=? 
            WHERE id=?
        ");
        return $stmt->execute([
            $data['id_token'],
            $data['tipo'],
            $data['fecha'],
            $id
        ]);
    }

    // ✅ Eliminar request
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM count_request WHERE id=?");
        return $stmt->execute([$id]);
    }
}
