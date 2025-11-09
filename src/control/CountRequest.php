<?php
require_once __DIR__ . '/../model/CountRequestModel.php';
require_once __DIR__ . '/../model/TokenModel.php';
class CountRequest {
    private $model, $tokenModel;
    public function __construct(){ if(!isset($_SESSION['user_id'])){ header("Location: index.php?route=Auth:login"); exit; } $this->model = new CountRequestModel(); $this->tokenModel = new TokenModel(); }
    public function index(){ $requests = $this->model->getAll(); include __DIR__ . '/../view/layout/header.php'; include __DIR__ . '/../view/requests/list.php'; include __DIR__ . '/../view/layout/footer.php'; }
    // store used by API (no session needed)
    public function storeApi(){
        if($_SERVER['REQUEST_METHOD']!=='POST') { echo json_encode(['status'=>false]); exit; }
        $d=['token_id'=>$_POST['token_id'],'endpoint'=>$_POST['endpoint'],'response_code'=>$_POST['response_code']];
        $ok = $this->model->create($d);
        echo json_encode(['status'=>$ok]);
    }
}
