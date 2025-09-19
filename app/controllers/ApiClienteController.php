<?php
require_once __DIR__ . '/../models/ClientApi.php';

class ApiClienteController {
    private $model;

    public function __construct($db) {
        $this->model = new ApiCliente($db);
    }

    // 📌 Listado de clientes
    public function index() {
        $clientes = $this->model->getAll();
        require __DIR__ . '/../views/apicliente/index.php';
    }

    // 📌 Ver cliente
    public function view($id) {
        $cliente = $this->model->getById($id);
        require __DIR__ . '/../views/apicliente/view.php';
    }

    // 📌 Crear cliente
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header("Location: index.php?route=apicliente:index");
            exit;
        } else {
            require __DIR__ . '/../views/apicliente/create.php';
        }
    }

    // 📌 Editar cliente
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php?route=apicliente:index");
            exit;
        } else {
            $cliente = $this->model->getById($id);
            require __DIR__ . '/../views/apicliente/edit.php';
        }
    }

    // 📌 Eliminar cliente
    public function delete($id) {
        $this->model->delete($id);
        header("Location: index.php?route=apicliente:index");
        exit;
    }
}
