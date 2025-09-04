<?php
// model/ProjectModel.php
require_once 'Database.php';

class ProjectModel {
    private $db;
    
    public function __construct() {
        $this->db = new Database();
    }
    
    public function getTotalProyectos() {
        $sql = "SELECT COUNT(*) as total FROM proyectos";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['total'];
    }
    
    public function getProyectosActivos() {
        $sql = "SELECT COUNT(*) as activos FROM proyectos WHERE estado = 'activo'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['activos'];
    }
    
    public function getProyectosPendientes() {
        $sql = "SELECT COUNT(*) as pendientes FROM proyectos WHERE estado = 'pendiente'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc()['pendientes'];
    }
    
    public function getProyectosProgreso() {
        $sql = "SELECT nombre, progreso FROM proyectos WHERE estado = 'activo' ORDER BY progreso DESC LIMIT 5";
        $result = $this->db->query($sql);
        
        $proyectos = [];
        while ($row = $result->fetch_assoc()) {
            $proyectos[] = $row;
        }
        
        return $proyectos;
    }
    
    public function getAllProyectos() {
        $sql = "SELECT p.*, c.nombre as cliente_nombre 
                FROM proyectos p 
                LEFT JOIN clientes c ON p.cliente_id = c.id 
                ORDER BY p.fecha_creacion DESC";
        $result = $this->db->query($sql);
        
        $proyectos = [];
        while ($row = $result->fetch_assoc()) {
            $proyectos[] = $row;
        }
        
        return $proyectos;
    }
    
    public function getProyectoById($id) {
        $id = $this->db->escape($id);
        $sql = "SELECT p.*, c.nombre as cliente_nombre, c.empresa 
                FROM proyectos p 
                LEFT JOIN clientes c ON p.cliente_id = c.id 
                WHERE p.id = '$id'";
        $result = $this->db->query($sql);
        return $result->fetch_assoc();
    }
    
    public function crearProyecto($datos) {
        $nombre = $this->db->escape($datos['nombre']);
        $cliente_id = $this->db->escape($datos['cliente_id']);
        $tipo = $this->db->escape($datos['tipo']);
        $progreso = $this->db->escape($datos['progreso']);
        $estado = $this->db->escape($datos['estado']);
        $fecha_entrega = $this->db->escape($datos['fecha_entrega']);
        
        $sql = "INSERT INTO proyectos (nombre, cliente_id, tipo, progreso, estado, fecha_entrega) 
                VALUES ('$nombre', '$cliente_id', '$tipo', '$progreso', '$estado', '$fecha_entrega')";
        
        return $this->db->query($sql);
    }
    
    public function actualizarProyecto($id, $datos) {
        $id = $this->db->escape($id);
        $nombre = $this->db->escape($datos['nombre']);
        $progreso = $this->db->escape($datos['progreso']);
        $estado = $this->db->escape($datos['estado']);
        $fecha_entrega = $this->db->escape($datos['fecha_entrega']);
        
        $sql = "UPDATE proyectos 
                SET nombre = '$nombre', progreso = '$progreso', estado = '$estado', fecha_entrega = '$fecha_entrega' 
                WHERE id = '$id'";
        
        return $this->db->query($sql);
    }
    
    public function eliminarProyecto($id) {
        $id = $this->db->escape($id);
        $sql = "DELETE FROM proyectos WHERE id = '$id'";
        return $this->db->query($sql);
    }
}