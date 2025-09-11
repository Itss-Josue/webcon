<?php
session_start();
require_once 'Database.php'; // Asegúrate de la ruta correcta

$db = new Database();
$conn = $db->getConnection();

// --- Traer clientes ---
$stmt = $conn->query("SELECT * FROM clientes");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Traer proyectos con nombre de cliente ---
$stmt = $conn->query("
    SELECT p.*, c.name AS client_name 
    FROM proyectos p
    LEFT JOIN clientes c ON p.client_id = c.id
");
$proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// --- Traer pagos con nombre de cliente y proyecto ---
$stmt = $conn->query("
    SELECT pay.*, c.name AS client_name, p.name AS project_name 
    FROM pagos pay
    LEFT JOIN clientes c ON pay.client_id = c.id
    LEFT JOIN proyectos p ON pay.project_id = p.id
");
$pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
