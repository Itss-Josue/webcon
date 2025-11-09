<?php
require_once __DIR__ . '/../model/UserModel.php';
class Auth {
    private $userModel;
    public function __construct(){ $this->userModel = new UserModel(); }
    public function login(){
        // if logged in redirect
        if(isset($_SESSION['user_id'])) header("Location: index.php?route=Dashboard:index");
        include __DIR__ . '/../view/login.php';
    }
    public function doLogin(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') { header("Location: index.php?route=Auth:login"); exit; }
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
        $user = $this->userModel->getByUsername($username);
        if (!$user) {
            $_SESSION['flash_error'] = 'Usuario o contraseña incorrectos';
            header("Location: index.php?route=Auth:login"); exit;
        }
        $ok = false;
        // password verify (supports legacy md5 from dump)
        if (password_verify($password, $user['password'])) $ok = true;
        if (!$ok && strlen($user['password'])==32 && md5($password) === $user['password']) $ok = true;
        if ($ok) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php?route=Dashboard:index"); exit;
        } else {
            $_SESSION['flash_error'] = 'Usuario o contraseña incorrectos';
            header("Location: index.php?route=Auth:login"); exit;
        }
    }
    public function logout(){
        session_unset(); session_destroy(); header("Location: index.php?route=Auth:login"); exit;
    }
}
