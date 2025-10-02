<?php
require_once __DIR__ . '/../models/CountRequest.php';
require_once __DIR__ . '/../models/TokenApi.php';

class CountRequestController {
    private $model;
    private $tokenModel;

    public function __construct($pdo) {
        $this->model = new CountRequest($pdo);
        $this->tokenModel = new TokenApi($pdo);
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
        $tokens = $this->tokenModel->getAll();
        $tipos = $this->model->getTipos();
        include __DIR__ . '/../views/countrequest/create.php';
    }

    // Guardar nuevo registro
    public function store($data) {
        $this->checkAuth();
        
        if ($this->model->create($data)) {
            $_SESSION['flash'] = "Registro de request creado correctamente";
        } else {
            $_SESSION['error'] = "Error al crear el registro de request";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
        exit;
    }

    // Mostrar formulario de edición
    public function editForm($id) {
        $this->checkAuth();
        $request = $this->model->find($id);
        if (!$request) {
            $_SESSION['error'] = "Registro de request no encontrado";
            header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
            exit;
        }
        $tokens = $this->tokenModel->getAll();
        $tipos = $this->model->getTipos();
        include __DIR__ . '/../views/countrequest/edit.php';
    }

    // Actualizar registro
    public function update($id, $data) {
        $this->checkAuth();
        
        if ($this->model->update($id, $data)) {
            $_SESSION['flash'] = "Registro de request actualizado correctamente";
        } else {
            $_SESSION['error'] = "Error al actualizar el registro de request";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
        exit;
    }

    // Eliminar registro
    public function delete($id) {
        $this->checkAuth();
        
        if ($this->model->delete($id)) {
            $_SESSION['flash'] = "Registro de request eliminado correctamente";
        } else {
            $_SESSION['error'] = "Error al eliminar el registro de request";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
        exit;
    }
}
?>