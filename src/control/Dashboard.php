<?php
require_once __DIR__ . '/../model/ClientModel.php';
require_once __DIR__ . '/../model/ProjectModel.php';
require_once __DIR__ . '/../model/PaymentModel.php';
require_once __DIR__ . '/../model/CountRequestModel.php';
class Dashboard {
    private $clientModel, $projectModel, $paymentModel, $countModel;
    public function __construct(){
        if(!isset($_SESSION['user_id'])){ header("Location: index.php?route=Auth:login"); exit; }
        $this->clientModel = new ClientModel();
        $this->projectModel = new ProjectModel();
        $this->paymentModel = new PaymentModel();
        $this->countModel = new CountRequestModel();
    }
    public function index(){
        $totalClients = count($this->clientModel->getAll());
        $totalProjects = count($this->projectModel->getAll());
        $payments = $this->paymentModel->getAll();
        $totalPayments = 0;
        foreach($payments as $p) $totalPayments += (float)$p['amount'];
        $totalRequests = count($this->countModel->getAll());
        $recentProjects = array_slice($this->projectModel->getAll(), 0, 8);
        include __DIR__ . '/../view/layout/header.php';
        include __DIR__ . '/../view/dashboard.php';
        include __DIR__ . '/../view/layout/footer.php';
    }
}
