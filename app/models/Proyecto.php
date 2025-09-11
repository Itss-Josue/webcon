<?php
class Proyecto {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Crear nuevo proyecto
    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO projects (client_id, name, type, progress, status, delivery_date, total_price)
            VALUES (:client_id, :name, :type, :progress, :status, :delivery_date, :total_price)
        ");
        return $stmt->execute([
            ':client_id'     => $data['client_id'],
            ':name'          => $data['name'],
            ':type'          => $data['type'] ?? '',
            ':progress'      => $data['progress'] ?? 0,
            ':status'        => $data['status'] ?? 'pending',
            ':delivery_date' => $data['delivery_date'] ?? null,
            ':total_price'   => $data['total_price'] ?? 0
        ]);
    }

    // Actualizar proyecto
    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE projects
            SET client_id = :client_id,
                name = :name,
                type = :type,
                progress = :progress,
                status = :status,
                delivery_date = :delivery_date,
                total_price = :total_price
            WHERE id = :id
        ");
        return $stmt->execute([
            ':client_id'     => $data['client_id'],
            ':name'          => $data['name'],
            ':type'          => $data['type'] ?? '',
            ':progress'      => $data['progress'] ?? 0,
            ':status'        => $data['status'] ?? 'pending',
            ':delivery_date' => $data['delivery_date'] ?? null,
            ':total_price'   => $data['total_price'] ?? 0,
            ':id'            => $id
        ]);
    }

    // Eliminar proyecto
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM projects WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    // Obtener todos los proyectos
    public function getAll() {
        $sql = "SELECT p.*, c.name AS client_name 
                FROM projects p
                LEFT JOIN clients c ON p.client_id = c.id
                ORDER BY p.id DESC";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener proyecto por ID
    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM projects WHERE id = :id");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Obtener todos los clientes (para select)
    public function getClientes() {
        $stmt = $this->db->query("SELECT id, name FROM clients ORDER BY name ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
