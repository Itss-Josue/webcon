<div class="d-flex justify-content-between mb-2">
  <h4>Proyectos</h4>
  <div><form method="post" action="index.php?route=Project:createForm"><button class="btn btn-success">+ Nuevo</button></form></div>
</div>
<table class="table datatable">
<thead><tr><th>ID</th><th>Nombre</th><th>Cliente</th><th>Fechas</th><th>Estado</th><th>Acciones</th></tr></thead>
<tbody>
<?php foreach($projects as $p): ?>
<tr>
  <td><?= $p['id'] ?></td>
  <td><?= htmlspecialchars($p['name']) ?></td>
  <td><?= htmlspecialchars($p['client_name']) ?></td>
  <td><?= htmlspecialchars($p['start_date']) ?> → <?= htmlspecialchars($p['end_date']) ?></td>
  <td><?= htmlspecialchars($p['status']) ?></td>
  <td>
    <form method="post" action="index.php?route=Project:edit" style="display:inline"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="btn btn-sm btn-primary">Editar</button></form>
    <form method="post" action="index.php?route=Project:delete" style="display:inline" onsubmit="confirmDelete(this)"><input type="hidden" name="id" value="<?= $p['id'] ?>"><button class="btn btn-sm btn-danger">Eliminar</button></form>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
