<?php
require_once __DIR__ . '/../models/Admin.php';

class AdminController {
    private $model;
    private $db;

    public function __construct($db) {
        $this->db = $db;
        $this->model = new Admin($db);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function loginForm() {
        require __DIR__ . '/../views/admin/login.php';
    }

    public function login($post = []) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->loginForm();
            return;
        }

        $username = trim($post['username'] ?? '');
        $password = trim($post['password'] ?? '');

        $admin = $this->model->login($username, $password);

        if ($admin) {
            $_SESSION['admin_id']   = $admin['id'];
            $_SESSION['admin_name'] = $admin['nombre'];
            $_SESSION['admin_user'] = $admin['usuario'];

            header('Location: /webcon/index.php?route=admin:dashboard');
            exit;
        } else {
            $_SESSION['flash'] = 'Usuario o contraseña inválidos';
            header('Location: /webcon/index.php?route=admin:loginForm');
            exit;
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /webcon/index.php?route=admin:loginForm");
            exit;
        }

        // 🔹 Cargar TODOS los modelos necesarios
        require_once __DIR__ . '/../models/Cliente.php';
        require_once __DIR__ . '/../models/Proyecto.php';
        require_once __DIR__ . '/../models/Pago.php';
        require_once __DIR__ . '/../models/ApiCliente.php';
        require_once __DIR__ . '/../models/TokenApi.php';
        require_once __DIR__ . '/../models/CountRequest.php';

        $clienteModel  = new Cliente($this->db);
        $proyectoModel = new Proyecto($this->db);
        $pagoModel     = new Pago($this->db);
        $apiClienteModel = new ApiCliente($this->db);
        $tokenApiModel = new TokenApi($this->db);
        $countRequestModel = new CountRequest($this->db);

        $clientes  = $clienteModel->getAll() ?? [];
        $proyectos = $proyectoModel->getAll() ?? [];
        $pagos     = $pagoModel->getAll() ?? [];
        $apiClientes = $apiClienteModel->getAll() ?? [];
        $apiTokens = $tokenApiModel->getAll() ?? [];
        $countRequests = $countRequestModel->getAll() ?? [];
        $requestStats = $countRequestModel->getStats() ?? [];

        require __DIR__ . '/../views/admin/dashboard.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /webcon/index.php?route=admin:loginForm');
        exit;
    }
}