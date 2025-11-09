<?php
require_once __DIR__ . '/../src/model/TokenModel.php';
require_once __DIR__ . '/../src/model/ProjectModel.php';
require_once __DIR__ . '/../src/model/ClientModel.php';
require_once __DIR__ . '/../src/model/PaymentModel.php';
require_once __DIR__ . '/../src/model/CountRequestModel.php';

$tokenModel = new TokenModel();
$projectModel = new ProjectModel();
$clientModel = new ClientModel();
$paymentModel = new PaymentModel();
$countModel = new CountRequestModel();

function jsonResponse($data, $code = 200) {
    header_remove();
    header('Content-Type: application/json');
    http_response_code($code);
    echo json_encode($data);
    exit;
}

// ========================
// 🔐 TOKEN VALIDATION
// ========================
$headers = getallheaders();
$auth = $headers['Authorization'] ?? $headers['authorization'] ?? null;

if (!$auth || stripos($auth, 'Bearer ') !== 0) {
    jsonResponse(['status' => 'error', 'message' => 'Missing token'], 401);
}

$bearer = trim(substr($auth, 7));
$tokenRow = $tokenModel->findByToken($bearer);

if (!$tokenRow) {
    jsonResponse(['status' => 'error', 'message' => 'Invalid token'], 401);
}

// ========================
// ⏳ TOKEN EXPIRATION CHECK
// ========================
// Se asume que en la tabla tokens hay un campo `expires_at`
$now = new DateTime();
$expiresAt = new DateTime($tokenRow['expires_at'] ?? 'now');

if ($now > $expiresAt) {
    // Token vencido → generar nuevo
    $newToken = bin2hex(random_bytes(32));
    $newExpiry = (new DateTime('+1 hour'))->format('Y-m-d H:i:s');
    
    $tokenModel->updateToken($tokenRow['id'], [
        'token' => $newToken,
        'expires_at' => $newExpiry
    ]);

    jsonResponse([
        'status' => 'success',
        'message' => 'Token refreshed',
        'new_token' => $newToken,
        'expires_at' => $newExpiry
    ], 200);
}

// ========================
// 📊 REGISTRO DE USO
// ========================
$countModel->create([
    'token_id' => $tokenRow['id'],
    'endpoint' => $_SERVER['REQUEST_URI'],
    'response_code' => 200
]);

// ========================
// 📁 ROUTER API
// ========================
$resource = $_GET['resource'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true) ?? $_POST;

if ($resource === 'clients') {
    if ($method === 'GET') {
        jsonResponse(['status' => 'success', 'data' => $clientModel->getAll()]);
    }
    if ($method === 'POST') {
        $ok = $clientModel->create($input);
        jsonResponse(['status' => $ok]);
    }
    jsonResponse(['status' => 'error', 'message' => 'Method not allowed'], 405);
}

if ($resource === 'projects') {
    if ($method === 'GET') {
        jsonResponse(['status' => 'success', 'data' => $projectModel->getAll()]);
    }
    if ($method === 'POST') {
        $ok = $projectModel->create($input);
        jsonResponse(['status' => $ok]);
    }
    if ($method === 'PUT') {
        $id = $_GET['id'] ?? null;
        if (!$id) jsonResponse(['status' => 'error', 'message' => 'id required'], 400);
        $ok = $projectModel->update($id, $input);
        jsonResponse(['status' => $ok]);
    }
    if ($method === 'DELETE') {
        $id = $_GET['id'] ?? null;
        if (!$id) jsonResponse(['status' => 'error', 'message' => 'id required'], 400);
        $ok = $projectModel->delete($id);
        jsonResponse(['status' => $ok]);
    }
}

if ($resource === 'payments') {
    if ($method === 'GET') {
        jsonResponse(['status' => 'success', 'data' => $paymentModel->getAll()]);
    }
    if ($method === 'POST') {
        $ok = $paymentModel->create($input);
        jsonResponse(['status' => $ok]);
    }
}

jsonResponse(['status' => 'error', 'message' => 'Resource not found'], 404);
