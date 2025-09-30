<?php
class ApiCliente {
    public $db; // 🔹 pública para acceso controlado en vistas si fuera necesario

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM client_api ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM client_api WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO client_api (ruc, razon_social, telefono, correo, fecha_registro, estado) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['ruc'],
            $data['razon_social'],
            $data['telefono'] ?? null,
            $data['correo'] ?? null,
            $data['fecha_registro'] ?? date('Y-m-d'),
            $data['estado'] ?? 1
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE client_api 
            SET ruc=?, razon_social=?, telefono=?, correo=?, fecha_registro=?, estado=? 
            WHERE id=?
        ");
        return $stmt->execute([
            $data['ruc'],
            $data['razon_social'],
            $data['telefono'] ?? null,
            $data['correo'] ?? null,
            $data['fecha_registro'] ?? date('Y-m-d'),
            $data['estado'] ?? 1,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM client_api WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
