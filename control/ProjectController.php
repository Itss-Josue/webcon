<?php
// control/ProjectController.php
require_once 'control/AdminController.php';

class ProjectController extends AdminController {
    public function index() {
        $projectModel = $this->loadModel('ProjectModel');
        $clientModel = $this->loadModel('ClientModel');
        
        $data = [
            'proyectos' => $projectModel->getAllProyectos(),
            'clientes' => $clientModel->getAllClientes()
        ];
        
        $this->renderView('projects', $data);
    }
    
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $projectModel = $this->loadModel('ProjectModel');
            
            $datos = [
                'nombre' => $_POST['nombre'],
                'cliente_id' => $_POST['cliente_id'],
                'tipo' => $_POST['tipo'],
                'progreso' => $_POST['progreso'],
                'estado' => $_POST['estado'],
                'fecha_entrega' => $_POST['fecha_entrega']
            ];
            
            if ($projectModel->crearProyecto($datos)) {
                $_SESSION['mensaje'] = 'Proyecto creado exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'Error al crear el proyecto';
                $_SESSION['tipo_mensaje'] = 'error';
            }
            
            header('Location: index.php?controller=Project&action=index');
            exit();
        }
    }
    
    public function editar() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $projectModel = $this->loadModel('ProjectModel');
            $id = $_POST['id'];
            
            $datos = [
                'nombre' => $_POST['nombre'],
                'progreso' => $_POST['progreso'],
                'estado' => $_POST['estado'],
                'fecha_entrega' => $_POST['fecha_entrega']
            ];
            
            if ($projectModel->actualizarProyecto($id, $datos)) {
                $_SESSION['mensaje'] = 'Proyecto actualizado exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'Error al actualizar el proyecto';
                $_SESSION['tipo_mensaje'] = 'error';
            }
            
            header('Location: index.php?controller=Project&action=index');
            exit();
        }
    }
    
    public function eliminar() {
        if (isset($_GET['id'])) {
            $projectModel = $this->loadModel('ProjectModel');
            $id = $_GET['id'];
            
            if ($projectModel->eliminarProyecto($id)) {
                $_SESSION['mensaje'] = 'Proyecto eliminado exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
            } else {
                $_SESSION['mensaje'] = 'Error al eliminar el proyecto';
                $_SESSION['tipo_mensaje'] = 'error';
            }
            
            header('Location: index.php?controller=Project&action=index');
            exit();
        }
    }
}