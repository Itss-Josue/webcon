<?php
require_once 'BaseModel.php';
class ClientApiModel extends BaseModel {
    public function getAll(){
        $sql = "SELECT ca.*, c.name AS client_name FROM client_api ca JOIN clients c ON ca.client_id = c.id ORDER BY ca.id DESC";
        $stmt = $this->db->prepare($sql); $stmt->execute(); return $stmt->fetchAll();
    }
    public function getById($id){ $stmt = $this->db->prepare("SELECT * FROM client_api WHERE id=?"); $stmt->execute([$id]); return $stmt->fetch(); }
    public function create($d){ $stmt = $this->db->prepare("INSERT INTO client_api (client_id,api_name,api_key,status) VALUES (?,?,?,?)"); return $stmt->execute([$d['client_id'],$d['api_name'],$d['api_key'],$d['status']]); }
    public function update($id,$d){ $stmt=$this->db->prepare("UPDATE client_api SET client_id=?,api_name=?,api_key=?,status=? WHERE id=?"); return $stmt->execute([$d['client_id'],$d['api_name'],$d['api_key'],$d['status'],$id]); }
    public function delete($id){ $stmt = $this->db->prepare("DELETE FROM client_api WHERE id=?"); return $stmt->execute([$id]); }
}
