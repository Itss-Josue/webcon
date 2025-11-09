<?php
require_once 'BaseModel.php';
class ClientModel extends BaseModel {
    public function getAll() {
        $stmt = $this->db->prepare("SELECT * FROM clients ORDER BY name");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function create($d) {
        $sql = "INSERT INTO clients (name,email,phone,company,address,status) VALUES (?,?,?,?,?,?)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$d['name'],$d['email'],$d['phone'],$d['company'],$d['address'],$d['status']]);
    }
    public function update($id,$d) {
        $sql = "UPDATE clients SET name=?,email=?,phone=?,company=?,address=?,status=? WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$d['name'],$d['email'],$d['phone'],$d['company'],$d['address'],$d['status'],$id]);
    }
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id=?");
        return $stmt->execute([$id]);
    }
}
