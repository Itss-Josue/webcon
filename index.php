<?php
session_start();
require_once __DIR__ . '/config/database.php';

// ✅ Conexión
$db = new Database();
$pdo = $db->getConnection();

// 1️⃣ Definir ruta
$route = $_GET['route'] ?? 'admin:login';
list($controllerName, $action) = explode(':', $route);

// 2️⃣ Cargar controlador
switch ($controllerName) {
    case 'admin':
        require_once __DIR__ . '/app/controllers/AdminController.php';
        $controller = new AdminController($pdo);
        break;

    case 'cliente':
        require_once __DIR__ . '/app/controllers/ClienteController.php';
        $controller = new ClienteController($pdo);
        break;

    case 'pago':
        require_once __DIR__ . '/app/controllers/PagoController.php';
        $controller = new PagoController($pdo);
        break;

    case 'proyecto':
        require_once __DIR__ . '/app/controllers/ProyectoController.php';
        $controller = new ProyectoController($pdo);
        break;

    case 'auth':
        require_once __DIR__ . '/app/controllers/AuthController.php';
        $controller = new AuthController($pdo);
        break;

    default:
        die("❌ Controlador '$controllerName' no encontrado");
}

// 3️⃣ Ejecutar acción de forma dinámica
if (!method_exists($controller, $action)) {
    die("⚠️ Acción '$action' no encontrada en " . get_class($controller));
}

// 4️⃣ Manejar GET y POST con parámetros opcionales
$reflection = new ReflectionMethod($controller, $action);
$numParams = $reflection->getNumberOfParameters();

$params = [];

// Si la acción espera 1 parámetro, buscar id en GET
if ($numParams === 1) {
    if (isset($_GET['id'])) {
        $params[] = $_GET['id'];
    } else {
        // Para POST que pasa un array
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $params[] = $_POST;
        } else {
            $params[] = null; // Se puede validar dentro del método
        }
    }
}

// Si la acción espera 2 parámetros
if ($numParams === 2) {
    if (isset($_GET['id'])) $params[] = $_GET['id'];
    if ($_SERVER['REQUEST_METHOD'] === 'POST') $params[] = $_POST;
}

// 5️⃣ Llamar a la acción con parámetros dinámicos
$controller->$action(...$params);
