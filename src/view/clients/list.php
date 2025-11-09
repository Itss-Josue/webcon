<div class="d-flex justify-content-between mb-2">
  <h4>Clientes</h4>
  <div><form method="post" action="index.php?route=Client:createForm" class="d-inline"><button class="btn btn-success">+ Nuevo</button></form></div>
</div>
<table class="table datatable">
  <thead><tr><th>ID</th><th>Nombre</th><th>Email</th><th>Empresa</th><th>Estado</th><th>Acciones</th></tr></thead>
  <tbody>
    <?php foreach($clients as $c): ?>
      <tr>
        <td><?= $c['id'] ?></td>
        <td><?= htmlspecialchars($c['name']) ?></td>
        <td><?= htmlspecialchars($c['email']) ?></td>
        <td><?= htmlspecialchars($c['company']) ?></td>
        <td><?= htmlspecialchars($c['status']) ?></td>
        <td>
          <form method="post" action="index.php?route=Client:edit" style="display:inline"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="btn btn-sm btn-primary">Editar</button></form>
          <form method="post" action="index.php?route=Client:delete" style="display:inline" onsubmit="confirmDelete(this)"><input type="hidden" name="id" value="<?= $c['id'] ?>"><button class="btn btn-sm btn-danger">Eliminar</button></form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
