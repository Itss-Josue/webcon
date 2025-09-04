<?php
// control/AdminController.php
class AdminController {
    protected $model;
    
    public function __construct() {
        session_start(); // Añadir inicio de sesión
        // Verificar sesión solo si no estamos en el proceso de login
        if (!isset($_SESSION['usuario_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
            header('Location: login.php');
            exit();
        }
    }
    
    protected function loadModel($modelName) {
        $modelFile = 'model/' . $modelName . '.php';
        
        // Verificar si el archivo del modelo existe
        if (!file_exists($modelFile)) {
            throw new Exception("Modelo no encontrado: " . $modelFile);
        }
        
        require_once $modelFile;
        
        // Verificar si la clase existe
        if (!class_exists($modelName)) {
            throw new Exception("Clase no encontrada: " . $modelName);
        }
        
        return new $modelName();
    }
    
    protected function renderView($view, $data = []) {
        // Extraer datos para hacerlos disponibles en la vista
        extract($data);
        
        // Incluir cabecera
        require_once 'view/include/header.php';
        
        // Incluir vista específica
        require_once 'view/admin/' . $view . '.php';
        
        // Incluir pie de página
        require_once 'view/include/footer.php';
    }
    
    public function dashboard() {
        try {
            $projectModel = $this->loadModel('ProjectModel');
            $clientModel = $this->loadModel('ClientModel');
            $paymentModel = $this->loadModel('PaymentModel');
            
            $data = [
                'totalClientes' => $clientModel->getTotalClientes(),
                'proyectosActivos' => $projectModel->getProyectosActivos(),
                'ingresosMes' => $paymentModel->getIngresosMes(),
                'proyectosPendientes' => $projectModel->getProyectosPendientes(),
                'proyectosProgreso' => $projectModel->getProyectosProgreso()
            ];
            
            $this->renderView('dashboard', $data);
        } catch (Exception $e) {
            // Manejar el error adecuadamente
            error_log("Error en dashboard: " . $e->getMessage());
            echo "Error al cargar los datos. Por favor, intente más tarde.";
        }
    }
}