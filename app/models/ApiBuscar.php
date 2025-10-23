<?php
class ApiBuscar {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Buscar cliente por DNI, nombre o empresa
    public function buscarCliente($parametro) {
        try {
            $sql = "
                SELECT 
                    c.id,
                    c.dni,
                    c.name as nombre_completo,
                    c.company as empresa,
                    c.phone as telefono,
                    c.email as correo,
                    DATE(c.created_at) as fecha_registro,
                    (SELECT COUNT(*) FROM projects p WHERE p.client_id = c.id) as total_proyectos,
                    (SELECT COUNT(*) FROM payments py WHERE py.client_id = c.id) as total_pagos,
                    (SELECT SUM(amount) FROM payments WHERE client_id = c.id) as total_invertido
                FROM clients c 
                WHERE c.dni LIKE ? OR c.name LIKE ? OR c.company LIKE ? OR c.email LIKE ?
                ORDER BY c.created_at DESC
                LIMIT 20
            ";
            
            $stmt = $this->pdo->prepare($sql);
            $parametroBusqueda = "%$parametro%";
            $stmt->execute([$parametroBusqueda, $parametroBusqueda, $parametroBusqueda, $parametroBusqueda]);
            
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Formatear los resultados
            foreach ($resultados as &$resultado) {
                $resultado['total_invertido'] = floatval($resultado['total_invertido'] ?? 0);
                $resultado['enlace_completo'] = "/buscar/cliente/{$resultado['id']}/completo";
            }
            
            return $resultados;
        } catch (Exception $e) {
            error_log("Error en ApiBuscar::buscarCliente(): " . $e->getMessage());
            return [];
        }
    }

    // Obtener información completa del cliente
    public function obtenerClienteCompleto($id) {
        try {
            // Información básica del cliente
            $stmt = $this->pdo->prepare("
                SELECT 
                    id,
                    dni,
                    name as nombre_completo,
                    company as empresa,
                    phone as telefono,
                    email as correo,
                    DATE(created_at) as fecha_registro
                FROM clients 
                WHERE id = ?
            ");
            $stmt->execute([$id]);
            $cliente = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$cliente) {
                return null;
            }

            // Proyectos del cliente
            $stmt = $this->pdo->prepare("
                SELECT 
                    p.id,
                    p.name as nombre_proyecto,
                    p.type as tipo,
                    p.progress as progreso,
                    p.status as estado,
                    p.delivery_date as fecha_entrega,
                    p.total_price as precio_total,
                    p.created_at as fecha_creacion,
                    (SELECT SUM(amount) FROM payments WHERE project_id = p.id) as total_pagado,
                    (SELECT COUNT(*) FROM payments WHERE project_id = p.id) as cantidad_pagos
                FROM projects p 
                WHERE p.client_id = ? 
                ORDER BY 
                    CASE p.status 
                        WHEN 'active' THEN 1
                        WHEN 'pending' THEN 2
                        WHEN 'completed' THEN 3
                        ELSE 4
                    END,
                    p.created_at DESC
            ");
            $stmt->execute([$id]);
            $proyectos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatear proyectos
            foreach ($proyectos as &$proyecto) {
                $proyecto['precio_total'] = floatval($proyecto['precio_total'] ?? 0);
                $proyecto['total_pagado'] = floatval($proyecto['total_pagado'] ?? 0);
                $proyecto['progreso'] = intval($proyecto['progreso'] ?? 0);
                $proyecto['fecha_creacion'] = date('Y-m-d', strtotime($proyecto['fecha_creacion']));
                
                // Calcular porcentaje pagado
                if ($proyecto['precio_total'] > 0) {
                    $proyecto['porcentaje_pagado'] = round(($proyecto['total_pagado'] / $proyecto['precio_total']) * 100, 2);
                } else {
                    $proyecto['porcentaje_pagado'] = 0;
                }
            }

            // Pagos del cliente
            $stmt = $this->pdo->prepare("
                SELECT 
                    py.id,
                    py.amount as monto,
                    py.paid_at as fecha_pago,
                    py.method as metodo_pago,
                    py.note as observacion,
                    p.name as proyecto_nombre,
                    py.created_at as fecha_registro
                FROM payments py 
                JOIN projects p ON py.project_id = p.id 
                WHERE py.client_id = ? 
                ORDER BY py.paid_at DESC
            ");
            $stmt->execute([$id]);
            $pagos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Formatear pagos
            foreach ($pagos as &$pago) {
                $pago['monto'] = floatval($pago['monto'] ?? 0);
                $pago['fecha_pago'] = $pago['fecha_pago'] ? date('Y-m-d', strtotime($pago['fecha_pago'])) : null;
                $pago['fecha_registro'] = date('Y-m-d', strtotime($pago['fecha_registro']));
            }

            // Estadísticas generales
            $estadisticas = $this->calcularEstadisticas($id, $proyectos, $pagos);

            return [
                'cliente' => $cliente,
                'proyectos' => $proyectos,
                'pagos' => $pagos,
                'estadisticas' => $estadisticas
            ];
        } catch (Exception $e) {
            error_log("Error en ApiBuscar::obtenerClienteCompleto(): " . $e->getMessage());
            return null;
        }
    }

    // Calcular estadísticas del cliente
    private function calcularEstadisticas($clienteId, $proyectos, $pagos) {
        $totalProyectos = count($proyectos);
        $totalPagos = count($pagos);
        $montoTotalPagado = 0;
        $montoTotalProyectos = 0;
        $proyectosActivos = 0;
        $proyectosCompletados = 0;
        $proyectosPendientes = 0;

        foreach ($proyectos as $proyecto) {
            $montoTotalProyectos += floatval($proyecto['precio_total']);
            
            switch ($proyecto['estado']) {
                case 'active':
                    $proyectosActivos++;
                    break;
                case 'completed':
                    $proyectosCompletados++;
                    break;
                case 'pending':
                    $proyectosPendientes++;
                    break;
            }
        }

        foreach ($pagos as $pago) {
            $montoTotalPagado += floatval($pago['monto']);
        }

        $progresoPromedio = 0;
        if ($totalProyectos > 0) {
            $progresoPromedio = round(array_sum(array_column($proyectos, 'progreso')) / $totalProyectos, 2);
        }

        return [
            'total_proyectos' => $totalProyectos,
            'proyectos_activos' => $proyectosActivos,
            'proyectos_completados' => $proyectosCompletados,
            'proyectos_pendientes' => $proyectosPendientes,
            'total_pagos' => $totalPagos,
            'monto_total_proyectos' => $montoTotalProyectos,
            'monto_total_pagado' => $montoTotalPagado,
            'porcentaje_pagado' => $montoTotalProyectos > 0 ? round(($montoTotalPagado / $montoTotalProyectos) * 100, 2) : 0,
            'progreso_promedio' => $progresoPromedio,
            'saldo_pendiente' => $montoTotalProyectos - $montoTotalPagado
        ];
    }
}
?>