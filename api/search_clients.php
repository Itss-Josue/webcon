<?php
// api/search_clients.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Incluir configuración de la base de datos
require_once '../config/config.php';

try {
    // Obtener parámetros de búsqueda
    $query = $_POST['query'] ?? '';
    $type = $_POST['type'] ?? 'auto';
    
    if (empty($query)) {
        echo json_encode([]);
        exit;
    }
    
    // Construir consulta SQL según el tipo de búsqueda
    $sql = "SELECT id, dni, name, company, phone, email, created_at FROM clients WHERE ";
    
    switch ($type) {
        case 'dni':
            $sql .= "dni LIKE :query";
            break;
        case 'nombre':
            $sql .= "name LIKE :query";
            break;
        case 'empresa':
            $sql .= "company LIKE :query";
            break;
        case 'id':
            $sql .= "id = :query";
            break;
        default:
            // Búsqueda en todos los campos
            $sql .= "(dni LIKE :query OR name LIKE :query OR company LIKE :query OR id = :query_id)";
            break;
    }
    
    $sql .= " ORDER BY name ASC";
    
    // Preparar y ejecutar consulta
    $stmt = $conn->prepare($sql);
    
    if ($type === 'auto') {
        $searchQuery = "%$query%";
        $stmt->bindParam(':query', $searchQuery);
        
        // Para búsqueda por ID en modo automático
        if (is_numeric($query)) {
            $stmt->bindParam(':query_id', $query, PDO::PARAM_INT);
        } else {
            $stmt->bindValue(':query_id', -1, PDO::PARAM_INT);
        }
    } else if ($type === 'id') {
        $stmt->bindParam(':query', $query, PDO::PARAM_INT);
    } else {
        $searchQuery = "%$query%";
        $stmt->bindParam(':query', $searchQuery);
    }
    
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo json_encode($results);
    
} catch(PDOException $e) {
    // En caso de error, devolver array vacío
    error_log("Error en la búsqueda: " . $e->getMessage());
    echo json_encode([]);
}

// No cerrar conexión si usas el mismo $conn de config.php
?>