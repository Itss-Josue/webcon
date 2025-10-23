<?php
// Verificar si hay mensajes flash
$flash = $_SESSION['flash'] ?? null;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['flash'], $_SESSION['error']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Token API - WebCon</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header h1 {
            color: #333;
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header h1 i {
            color: #667eea;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card-header h3 {
            margin: 0;
            font-size: 18px;
        }

        .card-body {
            padding: 25px;
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 25px;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .info-item strong {
            color: #333;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .info-item .value {
            color: #666;
            font-size: 16px;
            padding: 8px 0;
        }

        .token-display {
            background: #f8f9fa;
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 15px;
            font-family: 'Courier New', monospace;
            word-break: break-all;
            font-size: 14px;
            line-height: 1.4;
            color: #333;
            margin: 10px 0;
        }

        .actions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-top: 25px;
        }

        .btn-warning {
            background: #ffc107;
            color: #212529;
        }

        .btn-warning:hover {
            background: #e0a800;
            transform: translateY(-2px);
        }

        .btn-info {
            background: #17a2b8;
            color: white;
        }

        .btn-info:hover {
            background: #138496;
            transform: translateY(-2px);
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-completed {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid;
        }

        .alert-success {
            background: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .alert-danger {
            background: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .usage-info {
            background: #e7f3ff;
            border: 1px solid #b3d9ff;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .usage-info h4 {
            color: #0066cc;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .usage-info code {
            background: #f8f9fa;
            padding: 10px 15px;
            border-radius: 5px;
            font-family: 'Courier New', monospace;
            display: block;
            margin: 10px 0;
            border: 1px solid #dee2e6;
            word-break: break-all;
        }

        .breadcrumb {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            font-size: 14px;
        }

        .breadcrumb a {
            color: #667eea;
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .breadcrumb .separator {
            color: #999;
        }

        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

            .info-grid {
                grid-template-columns: 1fr;
            }

            .actions-grid {
                grid-template-columns: 1fr;
            }

            .token-display {
                font-size: 12px;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div>
                <h1>
                    <i class="fas fa-key"></i>
                    Detalles del Token API
                </h1>
                <div class="breadcrumb">
                    <a href="/webcon/index.php?route=dashboard:index">Dashboard</a>
                    <span class="separator">/</span>
                    <a href="/webcon/index.php?route=dashboard:index#apitoken">Tokens API</a>
                    <span class="separator">/</span>
                    <span>Detalles</span>
                </div>
            </div>
            <a href="/webcon/index.php?route=dashboard:index#apitoken" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Volver al Listado
            </a>
        </div>

        <!-- Mensajes Flash -->
        <?php if ($flash): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= htmlspecialchars($flash) ?>
            </div>
        <?php endif; ?>
        
        <?php if ($error): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-triangle"></i> <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <?php if ($token): ?>
        <div class="info-grid">
            <!-- Información Principal del Token -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i>
                    <h3>Información del Token</h3>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <strong>ID del Token</strong>
                        <div class="value">#<?= htmlspecialchars($token['id']) ?></div>
                    </div>
                    
                    <div class="info-item">
                        <strong>Estado</strong>
                        <div class="value">
                            <?php 
                                $estado = $token['estado'] ?? 1;
                                $statusClass = $estado == 1 ? 'status-completed' : 'status-pending';
                                $statusText = $estado == 1 ? 'Activo' : 'Inactivo';
                            ?>
                            <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
                        </div>
                    </div>

                    <div class="info-item">
                        <strong>Token Completo</strong>
                        <div class="token-display">
                            <?= htmlspecialchars($token['token']) ?>
                        </div>
                        <small style="color: #666;">
                            <i class="fas fa-info-circle"></i> 
                            Este token se utiliza para autenticar las solicitudes a la API.
                        </small>
                    </div>

                    <div class="info-item">
                        <strong>Fecha de Registro</strong>
                        <div class="value">
                            <?= date('d/m/Y', strtotime($token['fecha_registro'])) ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información del Cliente -->
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-building"></i>
                    <h3>Información del Cliente</h3>
                </div>
                <div class="card-body">
                    <div class="info-item">
                        <strong>Razón Social</strong>
                        <div class="value"><?= htmlspecialchars($token['razon_social'] ?? 'N/A') ?></div>
                    </div>
                    
                    <div class="info-item">
                        <strong>RUC</strong>
                        <div class="value"><?= htmlspecialchars($token['ruc'] ?? 'N/A') ?></div>
                    </div>
                    
                    <div class="info-item">
                        <strong>ID Cliente API</strong>
                        <div class="value"><?= htmlspecialchars($token['id_client_api'] ?? 'N/A') ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Acciones -->
        <div class="card">
            <div class="card-header">
                <i class="fas fa-cogs"></i>
                <h3>Acciones</h3>
            </div>
            <div class="card-body">
                <div class="actions-grid">
                    <a href="/webcon/index.php?route=apitoken:editForm&id=<?= $token['id'] ?>" 
                       class="btn btn-warning">
                        <i class="fas fa-edit"></i> Editar Token
                    </a>
                    
                    <a href="/webcon/index.php?route=apitoken:regenerateToken&id=<?= $token['id'] ?>" 
                       class="btn btn-info"
                       onclick="return confirm('¿Estás seguro de que deseas regenerar este token? El token actual dejará de funcionar.')">
                        <i class="fas fa-sync-alt"></i> Regenerar Token
                    </a>
                    
                    <a href="/webcon/index.php?route=apitoken:delete&id=<?= $token['id'] ?>" 
                       class="btn btn-danger"
                       onclick="return confirm('¿Estás seguro de que deseas eliminar este token? Esta acción no se puede deshacer.')">
                        <i class="fas fa-trash"></i> Eliminar Token
                    </a>
                </div>
            </div>
        </div>

        <!-- Información de Uso -->
        <div class="usage-info">
            <h4>
                <i class="fas fa-question-circle"></i>
                Cómo usar este token en la API
            </h4>
            <p>Incluye el token en el header de autorización de tus solicitudes HTTP:</p>
            <code>Authorization: Bearer <?= htmlspecialchars($token['token']) ?></code>
            <p><strong>Importante:</strong> Mantén este token seguro y no lo compartas. Si crees que se ha comprometido, regenera el token inmediatamente.</p>
        </div>

        <?php else: ?>
            <div class="card">
                <div class="card-body" style="text-align: center; padding: 40px;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 48px; color: #ffc107; margin-bottom: 20px;"></i>
                    <h3 style="color: #666; margin-bottom: 10px;">Token no encontrado</h3>
                    <p style="color: #999;">El token que buscas no existe o no se pudo cargar.</p>
                    <a href="/webcon/index.php?route=dashboard:index#apitoken" class="btn btn-secondary" style="margin-top: 20px;">
                        <i class="fas fa-arrow-left"></i> Volver al Listado
                    </a>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Auto-dismiss alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transition = 'opacity 0.5s ease';
                setTimeout(() => alert.remove(), 500);
            });
        }, 5000);
    </script>
</body>
</html>