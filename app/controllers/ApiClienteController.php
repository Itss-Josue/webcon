<?php
require_once __DIR__ . '/../models/ClientApi.php';

class ApiClienteController {
    private $model;

    public function __construct($db) {
        $this->model = new ApiCliente($db);
    }

    // 📌 Listado
    public function index() {
        $clientes = $this->model->getAll();
        require __DIR__ . '/../views/apicliente/index.php';
    }

    // 📌 Ver detalle
    public function view($id) {
        $cliente = $this->model->getById($id);
        require __DIR__ . '/../views/apicliente/view.php';
    }

    // 📌 Crear
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            // 🔹 Redirigimos con status=created
            header("Location: index.php?route=apicliente:index&status=created");
            exit;
        }
        require __DIR__ . '/../views/apicliente/create.php';
    }

    // 📌 Editar
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            // 🔹 Redirigimos con status=updated
            header("Location: index.php?route=apicliente:index&status=updated");
            exit;
        }
        $cliente = $this->model->getById($id);
        require __DIR__ . '/../views/apicliente/edit.php';
    }

    // 📌 Eliminar
    public function delete($id) {
        $this->model->delete($id);
        // 🔹 Redirigimos con status=deleted
        header("Location: index.php?route=apicliente:index&status=deleted");
        exit;
    }
}
