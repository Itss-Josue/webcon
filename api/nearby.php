<?php
// api/nearby.php
require_once __DIR__ . '/../app/models/Cliente.php';
header('Content-Type: application/json; charset=utf-8');

$lat    = isset($_GET['lat']) ? (float)$_GET['lat'] : null;
$lng    = isset($_GET['lng']) ? (float)$_GET['lng'] : null;
$radius = isset($_GET['radius']) ? (float)$_GET['radius'] : 10; // km

if (!$lat || !$lng) {
    echo json_encode(['error' => 'Parámetros lat y lng son obligatorios']);
    exit;
}

$model = new ApiCliente();

try {
    $results = $model->nearby($lat, $lng, $radius, 50);
    echo json_encode([
        'count'    => count($results),
        'clientes' => $results
    ]);
} catch (Exception $e) {
    echo json_encode([
        'error' => 'Error en la API de clientes: ' . $e->getMessage()
    ]);
}
