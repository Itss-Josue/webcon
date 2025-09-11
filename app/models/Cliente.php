<?php
class Cliente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los clientes
    public function getAll() {
        $stmt = $this->pdo->query("SELECT * FROM clients ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Buscar cliente por ID
    public function find($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear cliente
    public function create($data) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM clients WHERE dni = ?");
        $stmt->execute([$data['dni']]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("❌ El DNI ya está registrado");
        }

        $stmt = $this->pdo->prepare("INSERT INTO clients (dni, name, company, phone, email) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt->execute([
            $data['dni'],
            $data['name'],
            $data['company'],
            $data['phone'],
            $data['email']
        ])) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("❌ Error al crear cliente: " . $errorInfo[2]);
        }

        return true;
    }

    // Actualizar cliente
    public function update($id, $data) {
        // Verificar si el DNI existe en otro registro
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM clients WHERE dni = ? AND id != ?");
        $stmt->execute([$data['dni'], $id]);
        if ($stmt->fetchColumn() > 0) {
            throw new Exception("❌ El DNI ya está registrado en otro cliente");
        }

        $stmt = $this->pdo->prepare("UPDATE clients SET dni=?, name=?, company=?, phone=?, email=? WHERE id=?");
        if (!$stmt->execute([
            $data['dni'],
            $data['name'],
            $data['company'],
            $data['phone'],
            $data['email'],
            $id
        ])) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("❌ Error al actualizar cliente: " . $errorInfo[2]);
        }

        return true;
    }

    // Eliminar cliente
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM clients WHERE id = ?");
        if (!$stmt->execute([$id])) {
            $errorInfo = $stmt->errorInfo();
            throw new Exception("❌ Error al eliminar cliente: " . $errorInfo[2]);
        }
        return true;
    }
}

