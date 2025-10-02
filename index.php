<?php
session_start();
require_once __DIR__ . '/config/config.php';

// ✅ Configuración
define('DEBUG', true); // Cambiar a false en producción

// ✅ Función de manejo de errores
function handleError($message, $code = 500) {
    error_log("Application Error: $message");
    
    if (DEBUG) {
        die("<div style='background: #f8d7da; color: #721c24; padding: 20px; border: 1px solid #f5c6cb; border-radius: 5px; margin: 20px;'>
            <h3>Error de Aplicación</h3>
            <p><strong>$message</strong></p>
        </div>");
    } else {
        header('Location: /webcon/index.php?route=admin:dashboard');
        exit;
    }
}

// ✅ Conexión a la base de datos
try {
    $db = new Database();
    $pdo = $db->getConnection();
} catch (Exception $e) {
    handleError("Error de conexión a la base de datos: " . $e->getMessage());
}

// ✅ Definir rutas
$routes = [
    'admin' => 'AdminController',
    'dashboard' => 'DashboardController',
    'cliente' => 'ClienteController',
    'pago' => 'PagoController',
    'proyecto' => 'ProyectoController',
    'auth' => 'AuthController',
    'api-cliente' => 'ApiClienteController',
    'apitoken' => 'ApiTokenController',
    'countrequest' => 'CountRequestController'
];

// ✅ Obtener ruta
$route = $_GET['route'] ?? 'admin:dashboard';

if (!str_contains($route, ':')) {
    $route = 'admin:dashboard';
}

list($controllerName, $action) = explode(':', $route);

// ✅ Sanitizar nombres
$controllerName = preg_replace('/[^a-zA-Z0-9-]/', '', $controllerName);
$action = preg_replace('/[^a-zA-Z0-9_]/', '', $action);

// ✅ Cargar controlador
if (!isset($routes[$controllerName])) {
    handleError("Controlador '$controllerName' no encontrado", 404);
}

$controllerClass = $routes[$controllerName];
$controllerFile = __DIR__ . "/app/controllers/{$controllerClass}.php";

if (!file_exists($controllerFile)) {
    handleError("Archivo del controlador no encontrado: $controllerFile", 404);
}

require_once $controllerFile;

if (!class_exists($controllerClass)) {
    handleError("Clase '$controllerClass' no definida en $controllerFile", 500);
}

$controller = new $controllerClass($pdo);

// ✅ Validar acción
if (!method_exists($controller, $action)) {
    handleError("Acción '$action' no encontrada en $controllerClass", 404);
}

// ✅ Obtener parámetros
$reflection = new ReflectionMethod($controller, $action);
$parameters = $reflection->getParameters();
$params = [];

foreach ($parameters as $param) {
    $paramName = $param->getName();
    
    if ($paramName === 'id' && isset($_GET['id'])) {
        $params[] = $_GET['id'];
    } elseif (($paramName === 'data' || $paramName === 'post') && $_SERVER['REQUEST_METHOD'] === 'POST') {
        $params[] = $_POST;
    } else {
        $params[] = null;
    }
}

// ✅ Ejecutar acción
try {
    call_user_func_array([$controller, $action], $params);
} catch (Exception $e) {
    handleError("Error ejecutando acción: " . $e->getMessage());
}
