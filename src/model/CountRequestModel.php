<?php
require_once 'BaseModel.php';
class CountRequestModel extends BaseModel {
    public function getAll(){ $sql="SELECT r.*, t.token AS api_token FROM count_request r JOIN tokens_api t ON r.token_id = t.id ORDER BY r.request_date DESC"; $stmt=$this->db->prepare($sql); $stmt->execute(); return $stmt->fetchAll(); }
    public function create($d){ $stmt=$this->db->prepare("INSERT INTO count_request (token_id,endpoint,response_code) VALUES (?,?,?)"); return $stmt->execute([$d['token_id'],$d['endpoint'],$d['response_code']]); }
}
