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

    private function checkAuth() {
        if (!isset($_SESSION['admin_id'])) {
            header("Location: /webcon/index.php?route=admin:loginForm");
            exit;
        }
    }

    // Mostrar formulario de creación
    public function createForm() {
        $this->checkAuth();
        $clientes = $this->clienteModel->getAll();
        include __DIR__ . '/../views/apitoken/create.php';
    }

    // Guardar nuevo token
public function store($data) {
    $this->checkAuth();
    $token = $this->model->create($data);
    if ($token) {
        $_SESSION['flash'] = "Token API generado correctamente";
        $_SESSION['new_token'] = $token;
    } else {
        $_SESSION['error'] = "Error al generar el token API";
    }
    // Esta es la línea importante que te redirige a la sección de tokens
    header("Location: /webcon/index.php?route=dashboard:index#apitoken");
    exit;
}

    // Mostrar formulario de edición
    public function editForm($id) {
        $this->checkAuth();
        $token = $this->model->find($id);
        if (!$token) {
            $_SESSION['error'] = "Token API no encontrado";
            header("Location: /webcon/index.php?route=admin:dashboard#apitoken");
            exit;
        }
        $clientes = $this->clienteModel->getAll();
        include __DIR__ . '/../views/apitoken/edit.php';
    }

    // En el método update
public function update($id, $data) {
    $this->checkAuth();
    
    if ($this->model->update($id, $data)) {
        $_SESSION['flash'] = "Token API actualizado correctamente";
    } else {
        $_SESSION['error'] = "Error al actualizar el token API";
    }
    header("Location: /webcon/index.php?route=apitoken:index");
    exit;
}

// En el método regenerateToken
public function regenerateToken($id) {
    $this->checkAuth();
    $newToken = $this->model->regenerate($id);
    if ($newToken) {
        $_SESSION['flash'] = "Token regenerado correctamente";
        $_SESSION['new_token'] = $newToken;
    } else {
        $_SESSION['error'] = "Error al regenerar el token";
    }
    header("Location: /webcon/index.php?route=apitoken:index");
    exit;
}

// En el método delete
public function delete($id) {
    $this->checkAuth();
    
    if ($this->model->delete($id)) {
        $_SESSION['flash'] = "Token API eliminado correctamente";
    } else {
        $_SESSION['error'] = "Error al eliminar el token API";
    }
    header("Location: /webcon/index.php?route=apitoken:index");
    exit;
}
    // Mostrar información del token
public function view($id) {
    $this->checkAuth();
    $token = $this->model->find($id);
    if (!$token) {
        $_SESSION['error'] = "Token API no encontrado";
        header("Location: /webcon/index.php?route=admin:dashboard#apitoken");
        exit;
    }
    include __DIR__ . '/../views/apitoken/view.php';
}
// Mostrar lista de tokens
public function index() {
    $this->checkAuth();
    $apiTokens = $this->model->getAll();
    include __DIR__ . '/../views/apitoken/index.php';
}
}
?>