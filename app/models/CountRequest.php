<?php
class CountRequest {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Obtener todas las requests con información del token y cliente
    public function getAll() {
        try {
            $stmt = $this->pdo->query("
                SELECT cr.*, ta.token, ca.razon_social, ca.ruc
                FROM count_request cr 
                LEFT JOIN tokens_api ta ON cr.id_token = ta.id 
                LEFT JOIN client_api ca ON ta.id_client_api = ca.id 
                ORDER BY cr.fecha DESC, cr.id DESC
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in CountRequest::getAll(): " . $e->getMessage());
            return [];
        }
    }

    // Crear nuevo registro de request
    public function create($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO count_request (id_token, tipo, fecha) 
            VALUES (?, ?, ?)
        ");
        return $stmt->execute([
            $data['id_token'],
            $data['tipo'],
            $data['fecha'] ?? date('Y-m-d')
        ]);
    }

    // Encontrar request por ID
    public function find($id) {
        $stmt = $this->pdo->prepare("
            SELECT cr.*, ta.token, ca.razon_social, ca.ruc
            FROM count_request cr 
            LEFT JOIN tokens_api ta ON cr.id_token = ta.id 
            LEFT JOIN client_api ca ON ta.id_client_api = ca.id 
            WHERE cr.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Actualizar request
    public function update($id, $data) {
        $stmt = $this->pdo->prepare("
            UPDATE count_request SET 
            id_token=?, tipo=?, fecha=?
            WHERE id=?
        ");
        return $stmt->execute([
            $data['id_token'],
            $data['tipo'],
            $data['fecha'] ?? date('Y-m-d'),
            $id
        ]);
    }

    // Eliminar request
    public function delete($id) {
        $stmt = $this->pdo->prepare("DELETE FROM count_request WHERE id=?");
        return $stmt->execute([$id]);
    }

    // Obtener estadísticas de requests
    public function getStats() {
        try {
            $stmt = $this->pdo->query("
                SELECT fecha, COUNT(*) as total_requests 
                FROM count_request 
                WHERE fecha >= DATE_SUB(CURDATE(), INTERVAL 7 DAY) 
                GROUP BY fecha 
                ORDER BY fecha DESC
                LIMIT 7
            ");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in CountRequest::getStats(): " . $e->getMessage());
            return [];
        }
    }

    // Obtener tipos de requests disponibles
    public function getTipos() {
        return [
            'consulta' => 'Consulta',
            'autenticacion' => 'Autenticación',
            'reporte' => 'Reporte',
            'validacion' => 'Validación',
            'api_consulta' => 'API Consulta',
            'auth_login' => 'Auth Login',
            'data_export' => 'Exportación de Datos',
            'report_generate' => 'Generación de Reporte',
            'user_validation' => 'Validación de Usuario'
        ];
    }
}
?>