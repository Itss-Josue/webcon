<?php
$title = "Editar Token API";
include __DIR__ . '/../layouts/header.php';
?>

<div class="form-header">
    <h1><i class="fas fa-edit"></i> <?= $title ?></h1>
    <a href="/webcon/index.php?route=admin:dashboard#apitoken" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Dashboard
    </a>
</div>

<form method="POST" action="/webcon/index.php?route=apitoken:update&id=<?= $token['id'] ?>" class="form-container">
    <div class="form-group">
        <label for="id_client_api">Cliente API *</label>
        <select id="id_client_api" name="id_client_api" required>
            <option value="">Seleccionar cliente API</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['id'] ?>" 
                    <?= ($token['id_client_api'] == $cliente['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($cliente['razon_social']) ?> (<?= htmlspecialchars($cliente['ruc']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="fecha_registro">Fecha de Registro</label>
        <input type="date" id="fecha_registro" name="fecha_registro" 
               value="<?= htmlspecialchars($token['fecha_registro'] ?? date('Y-m-d')) ?>">
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="1" <?= ($token['estado'] ?? 1) == 1 ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= ($token['estado'] ?? 1) == 0 ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Actualizar Token API
        </button>
        
        <a href="/webcon/index.php?route=apitoken:regenerateToken&id=<?= $token['id'] ?>" 
           class="btn btn-warning" 
           onclick="confirmRegenerate(event)">
            <i class="fas fa-sync-alt"></i> Regenerar Token
        </a>
    </div>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>