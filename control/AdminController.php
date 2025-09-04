<?php
// control/AdminController.php
class AdminController {
    protected $model;
    
    public function __construct() {
        // Verificar sesión solo si no estamos en el proceso de login
        if (!isset($_SESSION['usuario_id']) && basename($_SERVER['PHP_SELF']) != 'login.php') {
            header('Location: login.php');
            exit();
        }
    }
    
    protected function loadModel($modelName) {
        require_once 'model/' . $modelName . '.php';
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
    }
}