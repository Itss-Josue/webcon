<?php
require_once __DIR__ . '/../models/ApiCliente.php';

class ApiClienteController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ApiCliente($pdo);
    }

    // API REST: Listar clientes API
    public function index() {
        header('Content-Type: application/json; charset=utf-8');
        $clientes = $this->model->getAll();
        echo json_encode(['clientes' => $clientes]);
    }

    // API REST: Crear cliente API
    public function create() {
        header('Content-Type: application/json; charset=utf-8');
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if (empty($input['ruc']) || empty($input['razon_social'])) {
            http_response_code(400);
            echo json_encode(['error' => 'RUC y Razón Social son obligatorios']);
            return;
        }
        
        if ($this->model->create($input)) {
            http_response_code(201);
            echo json_encode(['message' => 'Cliente API creado exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al crear cliente API']);
        }
    }

    // API REST: Obtener cliente API específico
    public function get($id) {
        header('Content-Type: application/json; charset=utf-8');
        $cliente = $this->model->find($id);
        
        if ($cliente) {
            echo json_encode(['cliente' => $cliente]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Cliente API no encontrado']);
        }
    }

    // API REST: Actualizar cliente API
    public function update($id) {
        header('Content-Type: application/json; charset=utf-8');
        
        $input = json_decode(file_get_contents('php://input'), true);
        
        if ($this->model->update($id, $input)) {
            echo json_encode(['message' => 'Cliente API actualizado exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al actualizar cliente API']);
        }
    }

    // API REST: Eliminar cliente API
    public function delete($id) {
        header('Content-Type: application/json; charset=utf-8');
        
        if ($this->model->delete($id)) {
            echo json_encode(['message' => 'Cliente API eliminado exitosamente']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Error al eliminar cliente API']);
        }
    }

    // Métodos existentes (mantener sin cambios)
    private function checkAuth() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /webcon/index.php?route=admin:loginForm");
            exit;
        }
    }

    public function createForm() {
        $this->checkAuth();
        include __DIR__ . '/../views/apicliente/create.php';
    }

    public function store($data) {
        $this->checkAuth();
        
        if ($this->model->create($data)) {
            $_SESSION['flash'] = "Cliente API registrado correctamente";
        } else {
            $_SESSION['error'] = "Error al registrar el cliente API";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
        exit;
    }

    public function editForm($id) {
        $this->checkAuth();
        $cliente = $this->model->find($id);
        if (!$cliente) {
            $_SESSION['error'] = "Cliente API no encontrado";
            header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
            exit;
        }
        include __DIR__ . '/../views/apicliente/edit.php';
    }

    public function updateForm($id, $data) {
        $this->checkAuth();
        
        if ($this->model->update($id, $data)) {
            $_SESSION['flash'] = "Cliente API actualizado correctamente";
        } else {
            $_SESSION['error'] = "Error al actualizar el cliente API";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
        exit;
    }

    public function deleteForm($id) {
        $this->checkAuth();
        
        if ($this->model->delete($id)) {
            $_SESSION['flash'] = "Cliente API eliminado correctamente";
        } else {
            $_SESSION['error'] = "Error al eliminar el cliente API";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
        exit;
    }
}
?>