<?php
require_once __DIR__ . '/../model/ProjectModel.php';
require_once __DIR__ . '/../model/ClientModel.php';
class Project {
    private $model, $clientModel;
    public function __construct(){ if(!isset($_SESSION['user_id'])){ header("Location: index.php?route=Auth:login"); exit; } $this->model = new ProjectModel(); $this->clientModel = new ClientModel(); }
    public function index(){
        $projects = $this->model->getAll();
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/projects/list.php';
        include __DIR__ . '/../view/layout/footer.php';
    }
    public function createForm(){
        $clients = $this->clientModel->getAll();
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/projects/form.php';
        include __DIR__ . '/../view/layout/footer.php';
    }
    public function store(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $d = ['client_id'=>$_POST['client_id'],'name'=>$_POST['name'],'description'=>$_POST['description'],'start_date'=>$_POST['start_date']?:null,'end_date'=>$_POST['end_date']?:null,'status'=>$_POST['status']];
        $this->model->create($d);
        header("Location: index.php?route=Project:index");
    }
    public function edit(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $id = $_POST['id']; $project = $this->model->getById($id); $clients = $this->clientModel->getAll();
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/projects/form.php';
        include __DIR__ . '/../view/layout/footer.php';
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $id = $_POST['id'];
        $d = ['client_id'=>$_POST['client_id'],'name'=>$_POST['name'],'description'=>$_POST['description'],'start_date'=>$_POST['start_date']?:null,'end_date'=>$_POST['end_date']?:null,'status'=>$_POST['status']];
        $this->model->update($id,$d);
        header("Location: index.php?route=Project:index");
    }
    public function delete(){
        if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed');
        $id = $_POST['id']; $this->model->delete($id);
        header("Location: index.php?route=Project:index");
    }
}
