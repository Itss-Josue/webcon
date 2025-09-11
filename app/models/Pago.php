<?php
class Pago {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los pagos
    public function getAll() {
        $stmt = $this->pdo->query("
            SELECT p.id, c.name AS client_name, pr.name AS project_name, p.amount, p.method, p.paid_at
            FROM payments p
            INNER JOIN clients c ON c.id = p.client_id
            INNER JOIN projects pr ON pr.id = p.project_id
            ORDER BY p.paid_at DESC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Crear pago
    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO payments (client_id, project_id, amount, method, note, paid_at) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['client_id'],
            $data['project_id'],
            $data['amount'],
            $data['method'],
            $data['note'] ?? '',
            $data['paid_at'] ?? date('Y-m-d')
        ]);
    }

    // Encontrar pago
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM payments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar pago
    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE payments SET client_id=?, project_id=?, amount=?, method=?, note=?, paid_at=? WHERE id=?
        ");
        return $stmt->execute([
            $data['client_id'],
            $data['project_id'],
            $data['amount'],
            $data['method'],
            $data['note'] ?? '',
            $data['paid_at'] ?? date('Y-m-d'),
            $id
        ]);
    }

    // Eliminar pago
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM payments WHERE id=?");
        return $stmt->execute([$id]);
    }
}
