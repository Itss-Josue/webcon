<?php
require_once __DIR__ . '/../models/Pago.php';
require_once __DIR__ . '/../models/Cliente.php';
require_once __DIR__ . '/../models/Proyecto.php';

class PagoController {
    private $model;
    private $clientesModel;
    private $proyectosModel;

    public function __construct($pdo) {
        $this->model = new Pago($pdo);
        $this->clientesModel = new Cliente($pdo);
        $this->proyectosModel = new Proyecto($pdo);
    }

    // Mostrar formulario de creación de pago
    public function add() {
        $clientes = $this->clientesModel->getAll();
        $proyectos = $this->proyectosModel->getAll();
        include __DIR__ . '/../views/pago/create.php';
    }

    // Alias para compatibilidad con rutas antiguas
    public function createForm() {
        $this->add();
    }

    // Guardar nuevo pago
    public function create($data) {
        $this->model->create($data);
        $_SESSION['flash'] = "Pago registrado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#pagos");
        exit;
    }

    // Alias para store
    public function store($data) {
        $this->create($data);
    }

    // Mostrar formulario de edición
    public function edit($id) {
        $pago = $this->model->find($id);
        if (!$pago) {
            $_SESSION['flash'] = "Pago no encontrado ❌";
            header("Location: /webcon/index.php?route=admin:dashboard#pagos");
            exit;
        }
        $clientes = $this->clientesModel->getAll();
        $proyectos = $this->proyectosModel->getAll();
        include __DIR__ . '/../views/pago/edit.php';
    }

    // Alias para editForm (compatibilidad con rutas antiguas)
    public function editForm($id) {
        $this->edit($id);
    }

    // Actualizar pago en la base de datos
    public function update($id, $data) {
        $this->model->update($id, $data);
        $_SESSION['flash'] = "Pago actualizado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#pagos");
        exit;
    }

    // Eliminar pago
    public function delete($id) {
        $this->model->delete($id);
        $_SESSION['flash'] = "Pago eliminado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#pagos");
        exit;
    }
}
