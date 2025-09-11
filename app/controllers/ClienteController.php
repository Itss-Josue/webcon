<?php
require_once __DIR__ . '/../models/Cliente.php';

class ClienteController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Cliente($pdo);
    }

    // Mostrar lista de clientes en el dashboard
    public function index() {
        $clientes = $this->model->getAll(); 
        require __DIR__ . '/../views/admin/dashboard.php';
    }

    // Formulario para agregar nuevo cliente
    public function createForm() {
        require __DIR__ . '/../views/clientes/create.php';
    }

    // Guardar nuevo cliente en la base de datos
    public function create($data) {
        $this->model->create($data);
        $_SESSION['flash'] = "Cliente creado correctamente ✅";
        header("Location: /webcon/index.php?route=cliente:index");
        exit;
    }

    // Formulario para editar cliente existente
    public function editForm() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("❌ Cliente no especificado");
        $cliente = $this->model->find($id);
        require __DIR__ . '/../views/clientes/edit.php';
    }

    // Actualizar cliente en la base de datos
    public function update($data) {
        $id = $data['id'] ?? null;
        if (!$id) die("❌ Cliente no especificado");

        $this->model->update($id, $data);
        $_SESSION['flash'] = "Cliente actualizado correctamente ✅";
        header("Location: /webcon/index.php?route=cliente:index");
        exit;
    }

    // Eliminar cliente
    public function delete() {
        $id = $_GET['id'] ?? null;
        if (!$id) die("❌ Cliente no especificado");
        $this->model->delete($id);
        $_SESSION['flash'] = "Cliente eliminado correctamente ✅";
        header("Location: /webcon/index.php?route=cliente:index");
        exit;
    }
}
