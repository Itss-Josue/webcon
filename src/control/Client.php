<?php
require_once __DIR__ . '/../model/ClientModel.php';
class Client {
    private $model;
    public function __construct(){ if(!isset($_SESSION['user_id'])){ header("Location: index.php?route=Auth:login"); exit; } $this->model = new ClientModel(); }
    public function index(){
        $clients = $this->model->getAll();
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/clients/list.php';
        include __DIR__ . '/../view/layout/footer.php';
    }
    public function createForm(){ include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/clients/form.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function store(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $d = [
            'name'=>$_POST['name'] ?? '',
            'email'=>$_POST['email'] ?? '',
            'phone'=>$_POST['phone'] ?? '',
            'company'=>$_POST['company'] ?? '',
            'address'=>$_POST['address'] ?? '',
            'status'=>$_POST['status'] ?? 'Activo'
        ];
        $this->model->create($d);
        header("Location: index.php?route=Client:index");
    }
    public function edit(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $id = $_POST['id'] ?? null; if(!$id) die('ID requerido');
        $client = $this->model->getById($id);
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/clients/form.php';
        include __DIR__ . '/../view/layout/footer.php';
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $id = $_POST['id'];
        $d = ['name'=>$_POST['name'],'email'=>$_POST['email'],'phone'=>$_POST['phone'],'company'=>$_POST['company'],'address'=>$_POST['address'],'status'=>$_POST['status']];
        $this->model->update($id,$d);
        header("Location: index.php?route=Client:index");
    }
    public function delete(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $id = $_POST['id']; $this->model->delete($id);
        header("Location: index.php?route=Client:index");
    }
}

