<div class="d-flex justify-content-between mb-2">
  <h4>Usuarios</h4>
  <div><form method="post" action="index.php?route=User:createForm"><button class="btn btn-success">+ Nuevo</button></form></div>
</div>
<table class="table datatable">
<thead><tr><th>ID</th><th>Usuario</th><th>Nombre</th><th>Rol</th><th>Acciones</th></tr></thead>
<tbody>
<?php foreach($users as $u): ?>
<tr>
  <td><?= $u['id'] ?></td>
  <td><?= htmlspecialchars($u['username']) ?></td>
  <td><?= htmlspecialchars($u['name']) ?></td>
  <td><?= htmlspecialchars($u['role']) ?></td>
  <td>
    <form method="post" action="index.php?route=User:edit" style="display:inline"><input type="hidden" name="id" value="<?= $u['id'] ?>"><button class="btn btn-sm btn-primary">Editar</button></form>
    <form method="post" action="index.php?route=User:delete" style="display:inline" onsubmit="confirmDelete(this)"><input type="hidden" name="id" value="<?= $u['id'] ?>"><button class="btn btn-sm btn-danger">Eliminar</button></form>
  </td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
