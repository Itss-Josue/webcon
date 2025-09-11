<?php
class AuthController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Mostrar formulario login
    public function login() {
        include "app/views/auth/login.php";
    }

    // Procesar login
    // Procesar login
public function doLogin() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST['usuario'];
        $password = hash('sha256', $_POST['password']); // SHA-256 👈

        $sql = "SELECT * FROM users WHERE username = :usuario AND password = :password LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":password", $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['admin'] = $stmt->fetch(PDO::FETCH_ASSOC);
            header("Location: /webcon/admin/dashboard");
            exit;
        } else {
            $error = "Usuario o contraseña incorrectos";
            include "app/views/auth/login.php";
        }
    }
}


    // Cerrar sesión
    public function logout() {
        session_destroy();
        header("Location: /webcon/auth/login");
        exit;
    }
}
