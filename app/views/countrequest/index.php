<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registros de Count Request</title>
    <!-- Incluir el mismo CSS del token index -->
</head>
<body>
    <header>
        <div class="header-content">
            <h1 class="app-title"><i class="fas fa-chart-bar"></i> Registros de Requests</h1>
            <div class="user-actions">
                <a href="/webcon/index.php?route=dashboard:index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Dashboard
                </a>
                <a href="/webcon/index.php?route=auth:logout" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="flash-message flash-success">
                <i class="fas fa-check-circle"></i> <?= $_SESSION['flash'] ?>
                <?php unset($_SESSION['flash']); ?>
            </div>
        <?php endif; ?>
        
        <?php if (isset($_SESSION['error'])): ?>
            <div class="flash-message flash-error">
                <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Estadísticas -->
        <?php if (!empty($stats)): ?>
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-chart-line"></i> Estadísticas (Últimos 7 días)</h2>
            </div>
            <div class="card-body">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px;">
                    <?php foreach ($stats as $stat): ?>
                    <div style="text-align: center; padding: 15px; background: #f8fafc; border-radius: 8px;">
                        <div style="font-size: 24px; font-weight: bold; color: var(--primary);">
                            <?= $stat['total_requests'] ?>
                        </div>
                        <div style="font-size: 14px; color: var(--secondary);">
                            Requests el <?= date('d/m', strtotime($stat['request_date'])) ?>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="card">
            <div class="card-header">
                <h2><i class="fas fa-list"></i> Historial de Requests</h2>
                <a href="/webcon/index.php?route=countrequest:createForm" class="btn btn-success">
                    <i class="fas fa-plus"></i> Nuevo Registro
                </a>
            </div>
            
            <div class="card-body">
                <?php if (empty($requests)): ?>
                    <p style="text-align: center; color: var(--secondary); padding: 40px;">
                        <i class="fas fa-inbox" style="font-size: 48px; margin-bottom: 15px; display: block;"></i>
                        No hay registros de requests
                    </p>
                <?php else: ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Token</th>
                                <th>Cliente</th>
                                <th>Tipo</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($requests as $request): ?>
                            <tr>
                                <td><?= htmlspecialchars($request['id']) ?></td>
                                <td>
                                    <div class="token-preview" title="<?= htmlspecialchars($request['token']) ?>">
                                        <?= htmlspecialchars(substr($request['token'], 0, 15)) ?>...
                                    </div>
                                </td>
                                <td><?= htmlspecialchars($request['client_name'] ?? 'N/A') ?></td>
                                <td>
                                    <span class="badge badge-success">
                                        <?= htmlspecialchars($request['tipo']) ?>
                                    </span>
                                </td>
                                <td><?= htmlspecialchars($request['fecha']) ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="/webcon/index.php?route=countrequest:editForm&id=<?= $request['id'] ?>" 
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> Editar
                                        </a>
                                        <a href="/webcon/index.php?route=countrequest:delete&id=<?= $request['id'] ?>" 
                                           class="btn btn-danger btn-sm"
                                           onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>
</html>