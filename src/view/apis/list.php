<div class="d-flex justify-content-between mb-2">
  <h4>APIs por Cliente</h4>
  <div><form method="post" action="index.php?route=ClientApi:createForm"><button class="btn btn-success">+ Nuevo</button></form></div>
</div>
<table class="table datatable">
<thead><tr><th>ID</th><th>Cliente</th><th>API</th><th>Clave</th><th>Estado</th><th>Acciones</th></tr></thead>
<tbody>
<?php foreach($apis as $a): ?>
<tr>
  <td><?= $a['id'] ?></td>
  <td><?= htmlspecialchars($a['client_name']) ?></td>
  <td><?= htmlspecialchars($a['api_name']) ?></td>
  <td><?= htmlspecialchars($a['api_key']) ?></td>
  <td><?= htmlspecialchars($a['status']) ?></td>
  <td>
    <form method="post" action="index.php?route=ClientApi:edit" style="display:inline"><input type="hidden" name="id" value="<?= $a['id'] ?>"><button class="btn btn-sm btn-primary">Editar</button></form>
    <form method="post" action="index.php?route=ClientApi:delete" style="display:inline" onsubmit="confirmDelete(this)"><input type="hidden" name="id" value="<?= $a['id'] ?>"><button class="btn btn-sm btn-danger">Eliminar</button></form>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
