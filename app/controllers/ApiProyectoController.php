<?php
require_once __DIR__ . '/../models/ApiProyecto.php';

class ApiProyectoController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ApiProyecto($pdo);
    }

    // API: listar todos los proyectos (REST)
    public function index() {
        header('Content-Type: application/json; charset=utf-8');
        $proyectos = $this->model->getAllForApi();
        echo json_encode(['proyectos' => $proyectos]);
    }

    // API: obtener proyecto específico (REST)
    public function get($id) {
        header('Content-Type: application/json; charset=utf-8');
        $proyecto = $this->model->getByIdForApi($id);
        
        if ($proyecto) {
            echo json_encode(['proyecto' => $proyecto]);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Proyecto no encontrado']);
        }
    }

    // API: obtener cliente y sus proyectos (REST)
    public function cliente($idCliente) {
        header('Content-Type: application/json; charset=utf-8');
        $data = $this->model->getClienteConProyectosForApi($idCliente);
        
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Cliente no encontrado']);
        }
    }

    // Métodos existentes (mantener sin cambios)
    public function show($idCliente) {
        header('Content-Type: application/json; charset=utf-8');
        $data = $this->model->getClienteConProyectosForApi($idCliente);
        
        if ($data) {
            echo json_encode($data);
        } else {
            http_response_code(404);
            echo json_encode(['error' => 'Cliente no encontrado']);
        }
    }

    public function view() {
        include __DIR__ . '/../views/apiproyecto/index.php';
    }
}
?>