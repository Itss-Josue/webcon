<?php
// index.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Autoload de clases
spl_autoload_register(function ($class_name) {
    $directories = ['controllers/', 'models/', 'config/'];
    
    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Obtener controlador y acción de la URL
$controller = $_GET['controller'] ?? 'cliente';
$action = $_GET['action'] ?? 'index';

// Determinar qué controlador usar
switch ($controller) {
    case 'admin':
        $controllerInstance = new AdminController();
        break;
    case 'cliente':
    default:
        $controllerInstance = new ClienteController();
        $controller = 'cliente'; // Asegurar que sea 'cliente' por defecto
        break;
}

// Ejecutar la acción
if (method_exists($controllerInstance, $action)) {
    $controllerInstance->$action();
} else {
    // Acción no encontrada, redirigir a la página principal
    header('Location: index.php');
    exit;
}
?>