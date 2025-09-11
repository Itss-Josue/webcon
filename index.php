<?php
session_start();

// 1. Conexión a la BD
$host = "127.0.0.1";
$dbname = "webcon";
$user = "root";
$pass = "";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("❌ Error de conexión: " . $e->getMessage());
}

// 2. Definir ruta
$route = $_GET['route'] ?? 'admin:loginForm';
list($controllerName, $action) = explode(':', $route);

// 3. Cargar controlador según ruta
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

    default:
        die("❌ Controlador '$controllerName' no encontrado");
}

// 4. Verificar acción
if (!method_exists($controller, $action)) {
    die("⚠️ Acción '$action' no encontrada en " . get_class($controller));
}

// 5. Ejecutar acción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($controllerName === 'proyecto' && $action === 'edit') {
        // Para proyectos edit (update) pasamos id y datos del POST
        if (!isset($_GET['id'])) die("❌ ID no especificado para actualizar proyecto");
        $controller->$action($_GET['id'], $_POST);
    } else {
        $controller->$action($_POST);
    }
} else {
    // Para GET, verificamos si la acción requiere parámetros
    $reflection = new ReflectionMethod($controller, $action);
    $numParams = $reflection->getNumberOfParameters();

    if ($numParams === 1 && isset($_GET['id'])) {
        // Acción espera 1 parámetro, se lo pasamos desde ?id=...
        $controller->$action($_GET['id']);
    } elseif ($numParams === 2 && isset($_GET['id'])) {
        // Acción espera 2 parámetros (por ejemplo $id y $data)
        $controller->$action($_GET['id'], $_GET);
    } else {
        // Acción sin parámetros
        $controller->$action();
    }
}
