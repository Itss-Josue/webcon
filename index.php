<?php
// index.php
session_start();

// Definir constante para verificar si el archivo actual es login.php
define('CURRENT_PAGE', basename($_SERVER['PHP_SELF']));

// Incluir configuración
require_once 'config/database.php';

// Verificar autenticación SOLO si no estamos en la página de login
if (!isset($_SESSION['usuario_id']) && CURRENT_PAGE != 'login.php') {
    header('Location: login.php');
    exit();
}

// Si ya está autenticado y trata de acceder a login.php, redirigir al dashboard
if (isset($_SESSION['usuario_id']) && CURRENT_PAGE == 'login.php') {
    header('Location: index.php?controller=Admin&action=dashboard');
    exit();
}

// Cargar controladores
require_once 'control/AdminController.php';
require_once 'control/ProjectController.php';
require_once 'control/ClientController.php';
require_once 'control/PaymentController.php';
require_once 'control/ReportController.php';
require_once 'control/SettingsController.php';

// Manejar rutas
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'Admin';

// Ejecutar controlador y acción correspondiente
$controllerName = $controller . 'Controller';
if (class_exists($controllerName)) {
    $controllerInstance = new $controllerName();
    if (method_exists($controllerInstance, $action)) {
        $controllerInstance->$action();
    } else {
        // Página no encontrada
        header("HTTP/1.0 404 Not Found");
        include 'view/404.php';
    }
} else {
    // Página no encontrada
    header("HTTP/1.0 404 Not Found");
    include 'view/404.php';
}