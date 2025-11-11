<?php
require_once __DIR__ . '/../model/TokenModel.php';
require_once __DIR__ . '/../model/ClientModel.php';

class Token {
    private $model;
    private $clientModel;

    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?route=Auth:login");
            exit;
        }
        $this->model = new TokenModel();
        $this->clientModel = new ClientModel();
    }

    // Mostrar lista de tokens
    public function index() {
        $tokens = $this->model->getAll();
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/tokens/list.php';
        include __DIR__ . '/../view/layout/footer.php';
    }

    // Mostrar formulario para crear nuevo token
    public function createForm() {
        $clients = $this->clientModel->getAll();
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/tokens/form.php';
        include __DIR__ . '/../view/layout/footer.php';
    }

    // Guardar nuevo token
    public function store() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Method not allowed');

    $data = [
        'client_id' => $_POST['client_id'] ?? null,
        'token' => bin2hex(random_bytes(16)),
        'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour')), // expiración en 1 hora
        'status' => 'Activo'
    ];

    $this->model->create($data);
    header("Location: index.php?route=Token:index&msg=Token generado correctamente");
}


    // Editar token (por si lo necesitas más adelante)
    public function edit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Method not allowed');
        $id = $_POST['id'] ?? null;
        if (!$id) die('ID requerido');

        $token = $this->model->getById($id);
        $clients = $this->clientModel->getAll();

        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/tokens/form.php';
        include __DIR__ . '/../view/layout/footer.php';
    }

    // Actualizar token
    public function update() {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Method not allowed');

    $id = $_POST['id'];

    $data = [
        'token' => bin2hex(random_bytes(16)), // nuevo token
        'expires_at' => date('Y-m-d H:i:s', strtotime('+1 hour')),
        'status' => $_POST['status'],
        'client_id' => $_POST['client_id']
    ];

    $this->model->update($id, $data);
    header("Location: index.php?route=Token:index&msg=Token actualizado correctamente");
}


    // Eliminar token
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') die('Method not allowed');
        $id = $_POST['id'];
        $this->model->delete($id);
        header("Location: index.php?route=Token:index&msg=Token eliminado correctamente");
    }
    public function validateTokenApi() {
    $token = $_GET['token'] ?? null;

    header('Content-Type: application/json');

    if (!$token) {
        echo json_encode(['status' => 'error', 'message' => 'Token no proporcionado']);
        exit;
    }

    $tokenData = $this->model->getByToken($token);

    if ($tokenData && $tokenData['status'] === 'Activo' && strtotime($tokenData['expires_at']) > time()) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Token verificado',
            'client' => [
                'id' => $tokenData['client_id'],
                'name' => $tokenData['client_name'] ?? ''
            ]
        ]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Token incorrecto o expirado']);
    }
}

}
