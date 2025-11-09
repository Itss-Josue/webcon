<?php $editing = isset($item) && $item; ?>
<h4><?= $editing ? 'Editar' : 'Nuevo' ?> API</h4>
<form method="post" action="index.php?route=ClientApi:<?= $editing ? 'update' : 'store' ?>">
  <?php if($editing): ?><input type="hidden" name="id" value="<?= $item['id'] ?>"><?php endif; ?>
  <div class="mb-3"><label>Cliente</label><select name="client_id" class="form-select"><?php foreach($clients as $c): ?><option value="<?= $c['id'] ?>" <?= $editing && $item['client_id']==$c['id'] ? 'selected':'' ?>><?= htmlspecialchars($c['name']) ?></option><?php endforeach; ?></select></div>
  <div class="mb-3"><label>Nombre API</label><input name="api_name" class="form-control" value="<?= $editing ? htmlspecialchars($item['api_name']) : '' ?>"></div>
  <div class="mb-3"><label>API Key</label><input name="api_key" class="form-control" value="<?= $editing ? htmlspecialchars($item['api_key']) : '' ?>"></div>
  <div class="mb-3"><label>Estado</label><select name="status" class="form-select"><option value="Activo" <?= $editing && $item['status']=='Activo' ? 'selected':'' ?>>Activo</option><option value="Inactivo" <?= $editing && $item['status']=='Inactivo' ? 'selected':'' ?>>Inactivo</option></select></div>
  <div><button class="btn btn-primary"><?= $editing ? 'Actualizar' : 'Guardar' ?></button> <a class="btn btn-secondary" href="index.php?route=ClientApi:index">Cancelar</a></div>
</form>
