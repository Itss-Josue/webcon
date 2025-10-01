<?php
require_once __DIR__ . '/../models/ApiCliente.php';

class ApiClienteController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ApiCliente($pdo);
    }

    // Mostrar formulario de creación
    public function createForm() {
        include __DIR__ . '/../views/apicliente/create.php';
    }

    // Guardar nuevo cliente API
    public function store($data) {
        $this->model->create($data);
        $_SESSION['flash'] = "Cliente API registrado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
        exit;
    }

    // Mostrar formulario de edición
    public function editForm($id) {
        $cliente = $this->model->find($id);
        if (!$cliente) {
            $_SESSION['flash'] = "Cliente API no encontrado ❌";
            header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
            exit;
        }
        include __DIR__ . '/../views/apicliente/edit.php';
    }

    // Actualizar cliente API
    public function update($id, $data) {
        $this->model->update($id, $data);
        $_SESSION['flash'] = "Cliente API actualizado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
        exit;
    }

    // Eliminar cliente API
    public function delete($id) {
        $this->model->delete($id);
        $_SESSION['flash'] = "Cliente API eliminado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#apicliente");
        exit;
    }
}
?>