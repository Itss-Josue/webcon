<body>
    <div class="container">
        <header>
            <h2>📊 Historial de Requests</h2>
        </header>

        <div class="content">
            <a href="index.php?route=request:create" class="btn-primary">➕ Nueva Request</a>
            <a href="index.php?route=dashboard:index" class="btn-secondary">⬅ Volver al Dashboard</a>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Token</th>
                            <th>Tipo</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($requests)): ?>
                        <?php foreach ($requests as $r): ?>
                            <tr>
                                <td><?= htmlspecialchars($r['id']) ?></td>
                                <td><?= htmlspecialchars($r['token']) ?></td>
                                <td><?= htmlspecialchars($r['tipo']) ?></td>
                                <td><?= htmlspecialchars($r['fecha']) ?></td>
                                <td>
                                    <div class="actions">
                                        <a href="index.php?route=request:view&id=<?= $r['id'] ?>" class="action-link action-view">👁 Ver</a>
                                        <a href="index.php?route=request:edit&id=<?= $r['id'] ?>" class="action-link action-edit">✏ Editar</a>
                                        <a href="javascript:void(0);" class="action-link action-delete btn-delete" data-id="<?= $r['id'] ?>">🗑 Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5" class="empty-state">⚠ No hay requests registradas</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll(".btn-delete").forEach(btn => {
            btn.addEventListener("click", function() {
                let id = this.dataset.id;
                Swal.fire({
                    title: '¿Eliminar Request?',
                    text: "No podrás revertir esto",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?route=request:delete&id=" + id;
                    }
                });
            });
        });

        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] === 'created'): ?>
                Swal.fire('✅ Éxito','La request fue registrada correctamente.','success');
            <?php elseif ($_GET['status'] === 'updated'): ?>
                Swal.fire('✏ Actualizada','La request fue modificada correctamente.','success');
            <?php elseif ($_GET['status'] === 'deleted'): ?>
                Swal.fire('🗑 Eliminada','La request fue eliminada.','success');
            <?php endif; ?>
        <?php endif; ?>
    });
    </script>
</body>
