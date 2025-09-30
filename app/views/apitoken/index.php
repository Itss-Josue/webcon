<body>
    <div class="container">
        <header>
            <h2>🔑 Listado de Tokens</h2>
        </header>

        <div class="content">
            <a href="index.php?route=apitoken:create" class="btn-primary">➕ Nuevo Token</a>
            <a href="index.php?route=dashboard:index" class="btn-secondary">⬅ Volver al Dashboard</a>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Token</th>
                            <th>Fecha Registro</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($tokens)): ?>
                        <?php foreach ($tokens as $t): ?>
                            <tr>
                                <td><?= htmlspecialchars($t['id']) ?></td>
                                <td><?= htmlspecialchars($t['razon_social']) ?></td>
                                <td><?= htmlspecialchars($t['token']) ?></td>
                                <td><?= htmlspecialchars($t['fecha_registro']) ?></td>
                                <td class="<?= $t['estado'] ? 'status-active' : 'status-inactive' ?>">
                                    <?= $t['estado'] ? '✅ Activo' : '❌ Inactivo' ?>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="index.php?route=apitoken:view&id=<?= $t['id'] ?>" class="action-link action-view">👁 Ver</a>
                                        <a href="index.php?route=apitoken:edit&id=<?= $t['id'] ?>" class="action-link action-edit">✏ Editar</a>
                                        <a href="javascript:void(0);" class="action-link action-delete btn-delete" data-id="<?= $t['id'] ?>">🗑 Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="6" class="empty-state">⚠ No hay tokens registrados</td></tr>
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
        // Confirmación al eliminar
        document.querySelectorAll(".btn-delete").forEach(btn => {
            btn.addEventListener("click", function() {
                let id = this.dataset.id;

                Swal.fire({
                    title: '¿Eliminar Token?',
                    text: "No podrás deshacer esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?route=apitoken:delete&id=" + id;
                    }
                });
            });
        });

        // Alertas después de acciones
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] === 'created'): ?>
                Swal.fire('✅ Éxito','El token fue creado correctamente.','success');
            <?php elseif ($_GET['status'] === 'updated'): ?>
                Swal.fire('✏ Actualizado','El token fue modificado correctamente.','success');
            <?php elseif ($_GET['status'] === 'deleted'): ?>
                Swal.fire('🗑 Eliminado','El token fue eliminado.','success');
            <?php endif; ?>
        <?php endif; ?>
    });
    </script>
</body>
