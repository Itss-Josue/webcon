<?php
$title = "Editar Cliente API";
include __DIR__ . '/../layouts/header.php';
?>

<div class="form-header">
    <h1><i class="fas fa-edit"></i> <?= $title ?></h1>
    <a href="/webcon/index.php?route=admin:dashboard#apicliente" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Dashboard
    </a>
</div>

<?php if (isset($_SESSION['flash'])): ?>
    <div class="flash-message flash-success"><?= $_SESSION['flash'] ?></div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>

<form method="POST" action="/webcon/index.php?route=api-cliente:update&id=<?= $cliente['id'] ?>" class="form-container">
    <div class="form-group">
        <label for="ruc">RUC *</label>
        <input type="text" id="ruc" name="ruc" value="<?= htmlspecialchars($cliente['ruc'] ?? '') ?>" required maxlength="20">
    </div>

    <div class="form-group">
        <label for="razon_social">Razón Social *</label>
        <input type="text" id="razon_social" name="razon_social" value="<?= htmlspecialchars($cliente['razon_social'] ?? '') ?>" required maxlength="150">
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($cliente['telefono'] ?? '') ?>" maxlength="20">
    </div>

    <div class="form-group">
        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($cliente['correo'] ?? '') ?>" maxlength="100">
    </div>

    <div class="form-group">
        <label for="fecha_registro">Fecha de Registro</label>
        <input type="date" id="fecha_registro" name="fecha_registro" value="<?= htmlspecialchars($cliente['fecha_registro'] ?? date('Y-m-d')) ?>">
    </div>

    <div class="form-group">
        <label for="estado">Estado</label>
        <select id="estado" name="estado">
            <option value="1" <?= ($cliente['estado'] ?? 1) == 1 ? 'selected' : '' ?>>Activo</option>
            <option value="0" <?= ($cliente['estado'] ?? 1) == 0 ? 'selected' : '' ?>>Inactivo</option>
        </select>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i> Actualizar Cliente API
        </button>
    </div>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>