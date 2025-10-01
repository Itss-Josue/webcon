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

    // Mostrar formulario de creación
    public function createForm() {
        $tokens = $this->tokenModel->getAll();
        include __DIR__ . '/../views/countrequest/create.php';
    }

    // Guardar nuevo registro
    public function store($data) {
        $this->model->create($data);
        $_SESSION['flash'] = "Registro de request creado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
        exit;
    }

    // Mostrar formulario de edición
    public function editForm($id) {
        $request = $this->model->find($id);
        if (!$request) {
            $_SESSION['flash'] = "Registro de request no encontrado ❌";
            header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
            exit;
        }
        $tokens = $this->tokenModel->getAll();
        include __DIR__ . '/../views/countrequest/edit.php';
    }

    // Actualizar registro
    public function update($id, $data) {
        $this->model->update($id, $data);
        $_SESSION['flash'] = "Registro de request actualizado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
        exit;
    }

    // Eliminar registro
    public function delete($id) {
        $this->model->delete($id);
        $_SESSION['flash'] = "Registro de request eliminado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#countrequest");
        exit;
    }
}
?>