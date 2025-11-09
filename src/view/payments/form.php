<?php $editing = isset($payment) && $payment; ?>
<h4><?= $editing ? 'Editar' : 'Nuevo' ?> Pago</h4>
<form method="post" action="index.php?route=Payment:<?= $editing ? 'update' : 'store' ?>">
  <?php if($editing): ?><input type="hidden" name="id" value="<?= $payment['id'] ?>"><?php endif; ?>
  <div class="mb-3"><label>Proyecto</label><select name="project_id" class="form-select" required><?php foreach($projects as $pr): ?><option value="<?= $pr['id'] ?>" <?= $editing && $payment['project_id']==$pr['id'] ? 'selected':'' ?>><?= htmlspecialchars($pr['name']) ?></option><?php endforeach; ?></select></div>
  <div class="mb-3"><label>Monto</label><input name="amount" type="number" step="0.01" class="form-control" required value="<?= $editing ? $payment['amount'] : '' ?>"></div>
  <div class="mb-3"><label>Método</label><select name="method" class="form-select"><option value="Efectivo" <?= $editing && $payment['method']=='Efectivo' ? 'selected':'' ?>>Efectivo</option><option value="Transferencia" <?= $editing && $payment['method']=='Transferencia' ? 'selected':'' ?>>Transferencia</option><option value="Tarjeta" <?= $editing && $payment['method']=='Tarjeta' ? 'selected':'' ?>>Tarjeta</option></select></div>
  <div class="mb-3"><label>Fecha</label><input name="payment_date" type="date" class="form-control" value="<?= $editing ? $payment['payment_date'] : '' ?>"></div>
  <div class="mb-3"><label>Nota</label><input name="note" class="form-control" value="<?= $editing ? htmlspecialchars($payment['note']) : '' ?>"></div>
  <div><button class="btn btn-primary"><?= $editing ? 'Actualizar' : 'Guardar' ?></button> <a class="btn btn-secondary" href="index.php?route=Payment:index">Cancelar</a></div>
</form>
