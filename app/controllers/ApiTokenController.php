<?php
require_once __DIR__ . '/../models/TokenApi.php';
require_once __DIR__ . '/../models/ApiCliente.php';

class ApiTokenController {
    private $model;
    private $clienteModel;

    public function __construct($pdo) {
        $this->model = new TokenApi($pdo);
        $this->clienteModel = new ApiCliente($pdo);
    }

    // Mostrar formulario de creación
    public function createForm() {
        $clientes = $this->clienteModel->getAll();
        include __DIR__ . '/../views/apitoken/create.php';
    }

    // Guardar nuevo token
    public function store($data) {
        $token = $this->model->create($data);
        if ($token) {
            $_SESSION['flash'] = "Token API generado correctamente ✅";
            $_SESSION['new_token'] = $token; // Guardar para mostrar
        } else {
            $_SESSION['flash'] = "Error al generar el token ❌";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#apitoken");
        exit;
    }

    // Mostrar formulario de edición
    public function editForm($id) {
        $token = $this->model->find($id);
        if (!$token) {
            $_SESSION['flash'] = "Token API no encontrado ❌";
            header("Location: /webcon/index.php?route=admin:dashboard#apitoken");
            exit;
        }
        $clientes = $this->clienteModel->getAll();
        include __DIR__ . '/../views/apitoken/edit.php';
    }

    // Actualizar token
    public function update($id, $data) {
        $this->model->update($id, $data);
        $_SESSION['flash'] = "Token API actualizado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#apitoken");
        exit;
    }

    // Regenerar token
    public function regenerateToken($id) {
        $newToken = $this->model->regenerate($id);
        if ($newToken) {
            $_SESSION['flash'] = "Token regenerado correctamente ✅";
            $_SESSION['new_token'] = $newToken;
        } else {
            $_SESSION['flash'] = "Error al regenerar el token ❌";
        }
        header("Location: /webcon/index.php?route=admin:dashboard#apitoken");
        exit;
    }

    // Eliminar token
    public function delete($id) {
        $this->model->delete($id);
        $_SESSION['flash'] = "Token API eliminado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#apitoken");
        exit;
    }
}
?>