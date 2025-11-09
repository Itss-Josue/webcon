<?php
require_once __DIR__ . '/../model/UserModel.php';
class User {
    private $model;
    public function __construct(){ if(!isset($_SESSION['user_id'])){ header("Location: index.php?route=Auth:login"); exit; } $this->model = new UserModel(); }
    public function index(){ $users = $this->model->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/users/list.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function createForm(){ include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/users/form.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function store(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $d=['username'=>$_POST['username'],'password'=>$_POST['password'],'name'=>$_POST['name'],'role'=>$_POST['role']]; $this->model->create($d); header("Location: index.php?route=User:index"); }
    public function edit(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $user=$this->model->getById($id); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/users/form.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function update(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $d=['username'=>$_POST['username'],'password'=>$_POST['password']??'','name'=>$_POST['name'],'role'=>$_POST['role']]; $this->model->update($id,$d); header("Location: index.php?route=User:index"); }
    public function delete(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $this->model->delete($id); header("Location: index.php?route=User:index"); }
}
