<?php
require_once __DIR__ . '/../models/ApiBuscar.php';

class ApiBuscarController {
    private $model;

    public function __construct($pdo) {
        $this->model = new ApiBuscar($pdo);
    }

    // Endpoint principal de búsqueda
    public function index() {
        header('Content-Type: application/json; charset=utf-8');
        
        echo json_encode([
            'mensaje' => 'Sistema de búsqueda de clientes WebCon',
            'endpoints_disponibles' => [
                'GET /buscar/cliente/{dni|nombre|empresa}' => 'Buscar cliente por DNI, nombre o empresa',
                'GET /buscar/cliente/{id}/completo' => 'Obtener información completa del cliente'
            ],
            'ejemplos' => [
                '/buscar/cliente/74322487',
                '/buscar/cliente/Josue',
                '/buscar/cliente/Xteams',
                '/buscar/cliente/1/completo'
            ]
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    // Buscar cliente por DNI, nombre o empresa
    public function cliente($parametro) {
        header('Content-Type: application/json; charset=utf-8');
        
        if (empty($parametro)) {
            http_response_code(400);
            echo json_encode([
                'error' => true,
                'mensaje' => 'Parámetro de búsqueda requerido. Ej: /buscar/cliente/74322487'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        // Verificar si es búsqueda completa por ID
        if (strpos($parametro, '/completo') !== false) {
            $id = intval(str_replace('/completo', '', $parametro));
            if ($id > 0) {
                $this->clienteCompleto($id);
                return;
            }
        }

        // Búsqueda normal por DNI, nombre o empresa
        $resultados = $this->model->buscarCliente($parametro);
        
        if (!empty($resultados)) {
            echo json_encode([
                'error' => false,
                'busqueda' => $parametro,
                'total_resultados' => count($resultados),
                'resultados' => $resultados
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode([
                'error' => true,
                'busqueda' => $parametro,
                'total_resultados' => 0,
                'resultados' => [],
                'mensaje' => 'No se encontraron clientes con ese criterio de búsqueda'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    // Obtener información completa del cliente
    private function clienteCompleto($id) {
        $clienteCompleto = $this->model->obtenerClienteCompleto($id);
        
        if ($clienteCompleto) {
            echo json_encode([
                'error' => false,
                'cliente' => $clienteCompleto['cliente'],
                'proyectos' => $clienteCompleto['proyectos'],
                'pagos' => $clienteCompleto['pagos'],
                'estadisticas' => $clienteCompleto['estadisticas']
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(404);
            echo json_encode([
                'error' => true,
                'mensaje' => 'Cliente no encontrado'
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }
}
?>