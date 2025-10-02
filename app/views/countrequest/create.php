<?php
$title = "Crear Registro de Request";
include __DIR__ . '/../layouts/header.php';
?>

<div class="form-header">
    <h1><i class="fas fa-chart-bar"></i> <?= $title ?></h1>
    <a href="/webcon/index.php?route=admin:dashboard#countrequest" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Dashboard
    </a>
</div>

<form method="POST" action="/webcon/index.php?route=countrequest:store" class="form-container">
    <div class="form-group">
        <label for="id_token">Token API *</label>
        <select id="id_token" name="id_token" required>
            <option value="">Seleccionar token API</option>
            <?php foreach ($tokens as $token): ?>
                <?php if ($token['estado'] == 1): ?>
                    <option value="<?= $token['id'] ?>">
                        <?= htmlspecialchars($token['razon_social']) ?> - 
                        <?= htmlspecialchars(substr($token['token'], 0, 20)) ?>...
                    </option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
        <small style="color: #666; margin-top: 5px; display: block;">
            Solo se muestran tokens activos
        </small>
    </div>

    <div class="form-group">
        <label for="tipo">Tipo de Request *</label>
        <select id="tipo" name="tipo" required>
            <option value="">Seleccionar tipo</option>
            <?php foreach ($tipos as $key => $value): ?>
                <option value="<?= $key ?>"><?= $value ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="fecha">Fecha del Request</label>
        <input type="date" id="fecha" name="fecha" value="<?= date('Y-m-d') ?>">
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Crear Registro
        </button>
    </div>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>