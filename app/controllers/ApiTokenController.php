<?php
require_once __DIR__ . '/../models/ApiToken.php';

class ApiTokenController {

    private $model;

    public function __construct() {
        $this->model = new ApiToken();
    }

    // 📋 Listar todos los tokens
    public function index() {
        $tokens = $this->model->getAll();
        $this->render('index', ['tokens' => $tokens]);
    }

    // ➕ Crear nuevo token
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->model->create($_POST)) {
                $this->redirectWithStatus('created');
            }
        }
        $this->render('create');
    }

    // ✏ Editar token
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->model->update($id, $_POST)) {
                $this->redirectWithStatus('updated');
            }
        }
        $token = $this->model->getById($id);
        $this->render('edit', ['token' => $token]);
    }

    // 🗑 Eliminar token
    public function delete($id) {
        if ($this->model->delete($id)) {
            $this->redirectWithStatus('deleted');
        }
    }

    // 👁 Ver detalle
    public function view($id) {
        $token = $this->model->getById($id);
        $this->render('view', ['token' => $token]);
    }

    // 🔄 Helpers internos
    private function redirectWithStatus($status) {
        header("Location: index.php?route=apitoken:index&status=$status");
        exit;
    }

    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . "/../views/apitoken/{$view}.php";
    }
}
