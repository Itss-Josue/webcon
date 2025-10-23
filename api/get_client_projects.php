<?php
// api/get_client_projects.php
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

    // Obtener proyectos del cliente
    $sql = "SELECT *, 
                   DATE_FORMAT(delivery_date, '%d/%m/%Y') as delivery_date_formatted,
                   DATE_FORMAT(created_at, '%d/%m/%Y %H:%i') as created_at
            FROM projects 
            WHERE client_id = :client_id 
            ORDER BY 
                CASE status 
                    WHEN 'active' THEN 1
                    WHEN 'pending' THEN 2
                    WHEN 'completed' THEN 3
                    ELSE 4
                END,
                delivery_date";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':client_id', $client_id, PDO::PARAM_INT);
    $stmt->execute();
    $projects = $stmt->fetchAll();

    echo json_encode([
        'success' => true,
        'data' => $projects
    ]);

} catch(PDOException $e) {
    error_log("Error getting client projects: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error de base de datos']);
}
?>