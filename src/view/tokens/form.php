<?php $editing = isset($token) && $token; ?>
<h4><?= $editing ? 'Editar' : 'Nuevo' ?> Token</h4>

<form method="post" action="index.php?route=Token:<?= $editing ? 'update' : 'store' ?>">
  <?php if ($editing): ?>
    <input type="hidden" name="id" value="<?= $token['id'] ?>">
  <?php endif; ?>

  <div class="mb-3">
    <label>Cliente</label>
    <select name="client_id" class="form-select" required>
      <option value="">Seleccione un cliente</option>
      <?php foreach($clients as $c): ?>
        <option value="<?= $c['id'] ?>" <?= $editing && $token['client_id'] == $c['id'] ? 'selected' : '' ?>>
          <?= htmlspecialchars($c['name']) ?>
        </option>
      <?php endforeach; ?>
    </select>
  </div>

  <?php if ($editing): ?>
    <div class="mb-3">
      <label>Estado</label>
      <select name="status" class="form-select">
        <option value="Activo" <?= $token['status'] == 'Activo' ? 'selected' : '' ?>>Activo</option>
        <option value="Inactivo" <?= $token['status'] == 'Inactivo' ? 'selected' : '' ?>>Inactivo</option>
      </select>
    </div>
  <?php endif; ?>

  <div>
    <button class="btn btn-primary"><?= $editing ? 'Actualizar' : 'Guardar' ?></button>
    <a class="btn btn-secondary" href="index.php?route=Token:index">Cancelar</a>
  </div>
</form>
