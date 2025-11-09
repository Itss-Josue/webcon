<?php
require_once __DIR__ . '/../model/TokenModel.php';

class Token {
    private $model;

    public function __construct() {
        $this->model = new TokenModel();
    }

    // 📄 Mostrar todos los tokens
    public function index() {
        $tokens = $this->model->getAll();
        require __DIR__ . '/../view/tokens/list.php';
    }

    // ➕ Generar un nuevo token (automático)
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['client_id'])) {
            $clientId = $_POST['client_id'];
            $newToken = $this->model->createToken($clientId);

            header("Location: index.php?route=tokens&msg=Token generado correctamente&token=" . $newToken['token']);
            exit;
        } else {
            require __DIR__ . '/../view/tokens/form.php';
        }
    }

    // 🔄 Actualizar / Renovar token
    public function update() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // Obtener token actual por ID
            $tokenData = $this->model->findById($id);
            if ($tokenData) {
                $updated = $this->model->refreshToken($tokenData['token']);
                header("Location: index.php?route=tokens&msg=Token actualizado correctamente&token=" . $updated['token']);
                exit;
            } else {
                header("Location: index.php?route=tokens&error=Token no encontrado");
                exit;
            }
        } else {
            header("Location: index.php?route=tokens&error=ID no proporcionado");
            exit;
        }
    }

    // ❌ Eliminar token
    public function delete() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $this->model->delete($id);

            header("Location: index.php?route=tokens&msg=Token eliminado correctamente");
            exit;
        } else {
            header("Location: index.php?route=tokens&error=ID no proporcionado");
            exit;
        }
    }
}
