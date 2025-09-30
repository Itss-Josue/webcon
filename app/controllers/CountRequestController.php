<?php
require_once __DIR__ . '/../models/CountRequest.php';

class CountRequestController {
    private $model;

    public function __construct($db) {
        $this->model = new CountRequest($db);
    }

    public function index() {
        $requests = $this->model->getAll();
        require __DIR__ . '/../views/request/index.php';
    }

    public function view($id) {
        $request = $this->model->getById($id);
        require __DIR__ . '/../views/request/view.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->create($_POST);
            header("Location: index.php?route=request:index&status=created");
            exit;
        }
        require __DIR__ . '/../views/request/create.php';
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model->update($id, $_POST);
            header("Location: index.php?route=request:index&status=updated");
            exit;
        }
        $request = $this->model->getById($id);
        require __DIR__ . '/../views/request/edit.php';
    }

    public function delete($id) {
        $this->model->delete($id);
        header("Location: index.php?route=request:index&status=deleted");
        exit;
    }
}
