<?php
require_once 'BaseModel.php';
class UserModel extends BaseModel {
    public function getByUsername($username){ $stmt=$this->db->prepare("SELECT * FROM users WHERE username=?"); $stmt->execute([$username]); return $stmt->fetch(); }
    public function getById($id){ $stmt=$this->db->prepare("SELECT * FROM users WHERE id=?"); $stmt->execute([$id]); return $stmt->fetch(); }
    public function create($d){ $stmt=$this->db->prepare("INSERT INTO users (username,password,name,role) VALUES (?,?,?,?)"); $hash = password_hash($d['password'], PASSWORD_DEFAULT); return $stmt->execute([$d['username'],$hash,$d['name'],$d['role']]); }
    public function getAll(){ $stmt=$this->db->query("SELECT * FROM users ORDER BY created_at DESC"); return $stmt->fetchAll(); }
    public function update($id,$d){ if(!empty($d['password'])){ $stmt=$this->db->prepare("UPDATE users SET username=?,password=?,name=?,role=? WHERE id=?"); $hash=password_hash($d['password'],PASSWORD_DEFAULT); return $stmt->execute([$d['username'],$hash,$d['name'],$d['role'],$id]); } else { $stmt=$this->db->prepare("UPDATE users SET username=?,name=?,role=? WHERE id=?"); return $stmt->execute([$d['username'],$d['name'],$d['role'],$id]); } }
    public function delete($id){ $stmt=$this->db->prepare("DELETE FROM users WHERE id=?"); return $stmt->execute([$id]); }
    public function createIfNotExistsAdmin($username,$password,$name){
        $user = $this->getByUsername($username);
        if (!$user){
            $this->create(['username'=>$username,'password'=>$password,'name'=>$name,'role'=>'admin']);
        }
    }
}
