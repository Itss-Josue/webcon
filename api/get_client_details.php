<?php
// api/get_client_details.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

require_once '../config/config.php';

try {
    $input = json_decode(file_get_contents('php://input'), true) ?? $_POST;
    $client_id = $input['client_id'] ?? '';

    if (empty($client_id) || !is_numeric($client_id)) {
        echo json_encode(['success' => false, 'message' => 'ID de cliente inválido']);
        exit;
    }

    // Obtener información del cliente
    $sql_client = "SELECT *, DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at 
                   FROM clients WHERE id = :client_id";
    $stmt_client = $conn->prepare($sql_client);
    $stmt_client->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt_client->execute();
    $client = $stmt_client->fetch();

    if (!$client) {
        echo json_encode(['success' => false, 'message' => 'Cliente no encontrado']);
        exit;
    }

    // Obtener estadísticas de proyectos
    $sql_stats = "SELECT 
        COUNT(*) as total_projects,
        SUM(CASE WHEN status = 'active' THEN 1 ELSE 0 END) as active_projects,
        SUM(CASE WHEN status = 'completed' THEN 1 ELSE 0 END) as completed_projects
    FROM projects WHERE client_id = :client_id";
    
    $stmt_stats = $conn->prepare($sql_stats);
    $stmt_stats->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt_stats->execute();
    $stats = $stmt_stats->fetch();

    // Obtener pagos
    $sql_payments = "SELECT p.*, pr.name as project_name, 
                            DATE_FORMAT(p.paid_at, '%d/%m/%Y') as paid_date
                     FROM payments p 
                     JOIN projects pr ON p.project_id = pr.id 
                     WHERE p.client_id = :client_id 
                     ORDER BY p.paid_at DESC";
    
    $stmt_payments = $conn->prepare($sql_payments);
    $stmt_payments->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt_payments->execute();
    $payments = $stmt_payments->fetchAll();

    // Calcular total pagado
    $total_paid = 0;
    foreach ($payments as $payment) {
        $total_paid += floatval($payment['amount']);
    }

    $stats['total_paid'] = number_format($total_paid, 2);

    echo json_encode([
        'success' => true,
        'client' => $client,
        'stats' => $stats,
        'payments' => $payments
    ]);

} catch(PDOException $e) {
    error_log("Error getting client details: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error de base de datos']);
}
?>