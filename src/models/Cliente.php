<?php
// models/Cliente.php
require_once 'config/Database.php';

class Cliente {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function obtenerTodos() {
        $sql = "SELECT c.*, COUNT(p.id) as total_proyectos 
                FROM clientes c 
                LEFT JOIN proyectos p ON c.id = p.cliente_id 
                WHERE c.estado = 'activo' 
                GROUP BY c.id 
                ORDER BY c.nombre";
        return $this->db->fetchAll($sql);
    }

    public function buscarPorDni($dni) {
        $sql = "SELECT c.*, 
                       p.id as proyecto_id, p.nombre as proyecto_nombre, p.descripcion as proyecto_descripcion,
                       p.precio, p.fecha_inicio, p.fecha_entrega, p.progreso, p.estado as proyecto_estado,
                       p.caracteristicas, tp.nombre as tipo_proyecto
                FROM clientes c
                LEFT JOIN proyectos p ON c.id = p.cliente_id
                LEFT JOIN tipos_proyecto tp ON p.tipo_proyecto_id = tp.id
                WHERE c.dni = ? AND c.estado = 'activo'";
        return $this->db->fetchAll($sql, [$dni]);
    }

    public function buscarPorNombre($nombre) {
        $sql = "SELECT c.*, 
                       p.id as proyecto_id, p.nombre as proyecto_nombre, p.descripcion as proyecto_descripcion,
                       p.precio, p.fecha_inicio, p.fecha_entrega, p.progreso, p.estado as proyecto_estado,
                       p.caracteristicas, tp.nombre as tipo_proyecto
                FROM clientes c
                LEFT JOIN proyectos p ON c.id = p.cliente_id
                LEFT JOIN tipos_proyecto tp ON p.tipo_proyecto_id = tp.id
                WHERE c.nombre LIKE ? AND c.estado = 'activo'";
        return $this->db->fetchAll($sql, ["%$nombre%"]);
    }

    public function crear($datos) {
        $sql = "INSERT INTO clientes (dni, nombre, telefono, email, empresa, direccion) 
                VALUES (?, ?, ?, ?, ?, ?)";
        $params = [
            $datos['dni'], $datos['nombre'], $datos['telefono'], 
            $datos['email'], $datos['empresa'], $datos['direccion']
        ];
        $this->db->query($sql, $params);
        return $this->db->lastInsertId();
    }

    public function actualizar($id, $datos) {
        $sql = "UPDATE clientes SET dni = ?, nombre = ?, telefono = ?, email = ?, empresa = ?, direccion = ? 
                WHERE id = ?";
        $params = [
            $datos['dni'], $datos['nombre'], $datos['telefono'], 
            $datos['email'], $datos['empresa'], $datos['direccion'], $id
        ];
        return $this->db->query($sql, $params);
    }

    public function obtenerPorId($id) {
        $sql = "SELECT * FROM clientes WHERE id = ? AND estado = 'activo'";
        return $this->db->fetch($sql, [$id]);
    }

    public function eliminar($id) {
        $sql = "UPDATE clientes SET estado = 'inactivo' WHERE id = ?";
        return $this->db->query($sql, [$id]);
    }
}
?>