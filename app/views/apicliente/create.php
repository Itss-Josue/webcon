<?php
$title = "Agregar Cliente API";
include __DIR__ . '/../layouts/header.php';
?>

<div class="form-header">
    <h1><i class="fas fa-plus"></i> <?= $title ?></h1>
    <a href="/webcon/index.php?route=admin:dashboard#apicliente" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Volver al Dashboard
    </a>
</div>

<form method="POST" action="/webcon/index.php?route=api-cliente:store" class="form-container">
    <div class="form-group">
        <label for="ruc">RUC *</label>
        <input type="text" id="ruc" name="ruc" required maxlength="20" placeholder="Ingrese el RUC">
    </div>

    <div class="form-group">
        <label for="razon_social">Razón Social *</label>
        <input type="text" id="razon_social" name="razon_social" required maxlength="150" placeholder="Ingrese la razón social">
    </div>

    <div class="form-group">
        <label for="telefono">Teléfono</label>
        <input type="text" id="telefono" name="telefono" maxlength="20" placeholder="Ingrese el teléfono">
    </div>

    <div class="form-group">
        <label for="correo">Correo Electrónico</label>
        <input type="email" id="correo" name="correo" maxlength="100" placeholder="Ingrese el correo electrónico">
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
            <i class="fas fa-save"></i> Guardar Cliente API
        </button>
    </div>
</form>

<?php include __DIR__ . '/../layouts/footer.php'; ?>