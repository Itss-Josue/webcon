<?php
// index.php - router simple
session_start();

// Autoload helpers
spl_autoload_register(function($class){
    $paths = [
        __DIR__ . '/src/control/',
        __DIR__ . '/src/model/',
        __DIR__ . '/src/config/'
    ];
    foreach($paths as $p){
        $f = $p . $class . '.php';
        if(file_exists($f)) { require_once $f; return; }
    }
});

// Default route -> auth:login
$route = $_REQUEST['route'] ?? 'auth:login';
list($controllerName, $action) = explode(':', $route);

// controller file is e.g. src/control/Client.php with class Client
$controllerFile = __DIR__ . '/src/control/' . ucfirst($controllerName) . '.php';
if (!file_exists($controllerFile)) {
    http_response_code(404);
    echo "Controlador no encontrado: $controllerFile";
    exit;
}
require_once $controllerFile;
$controllerClass = ucfirst($controllerName); // class names: Client, Project, Auth, Dashboard, etc.
if (!class_exists($controllerClass)) {
    http_response_code(500);
    echo "Clase controlador $controllerClass no definida.";
    exit;
}
$controller = new $controllerClass();
if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo "Acción $action no encontrada en $controllerClass";
    exit;
}
$controller->$action();
