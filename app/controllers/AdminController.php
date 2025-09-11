<?php
require_once __DIR__ . '/../models/Admin.php';

class AdminController {
    private $model;
    private $db; // Guardamos la conexión para otros modelos

    public function __construct($db) {
        $this->db = $db;              // Guardar la conexión
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

            // Ir al panel de administración
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

        // 🔹 Cargar datos desde modelos
        require_once __DIR__ . '/../models/Cliente.php';
        require_once __DIR__ . '/../models/Proyecto.php';
        require_once __DIR__ . '/../models/Pago.php';

        $clienteModel  = new Cliente($this->db);
        $proyectoModel = new Proyecto($this->db);
        $pagoModel     = new Pago($this->db);

        $clientes  = $clienteModel->getAll() ?? [];
        $proyectos = $proyectoModel->getAll() ?? [];
        $pagos     = $pagoModel->getAll() ?? [];

        // 🔹 Pasar a la vista
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /webcon/index.php?route=admin:loginForm');
        exit;
    }
}
