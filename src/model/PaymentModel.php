<?php
require_once 'BaseModel.php';
class PaymentModel extends BaseModel {
    public function getAll(){
        $sql = "SELECT pay.*, p.name AS project_name, c.name AS client_name 
                FROM payments pay 
                JOIN projects p ON pay.project_id = p.id 
                JOIN clients c ON p.client_id = c.id
                ORDER BY pay.payment_date DESC";
        $stmt = $this->db->prepare($sql); $stmt->execute(); return $stmt->fetchAll();
    }
    public function getById($id){ $stmt=$this->db->prepare("SELECT * FROM payments WHERE id=?"); $stmt->execute([$id]); return $stmt->fetch(); }
    public function create($d){ $stmt=$this->db->prepare("INSERT INTO payments (project_id,amount,method,payment_date,note) VALUES (?,?,?,?,?)"); return $stmt->execute([$d['project_id'],$d['amount'],$d['method'],$d['payment_date'],$d['note']]); }
    public function update($id,$d){ $stmt=$this->db->prepare("UPDATE payments SET project_id=?,amount=?,method=?,payment_date=?,note=? WHERE id=?"); return $stmt->execute([$d['project_id'],$d['amount'],$d['method'],$d['payment_date'],$d['note'],$id]); }
    public function delete($id){ $stmt=$this->db->prepare("DELETE FROM payments WHERE id=?"); return $stmt->execute([$id]); }
}
