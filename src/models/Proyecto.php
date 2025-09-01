<?php
// models/Proyecto.php
require_once 'config/Database.php';

class Proyecto {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerTodos() {
        $sql = "SELECT p.*, c.nombre as cliente_nombre, c.dni, tp.nombre as tipo_proyecto_nombre,
                       COALESCE(SUM(pg.monto), 0) as total_pagado,
                       (p.precio - COALESCE(SUM(pg.monto), 0)) as saldo_pendiente
                FROM proyectos p 
                INNER JOIN clientes c ON p.cliente_id = c.id 
                INNER JOIN tipos_proyecto tp ON p.tipo_proyecto_id = tp.id
                LEFT JOIN pagos pg ON p.id = pg.proyecto_id
                GROUP BY p.id 
                ORDER BY p.fecha_creacion DESC";
        return $this->db->fetchAll($sql);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT p.*, c.nombre as cliente_nombre, c.dni, tp.nombre as tipo_proyecto_nombre 
                FROM proyectos p 
                INNER JOIN clientes c ON p.cliente_id = c.id 
                INNER JOIN tipos_proyecto tp ON p.tipo_proyecto_id = tp.id
                WHERE p.id = ?";
        return $this->db->fetch($sql, [$id]);
    }

    public function crear($datos) {
        $sql = "INSERT INTO proyectos (cliente_id, tipo_proyecto_id, nombre, descripcion, precio, fecha_inicio, fecha_entrega, caracteristicas) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $caracteristicas = json_encode($datos['caracteristicas']);
        $params = [
            $datos['cliente_id'], $datos['tipo_proyecto_id'], $datos['nombre'], 
            $datos['descripcion'], $datos['precio'], $datos['fecha_inicio'], 
            $datos['fecha_entrega'], $caracteristicas
        ];
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }

    public function actualizar($id, $datos) {
        $sql = "UPDATE proyectos SET cliente_id = ?, tipo_proyecto_id = ?, nombre = ?, descripcion = ?, 
                precio = ?, fecha_inicio = ?, fecha_entrega = ?, progreso = ?, estado = ?, caracteristicas = ?
                WHERE id = ?";
        $caracteristicas = json_encode($datos['caracteristicas']);
        $params = [
            $datos['cliente_id'], $datos['tipo_proyecto_id'], $datos['nombre'], 
            $datos['descripcion'], $datos['precio'], $datos['fecha_inicio'], 
            $datos['fecha_entrega'], $datos['progreso'], $datos['estado'], 
            $caracteristicas, $id
        ];
        return $this->db->query($sql, $params);
    }

    public function eliminar($id) {
        $sql = "UPDATE proyectos SET estado = 'cancelado' WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }

    public function obtenerEstadisticas() {
        $stats = [];
        
        // Total proyectos activos
        $sql = "SELECT COUNT(*) as total FROM proyectos WHERE estado != 'cancelado'";
        $stats['proyectos_activos'] = $this->db->fetch($sql)['total'];
        
        // Proyectos completados este mes
        $sql = "SELECT COUNT(*) as total FROM proyectos WHERE estado = 'completado' AND MONTH(fecha_entrega) = MONTH(CURRENT_DATE) AND YEAR(fecha_entrega) = YEAR(CURRENT_DATE)";
        $stats['completados_mes'] = $this->db->fetch($sql)['total'];
        
        // Proyectos pendientes
        $sql = "SELECT COUNT(*) as total FROM proyectos WHERE estado = 'pendiente'";
        $stats['pendientes'] = $this->db->fetch($sql)['total'];
        
        // Ingresos este mes
        $sql = "SELECT COALESCE(SUM(p.monto), 0) as total 
                FROM pagos p 
                WHERE MONTH(p.fecha_pago) = MONTH(CURRENT_DATE) AND YEAR(p.fecha_pago) = YEAR(CURRENT_DATE)";
        $stats['ingresos_mes'] = $this->db->fetch($sql)['total'];
        
        return $stats;
    }

    public function obtenerProgresoProyectos() {
        $sql = "SELECT p.id, p.nombre, c.nombre as cliente_nombre, p.progreso, p.estado
                FROM proyectos p 
                INNER JOIN clientes c ON p.cliente_id = c.id 
                WHERE p.estado IN ('en_progreso', 'pendiente') 
                ORDER BY p.progreso DESC LIMIT 5";
        return $this->db->fetchAll($sql);
    }
}
?>