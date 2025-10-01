<?php
// DashboardController.php
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Proyecto.php';
require_once __DIR__ . '/../models/Pago.php';
require_once __DIR__ . '/../models/ApiCliente.php';
require_once __DIR__ . '/../models/TokenApi.php';
require_once __DIR__ . '/../models/CountRequest.php';

class DashboardController {
    private $clienteModel;
    private $proyectoModel;
    private $pagoModel;
    private $apiClienteModel;
    private $tokenApiModel;
    private $countRequestModel;

    public function __construct($pdo) {
        $this->clienteModel = new Cliente($pdo);
        $this->proyectoModel = new Proyecto($pdo);
        $this->pagoModel = new Pago($pdo);
        $this->apiClienteModel = new ApiCliente($pdo);
        $this->tokenApiModel = new TokenApi($pdo);
        $this->countRequestModel = new CountRequest($pdo);
    }

    public function index() {
        // ✅ REMOVER session_start() - ya se inició en index.php
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /webcon/index.php?route=admin:loginForm");
            exit;
        }

        // Datos principales
        $clientes = $this->clienteModel->getAll();
        $proyectos = $this->proyectoModel->getAll();
        $pagos = $this->pagoModel->getAll();
        
        // Datos de API
        $apiClientes = $this->apiClienteModel->getAll();
        $apiTokens = $this->tokenApiModel->getAll();
        $countRequests = $this->countRequestModel->getAll();
        $requestStats = $this->countRequestModel->getStats();

        require __DIR__ . '/../views/admin/dashboard.php';
    }
}
?>