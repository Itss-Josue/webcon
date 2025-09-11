<?php
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Proyecto.php';
require_once __DIR__ . '/../models/Pago.php';

class DashboardController {
    private $clienteModel;
    private $proyectoModel;
    private $pagoModel;

    public function __construct($db) {
        $this->clienteModel = new Cliente($db);
        $this->proyectoModel = new Proyecto($db);
        $this->pagoModel = new Pago($db);
    }

    public function index() {
        session_start();
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /webcon/index.php?route=admin:loginForm");
            exit;
        }

        $clientes = $this->clienteModel->getAll();
        $proyectos = $this->proyectoModel->getAll();
        $pagos = $this->pagoModel->getAll();

        require __DIR__ . '/../views/admin/dashboard.php';
    }
}
