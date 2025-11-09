<div class="d-flex justify-content-between mb-2">
  <h4>Pagos</h4>
  <div><form method="post" action="index.php?route=Payment:createForm"><button class="btn btn-success">+ Nuevo</button></form></div>
</div>
<table class="table datatable">
<thead><tr><th>ID</th><th>Proyecto</th><th>Cliente</th><th>Monto</th><th>Fecha</th><th>Método</th><th>Acciones</th></tr></thead>
<tbody>
<?php foreach($payments as $p): ?>
<tr>
  <td><?= $p['id'] ?></td>
  <td><?= htmlspecialchars($p['project_name']) ?></td>
  <td><?= htmlspecialchars($p['client_name']) ?></td>
  <td><?= number_format($p['amount'],2) ?></td>
  <td><?= $p['payment_date'] ?></td>
  <td><?= $p['method'] ?></td>
  <td>
    <form method="post" action="index.php?route=Payment:edit" style="display:inline"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="btn btn-sm btn-primary">Editar</button></form>
    <form method="post" action="index.php?route=Payment:delete" style="display:inline" onsubmit="confirmDelete(this)"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="btn btn-sm btn-danger">Eliminar</button></form>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
