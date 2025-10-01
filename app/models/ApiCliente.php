<?php
class ApiCliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getAll() {
        try {
            $stmt = $this->pdo->query("
                SELECT * FROM client_api 
                ORDER BY fecha_registro DESC
            ");
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            error_log("Error in ApiCliente::getAll(): " . $e->getMessage());
            return [];
        }
    }

    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO client_api (ruc, razon_social, telefono, correo, fecha_registro, estado) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['ruc'],
            $data['razon_social'],
            $data['telefono'] ?? '',
            $data['correo'] ?? '',
            $data['fecha_registro'] ?? date('Y-m-d'),
            $data['estado'] ?? 1
        ]);
    }

    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM client_api WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE client_api SET 
            ruc=?, razon_social=?, telefono=?, correo=?, fecha_registro=?, estado=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['ruc'],
            $data['razon_social'],
            $data['telefono'] ?? '',
            $data['correo'] ?? '',
            $data['fecha_registro'] ?? date('Y-m-d'),
            $data['estado'] ?? 1,
            $id
        ]);
    }

    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM client_api WHERE id=?");
        return $stmt->execute([$id]);
    }
}
?>