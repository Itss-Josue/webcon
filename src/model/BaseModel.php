<?php
require_once __DIR__ . '/../config/config.php';
class BaseModel {
    protected $db;
    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
    }
}
