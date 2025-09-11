<?php
class Admin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Validar login con SHA-256
    public function login($username, $password) {
        $hashed = hash('sha256', $password);
        $sql = "SELECT * FROM users WHERE username = :username AND password = :password LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
