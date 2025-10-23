<?php
class ApiSearchController {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
        // Headers para API
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type');
    }

    public function searchClients() {
        try {
            // Obtener datos del POST o JSON
            $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $query = $input['query'] ?? '';
            $type = $input['type'] ?? 'auto';

            if (empty($query)) {
                return ['success' => true, 'data' => []];
            }

            // Construir consulta SQL
            $sql = "SELECT id, dni, name, company, phone, email, 
                           DATE_FORMAT(created_at, '%d/%m/%Y') as created_at 
                    FROM clients WHERE 1=1";
            
            $params = [];

            switch ($type) {
                case 'dni':
                    $sql .= " AND dni LIKE ?";
                    $params[] = "%$query%";
                    break;
                case 'nombre':
                    $sql .= " AND name LIKE ?";
                    $params[] = "%$query%";
                    break;
                case 'empresa':
                    $sql .= " AND company LIKE ?";
                    $params[] = "%$query%";
                    break;
                case 'id':
                    if (is_numeric($query)) {
                        $sql .= " AND id = ?";
                        $params[] = (int)$query;
                    }
                    break;
                default:
                    $sql .= " AND (dni LIKE ? OR name LIKE ? OR company LIKE ?";
                    $params[] = "%$query%";
                    $params[] = "%$query%";
                    $params[] = "%$query%";
                    
                    if (is_numeric($query)) {
                        $sql .= " OR id = ?";
                        $params[] = (int)$query;
                    }
                    $sql .= ")";
                    break;
            }

            $sql .= " ORDER BY name ASC LIMIT 50";

            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($params);
            $results = $stmt->fetchAll();

            return [
                'success' => true,
                'data' => $results,
                'count' => count($results)
            ];

        } catch (Exception $e) {
            error_log("Error en ApiSearchController: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error en el servidor', 'data' => []];
        }
    }

    public function getClientDetails() {
        try {
            $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $client_id = $input['client_id'] ?? '';

            if (empty($client_id) || !is_numeric($client_id)) {
                return ['success' => false, 'message' => 'ID de cliente inválido'];
            }

            // Obtener información del cliente
            $sql_client = "SELECT *, DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at 
                           FROM clients WHERE id = ?";
            $stmt_client = $this->pdo->prepare($sql_client);
            $stmt_client->execute([$client_id]);
            $client = $stmt_client->fetch();

            if (!$client) {
                return ['success' => false, 'message' => 'Cliente no encontrado'];
            }

            // Obtener estadísticas
            $sql_stats = "SELECT 
                COUNT(*) as total_projects,
                SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active_projects,
                SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_projects
            FROM projects WHERE client_id = ?";
            
            $stmt_stats = $this->pdo->prepare($sql_stats);
            $stmt_stats->execute([$client_id]);
            $stats = $stmt_stats->fetch();

            // Obtener pagos
            $sql_payments = "SELECT p.*, pr.name as project_name, 
                                    DATE_FORMAT(p.paid_at, '%d/%m/%Y') as paid_date
                             FROM payments p 
                             JOIN projects pr ON p.project_id = pr.id 
                             WHERE p.client_id = ? 
                             ORDER BY p.paid_at DESC";
            
            $stmt_payments = $this->pdo->prepare($sql_payments);
            $stmt_payments->execute([$client_id]);
            $payments = $stmt_payments->fetchAll();

            // Calcular total pagado
            $total_paid = 0;
            foreach ($payments as $payment) {
                $total_paid += floatval($payment['amount']);
            }

            $stats['total_paid'] = number_format($total_paid, 2);

            return [
                'success' => true,
                'client' => $client,
                'stats' => $stats,
                'payments' => $payments
            ];

        } catch (Exception $e) {
            error_log("Error en getClientDetails: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error de base de datos'];
        }
    }

    public function getClientProjects() {
        try {
            $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
            $client_id = $input['client_id'] ?? '';

            if (empty($client_id) || !is_numeric($client_id)) {
                return ['success' => false, 'message' => 'ID de cliente inválido'];
            }

            // Obtener proyectos
            $sql = "SELECT *, 
                           DATE_FORMAT(delivery_date, '%d/%m/%Y') as delivery_date_formatted,
                           DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at
                    FROM projects 
                    WHERE client_id = ? 
                    ORDER BY 
                        CASE status 
                            WHEN 'active' THEN 1
                            WHEN 'pending' THEN 2
                            WHEN 'completed' THEN 3
                            ELSE 4
                        END,
                        delivery_date";
            
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$client_id]);
            $projects = $stmt->fetchAll();

            return [
                'success' => true,
                'data' => $projects
            ];

        } catch (Exception $e) {
            error_log("Error en getClientProjects: " . $e->getMessage());
            return ['success' => false, 'message' => 'Error de base de datos'];
        }
    }
}
?>