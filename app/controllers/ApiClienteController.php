<?php
require_once __DIR__ . '/../models/ApiCliente.php';

class ApiClienteController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ApiCliente($pdo);
    }

    private function checkAuth() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /webcon/index.php?route=admin:loginForm");
            exit;
        }
    }

    // Mostrar formulario de creación
    public function createForm() {
        $this->checkAuth();
        include __DIR__ . '/../views/apicliente/create.php';
    }

    // Guardar nuevo cliente API
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

    // Mostrar formulario de edición
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

    // Actualizar cliente API
    public function update($id, $data) {
        $this->checkAuth();
        
        if ($this->model->update($id, $data)) {
            $_SESSION['flash'] = "Cliente API actualizado correctamente";
        } else {
            $_SESSION['error'] = "Error al actualizar el cliente API";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
        exit;
    }

    // Eliminar cliente API
    public function delete($id) {
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