<?php
require_once __DIR__ . '/../model/PaymentModel.php';
require_once __DIR__ . '/../model/ProjectModel.php';
class Payment {
    private $model, $projectModel;
    public function __construct(){ if(!isset($_SESSION['user_id'])){ header("Location: index.php?route=Auth:login"); exit; } $this->model = new PaymentModel(); $this->projectModel = new ProjectModel(); }
    public function index(){ $payments = $this->model->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/payments/list.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function createForm(){ $projects = $this->projectModel->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/payments/form.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function store(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $d=['project_id'=>$_POST['project_id'],'amount'=>$_POST['amount'],'method'=>$_POST['method'],'payment_date'=>$_POST['payment_date'],'note'=>$_POST['note']]; $this->model->create($d); header("Location: index.php?route=Payment:index"); }
    public function edit(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $payment=$this->model->getById($id); $projects=$this->projectModel->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/payments/form.php'; include __DIR__ . '/../view/layout/footer.php'; }
    public function update(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $d=['project_id'=>$_POST['project_id'],'amount'=>$_POST['amount'],'method'=>$_POST['method'],'payment_date'=>$_POST['payment_date'],'note'=>$_POST['note']]; $this->model->update($id,$d); header("Location: index.php?route=Payment:index"); }
    public function delete(){ if($_SERVER['REQUEST_METHOD']!=='POST') die('Method not allowed'); $id=$_POST['id']; $this->model->delete($id); header("Location: index.php?route=Payment:index"); }
}
