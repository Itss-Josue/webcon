<?php
class BaseController {
    protected $db;
    
    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }
    
    protected function sendResponse($data, $statusCode = 200) {
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
    
    protected function getRequestBody() {
        return json_decode(file_get_contents('php://input'), true);
    }
}
?>