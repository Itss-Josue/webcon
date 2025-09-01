<?php
// controllers/ClienteController.php
require_once 'models/Cliente.php';
require_once 'models/Proyecto.php';

class ClienteController {
    private $clienteModel;
    private $proyectoModel;

    public function __construct() {
        $this->clienteModel = new Cliente();
        $this->proyectoModel = new Proyecto();
    }

    public function index() {
        include 'views/cliente/index.php';
    }

    public function buscar() {
        $respuesta = ['success' => false, 'data' => null, 'message' => ''];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tipo = $_POST['tipo'] ?? '';
            $query = trim($_POST['query'] ?? '');
            
            if (empty($query)) {
                $respuesta['message'] = 'Por favor ingrese un criterio de búsqueda';
            } else {
                try {
                    if ($tipo === 'dni') {
                        $resultados = $this->clienteModel->buscarPorDni($query);
                    } else {
                        $resultados = $this->clienteModel->buscarPorNombre($query);
                    }
                    
                    if (!empty($resultados)) {
                        $cliente = $this->formatearResultadoCliente($resultados);
                        $respuesta['success'] = true;
                        $respuesta['data'] = $cliente;
                    } else {
                        $respuesta['message'] = 'No se encontraron resultados';
                    }
                } catch (Exception $e) {
                    $respuesta['message'] = 'Error en la búsqueda: ' . $e->getMessage();
                }
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode($respuesta);
    }

    private function formatearResultadoCliente($resultados) {
        if (empty($resultados)) return null;
        
        $cliente = [
            'id' => $resultados[0]['id'],
            'dni' => $resultados[0]['dni'],
            'nombre' => $resultados[0]['nombre'],
            'telefono' => $resultados[0]['telefono'],
            'email' => $resultados[0]['email'],
            'empresa' => $resultados[0]['empresa'],
            'direccion' => $resultados[0]['direccion'],
            'proyectos' => []
        ];
        
        foreach ($resultados as $row) {
            if (!empty($row['proyecto_id'])) {
                $caracteristicas = json_decode($row['caracteristicas'], true) ?? [];
                $cliente['proyectos'][] = [
                    'id' => $row['proyecto_id'],
                    'nombre' => $row['proyecto_nombre'],
                    'tipo' => $row['tipo_proyecto'],
                    'descripcion' => $row['proyecto_descripcion'],
                    'precio' => $row['precio'],
                    'fecha_inicio' => $row['fecha_inicio'],
                    'fecha_entrega' => $row['fecha_entrega'],
                    'progreso' => $row['progreso'],
                    'estado' => $row['proyecto_estado'],
                    'caracteristicas' => $caracteristicas
                ];
            }
        }
        
        return $cliente;
    }
}
?>