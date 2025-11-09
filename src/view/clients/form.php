<?php $editing = isset($client) && $client; ?>
<h4><?= $editing ? 'Editar' : 'Nuevo' ?> Cliente</h4>
<form method="post" action="index.php?route=Client:<?= $editing ? 'update' : 'store' ?>">
  <?php if($editing): ?><input type="hidden" name="id" value="<?= $client['id'] ?>"><?php endif; ?>
  <div class="mb-3"><label>Nombre</label><input name="name" class="form-control" required value="<?= $editing ? htmlspecialchars($client['name']) : '' ?>"></div>
  <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required value="<?= $editing ? htmlspecialchars($client['email']) : '' ?>"></div>
  <div class="mb-3"><label>Teléfono</label><input name="phone" class="form-control" value="<?= $editing ? htmlspecialchars($client['phone']) : '' ?>"></div>
  <div class="mb-3"><label>Empresa</label><input name="company" class="form-control" value="<?= $editing ? htmlspecialchars($client['company']) : '' ?>"></div>
  <div class="mb-3"><label>Dirección</label><input name="address" class="form-control" value="<?= $editing ? htmlspecialchars($client['address']) : '' ?>"></div>
  <div class="mb-3"><label>Estado</label>
    <select name="status" class="form-select"><option value="Activo" <?= $editing && $client['status']=='Activo' ? 'selected':'' ?>>Activo</option><option value="Inactivo" <?= $editing && $client['status']=='Inactivo' ? 'selected':'' ?>>Inactivo</option></select>
  </div>
  <div><button class="btn btn-primary"><?= $editing ? 'Actualizar' : 'Guardar' ?></button> <a class="btn btn-secondary" href="index.php?route=Client:index">Cancelar</a></div>
</form>
