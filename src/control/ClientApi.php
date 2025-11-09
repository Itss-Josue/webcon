<?php
require_once __DIR__ . '/../model/ClientApiModel.php';
require_once __DIR__ . '/../model/ClientModel.php';
class ClientApi {
    private $model, $clientModel;
    public function __construct(){ if(!isset($_SESSION['user_id'])){ header("Location: index.php?route=Auth:login"); exit; } $this->model = new ClientApiModel(); $this->clientModel = new ClientModel(); }
    public function index(){ $apis = $this->model->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/apis/list.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function createForm(){ $clients = $this->clientModel->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/apis/form.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function store(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $d=['client_id'=>$_POST['client_id'],'api_name'=>$_POST['api_name'],'api_key'=>$_POST['api_key'],'status'=>$_POST['status']]; $this->model->create($d); header("Location: index.php?route=ClientApi:index"); }
    public function edit(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $item=$this->model->getById($id); $clients=$this->clientModel->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/apis/form.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function update(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $d=['client_id'=>$_POST['client_id'],'api_name'=>$_POST['api_name'],'api_key'=>$_POST['api_key'],'status'=>$_POST['status']]; $this->model->update($id,$d); header("Location: index.php?route=ClientApi:index"); }
    public function delete(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $this->model->delete($id); header("Location: index.php?route=ClientApi:index"); }
}
