<?php
require_once __DIR__ . '/../config/database.php';

// Router
$controllerName = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

// Cargar controlador
$controllerClass = ucfirst($controllerName) . 'Controller';
$controllerFile = __DIR__ . "/../app/controllers/{$controllerClass}.php";

if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controllerClass();

    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        die("La acción '$action' no existe en el controlador '$controllerClass'.");
    }
} else {
    die("El controlador '$controllerClass' no existe.");
}
