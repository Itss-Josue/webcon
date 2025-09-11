<?php
require_once __DIR__ . '/../models/Proyecto.php';

class ProyectoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Proyecto($pdo);
    }

    // Mostrar formulario de creación de proyecto
    public function createForm() {
        $clientes = $this->model->getClientes();
        require __DIR__ . '/../views/proyecto/create.php';
    }

    // Guardar proyecto (POST)
    public function create($data) {
        $this->model->create($data);
        $_SESSION['flash'] = "Proyecto creado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#proyectos");
        exit;
    }

    // Alias para compatibilidad con rutas antiguas
    public function store($data) {
        $this->create($data);
    }

    // Mostrar formulario de edición
    public function editForm($id) {
        $proyecto = $this->model->find($id);
        if (!$proyecto) {
            $_SESSION['flash'] = "Proyecto no encontrado ❌";
            header("Location: /webcon/index.php?route=admin:dashboard#proyectos");
            exit;
        }
        $clientes = $this->model->getClientes();
        require __DIR__ . '/../views/proyecto/edit.php';
    }

    // Actualizar proyecto (POST)
    public function update($id, $data) {
        $this->model->update($id, $data);
        $_SESSION['flash'] = "Proyecto actualizado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#proyectos");
        exit;
    }

    // Alias para compatibilidad con rutas antiguas
    public function edit($id, $data) {
        $this->update($id, $data);
    }

    // Eliminar proyecto
    public function delete($id) {
        $this->model->delete($id);
        $_SESSION['flash'] = "Proyecto eliminado correctamente ✅";
        header("Location: /webcon/index.php?route=admin:dashboard#proyectos");
        exit;
    }

    // Listar todos los proyectos
    public function index() {
        $proyectos = $this->model->getAll();
        require __DIR__ . '/../views/proyecto/index.php';
    }
}

