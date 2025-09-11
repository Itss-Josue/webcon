<?php
// api/nearby.php
require_once __DIR__ . '/../app/models/Hotel.php';
header('Content-Type: application/json; charset=utf-8');

$lat = isset($_GET['lat']) ? (float)$_GET['lat'] : null;
$lng = isset($_GET['lng']) ? (float)$_GET['lng'] : null;
$radius = isset($_GET['radius']) ? (float)$_GET['radius'] : 10; // km

if (!$lat || !$lng) {
    echo json_encode(['error' => 'lat and lng required']);
    exit;
}

$model = new Hotel();
$results = $model->nearby($lat, $lng, $radius, 50);
echo json_encode(['count'=>count($results), 'hotels'=>$results]);
