<?php $editing = isset($project) && $project; ?>
<h4><?= $editing ? 'Editar' : 'Nuevo' ?> Proyecto</h4>
<form method="post" action="index.php?route=Project:<?= $editing ? 'update' : 'store' ?>">
  <?php if($editing): ?><input type="hidden" name="id" value="<?= $project['id'] ?>"><?php endif; ?>
  <div class="mb-3"><label>Cliente</label><select name="client_id" class="form-select" required><?php foreach($clients as $c): ?><option value="<?= $c['id'] ?>" <?= $editing && $project['client_id']==$c['id'] ? 'selected':'' ?>><?= htmlspecialchars($c['name']) ?></option><?php endforeach; ?></select></div>
  <div class="mb-3"><label>Nombre</label><input name="name" class="form-control" required value="<?= $editing ? htmlspecialchars($project['name']) : '' ?>"></div>
  <div class="mb-3"><label>Descripción</label><textarea name="description" class="form-control"><?= $editing ? htmlspecialchars($project['description']) : '' ?></textarea></div>
  <div class="row">
    <div class="col-md-4 mb-3"><label>Inicio</label><input type="date" name="start_date" class="form-control" value="<?= $editing ? $project['start_date'] : '' ?>"></div>
    <div class="col-md-4 mb-3"><label>Fin</label><input type="date" name="end_date" class="form-control" value="<?= $editing ? $project['end_date'] : '' ?>"></div>
    <div class="col-md-4 mb-3"><label>Estado</label><select name="status" class="form-select"><?php $states=['Pendiente','En Progreso','Completado','Cancelado']; foreach($states as $s): ?><option value="<?= $s ?>" <?= $editing && $project['status']==$s ? 'selected':'' ?>><?= $s ?></option><?php endforeach; ?></select></div>
  </div>
  <div><button class="btn btn-primary"><?= $editing ? 'Actualizar' : 'Guardar' ?></button> <a class="btn btn-secondary" href="index.php?route=Project:index">Cancelar</a></div>
</form>
