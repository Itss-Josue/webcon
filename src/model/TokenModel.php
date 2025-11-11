<?php
require_once 'BaseModel.php';

class TokenModel extends BaseModel {

    public function getAll() {
        $sql = "SELECT t.*, c.name AS client_name 
                FROM tokens t
                LEFT JOIN clients c ON c.id = t.client_id
                ORDER BY t.created_at DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function create($d) {
        $sql = "INSERT INTO tokens (client_id, token, expires_at, status, created_at)
                VALUES (?, ?, ?, ?, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$d['client_id'], $d['token'], $d['expires_at'], $d['status']]);
    }

    public function update($id, $d) {
        $sql = "UPDATE tokens 
                SET token=?, expires_at=?, status=?, updated_at=NOW() 
                WHERE id=?";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([$d['token'], $d['expires_at'], $d['status'], $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM tokens WHERE id=?");
        return $stmt->execute([$id]);
    }

    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM tokens WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    public function getByToken($token) {
    $stmt = $this->db->prepare("SELECT t.*, c.name AS client_name 
                                FROM tokens t 
                                LEFT JOIN clients c ON c.id = t.client_id 
                                WHERE t.token = ?");
    $stmt->execute([$token]);
    return $stmt->fetch();
}

}
