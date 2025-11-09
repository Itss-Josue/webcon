<?php
require_once 'BaseModel.php';
class ProjectModel extends BaseModel {
    public function getAll() {
        $sql = "SELECT p.*, c.name AS client_name FROM projects p JOIN clients c ON p.client_id = c.id ORDER BY p.created_at DESC";
        $stmt = $this->db->prepare($sql); $stmt->execute(); return $stmt->fetchAll();
    }
    public function getById($id){ $stmt=$this->db->prepare("SELECT * FROM projects WHERE id=?"); $stmt->execute([$id]); return $stmt->fetch(); }
    public function create($d){ $stmt=$this->db->prepare("INSERT INTO projects (client_id,name,description,start_date,end_date,status) VALUES (?,?,?,?,?,?)"); return $stmt->execute([$d['client_id'],$d['name'],$d['description'],$d['start_date'],$d['end_date'],$d['status']]); }
    public function update($id,$d){ $stmt=$this->db->prepare("UPDATE projects SET client_id=?,name=?,description=?,start_date=?,end_date=?,status=? WHERE id=?"); return $stmt->execute([$d['client_id'],$d['name'],$d['description'],$d['start_date'],$d['end_date'],$d['status'],$id]); }
    public function delete($id){ $stmt=$this->db->prepare("DELETE FROM projects WHERE id=?"); return $stmt->execute([$id]); }
}
