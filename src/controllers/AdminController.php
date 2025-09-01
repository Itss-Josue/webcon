<?php
// controllers/AdminController.php
require_once 'models/Cliente.php';
require_once 'models/Proyecto.php';

class AdminController {
    private $clienteModel;
    private $proyectoModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
        $this->proyectoModel = new Proyecto();
    }

    public function index() {
        $estadisticas = $this->proyectoModel->obtenerEstadisticas();
        $progreso_proyectos = $this->proyectoModel->obtenerProgresoProyectos();
        $total_clientes = count($this->clienteModel->obtenerTodos());
        
        include 'views/admin/index.php';
    }

    public function proyectos() {
        $proyectos = $this->proyectoModel->obtenerTodos();
        include 'views/admin/proyectos.php';
    }

    public function clientes() {
        $clientes = $this->clienteModel->obtenerTodos();
        include 'views/admin/clientes.php';
    }

    public function crearProyecto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'cliente_id' => $_POST['cliente_id'],
                    'tipo_proyecto_id' => $_POST['tipo_proyecto_id'],
                    'nombre' => $_POST['nombre'],
                    'descripcion' => $_POST['descripcion'],
                    'precio' => $_POST['precio'],
                    'fecha_inicio' => $_POST['fecha_inicio'],
                    'fecha_entrega' => $_POST['fecha_entrega'],
                    'caracteristicas' => explode(',', $_POST['caracteristicas'])
                ];
                
                $this->proyectoModel->crear($datos);
                header('Location: index.php?controller=admin&action=proyectos&success=1');
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $clientes = $this->clienteModel->obtenerTodos();
        include 'views/admin/crear_proyecto.php';
    }

    public function editarProyecto() {
        $id = $_GET['id'] ?? 0;
        $proyecto = $this->proyectoModel->obtenerPorId($id);
        
        if (!$proyecto) {
            header('Location: index.php?controller=admin&action=proyectos');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'cliente_id' => $_POST['cliente_id'],
                    'tipo_proyecto_id' => $_POST['tipo_proyecto_id'],
                    'nombre' => $_POST['nombre'],
                    'descripcion' => $_POST['descripcion'],
                    'precio' => $_POST['precio'],
                    'fecha_inicio' => $_POST['fecha_inicio'],
                    'fecha_entrega' => $_POST['fecha_entrega'],
                    'progreso' => $_POST['progreso'],
                    'estado' => $_POST['estado'],
                    'caracteristicas' => explode(',', $_POST['caracteristicas'])
                ];
                
                $this->proyectoModel->actualizar($id, $datos);
                header('Location: index.php?controller=admin&action=proyectos&updated=1');
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        $clientes = $this->clienteModel->obtenerTodos();
        include 'views/admin/editar_proyecto.php';
    }

    public function crearCliente() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $datos = [
                    'dni' => $_POST['dni'],
                    'nombre' => $_POST['nombre'],
                    'telefono' => $_POST['telefono'],
                    'email' => $_POST['email'],
                    'empresa' => $_POST['empresa'],
                    'direccion' => $_POST['direccion']
                ];
                
                $this->clienteModel->crear($datos);
                header('Location: index.php?controller=admin&action=clientes&success=1');
                exit;
            } catch (Exception $e) {
                $error = $e->getMessage();
            }
        }
        
        include 'views/admin/crear_cliente.php';
    }

    public function obtenerDatos() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $tipo = $_GET['tipo'] ?? '';
            
            switch ($tipo) {
                case 'estadisticas':
                    $data = [
                        'proyectos_activos' => $this->proyectoModel->obtenerEstadisticas()['proyectos_activos'],
                        'clientes_total' => count($this->clienteModel->obtenerTodos()),
                        'ingresos_mes' => $this->proyectoModel->obtenerEstadisticas()['ingresos_mes'],
                        'pendientes' => $this->proyectoModel->obtenerEstadisticas()['pendientes']
                    ];
                    break;
                    
                case 'proyectos':
                    $data = $this->proyectoModel->obtenerTodos();
                    break;
                    
                default:
                    $data = ['error' => 'Tipo de datos no válido'];
            }
            
            header('Content-Type: application/json');
            echo json_encode($data);
        }
    }
}
?>