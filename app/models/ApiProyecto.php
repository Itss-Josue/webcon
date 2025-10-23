<?php
class ApiProyecto {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todos los proyectos para API
    public function getAllForApi() {
        try {
            $stmt = $this->pdo->query("
                SELECT p.*, c.name as client_name, c.company, c.email, c.phone 
                FROM projects p 
                JOIN clients c ON p.client_id = c.id 
                ORDER BY p.created_at DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in ApiProyecto::getAllForApi(): " . $e->getMessage());
            return [];
        }
    }

    // Obtener proyecto específico para API
    public function getByIdForApi($id) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT p.*, c.name as client_name, c.company, c.email, c.phone 
                FROM projects p 
                JOIN clients c ON p.client_id = c.id 
                WHERE p.id = ?
            ");
            $stmt->execute([$id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in ApiProyecto::getByIdForApi(): " . $e->getMessage());
            return null;
        }
    }

    // Obtener cliente y proyectos para API
    public function getClienteConProyectosForApi($idCliente) {
        try {
            // Primero obtener info del cliente
            $stmt = $this->pdo->prepare("
                SELECT * FROM clients WHERE id = ?
            ");
            $stmt->execute([$idCliente]);
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$cliente) {
                return null;
            }
            
            // Luego obtener sus proyectos
            $stmt = $this->pdo->prepare("
                SELECT * FROM projects WHERE client_id = ? ORDER BY created_at DESC
            ");
            $stmt->execute([$idCliente]);
            $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            return [
                'cliente' => $cliente,
                'proyectos' => $proyectos
            ];
        } catch (Exception $e) {
            error_log("Error in ApiProyecto::getClienteConProyectosForApi(): " . $e->getMessage());
            return null;
        }
    }
}
?>