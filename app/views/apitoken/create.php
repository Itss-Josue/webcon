<?php
$title = "Generar Token API";
include __DIR__ . '/../layouts/header.php';
?>

<div class="form-header">
    <h1><i class="fas fa-key"></i> <?= $title ?></h1>
    <a href="/webcon/index.php?route=admin:dashboard#apitoken" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Dashboard
    </a>
</div>

<form method="POST" action="/webcon/index.php?route=apitoken:store" class="form-container">
    <div class="form-group">
        <label for="id_client_api">Cliente API *</label>
        <select id="id_client_api" name="id_client_api" required>
            <option value="">Seleccionar cliente API</option>
            <?php foreach ($clientes as $cliente): ?>
                <option value="<?= $cliente['id'] ?>">
                    <?= htmlspecialchars($cliente['razon_social']) ?> (<?= htmlspecialchars($cliente['ruc']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="fecha_registro">Fecha de Registro</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?= date('Y-m-d') ?>">
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="1" selected>Activo</option>
            <option value="0">Inactivo</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-key"></i> Generar Token API
        </button>
    </div>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>