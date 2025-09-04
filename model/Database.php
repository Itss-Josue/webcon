<?php
// model/Database.php
class Database {
    private $host;
    private $user;
    private $password;
    private $database;
    private $conn;
    
    public function __construct() {
        $this->host = DB_HOST;
        $this->user = DB_USER;
        $this->password = DB_PASS;
        $this->database = DB_NAME;
        
        $this->connect();
    }
    
    private function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->database);
        
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
        
        $this->conn->set_charset("utf8");
    }
    
    public function query($sql) {
        return $this->conn->query($sql);
    }
    
    public function escape($value) {
        return $this->conn->real_escape_string($value);
    }
    
    public function getInsertId() {
        return $this->conn->insert_id;
    }
    
    public function close() {
        $this->conn->close();
    }
}