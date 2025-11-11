<div class="d-flex justify-content-between mb-2">
  <h4>Tokens API</h4>
  <form method="post" action="index.php?route=Token:createForm" class="d-inline">
    <button class="btn btn-success">+ Generar nuevo token</button>
  </form>
</div>

<table class="table datatable">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Cliente</th>
      <th>Token</th>
      <th>Estado</th>
      <th>Fecha</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tokens as $t): ?>
      <tr>
        <td><?= htmlspecialchars($t['id']) ?></td>
        <td><?= htmlspecialchars($t['client_name'] ?? 'Sin asignar') ?></td>
        <td class="text-truncate" style="max-width:250px;"><code><?= htmlspecialchars($t['token']) ?></code></td>
        <td><?= htmlspecialchars($t['status']) ?></td>
        <td><?= htmlspecialchars($t['created_at']) ?></td>
        <td>
          <!-- FORMULARIO ACTUALIZAR DIRECTO -->
          <form method="post" action="index.php?route=Token:update" style="display:inline">
            <input type="hidden" name="id" value="<?= $t['id'] ?>">
            <input type="hidden" name="client_id" value="<?= $t['client_id'] ?>">
            <input type="hidden" name="status" value="<?= $t['status'] ?>">
            <button type="submit" class="btn btn-sm btn-warning">Regenerar Token</button>
          </form>

          <!-- FORMULARIO ELIMINAR -->
          <form method="post" action="index.php?route=Token:delete" style="display:inline" class="delete-form">
            <input type="hidden" name="id" value="<?= $t['id'] ?>">
            <button class="btn btn-sm btn-danger">Eliminar</button>
          </form>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!-- ✅ Scripts -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
<?php if (!empty($_GET['msg'])): ?>
Swal.fire({
  title: "Éxito",
  text: "<?= htmlspecialchars($_GET['msg']) ?>",
  icon: "success",
  confirmButtonColor: "#3085d6",
  timer: 2200,
  showConfirmButton: false,
  draggable: true
});
<?php endif; ?>

document.querySelectorAll('.delete-form').forEach(form => {
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    Swal.fire({
      title: "¿Eliminar token?",
      text: "Esta acción no se puede deshacer.",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
      confirmButtonText: "Sí, eliminar",
      cancelButtonText: "Cancelar",
      draggable: true
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire({
          title: "Eliminado",
          text: "El token fue eliminado correctamente.",
          icon: "success",
          draggable: true,
          timer: 1800,
          showConfirmButton: false
        });
        setTimeout(() => { form.submit(); }, 1800);
      }
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  if (!sessionStorage.getItem("welcomeTokenShown")) {
    Swal.fire({
      title: "Bienvenido al módulo de Tokens",
      text: "Aquí puedes gestionar y generar tokens API para tus clientes.",
      icon: "info",
      confirmButtonText: "Entendido",
      draggable: true
    });
    sessionStorage.setItem("welcomeTokenShown", "true");
  }
});
</script>
