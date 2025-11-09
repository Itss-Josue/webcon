<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <h3 class="mb-4 text-primary fw-bold">
                <i class="fas fa-key me-2"></i>Gestión de Tokens API
            </h3>

            <a href="index.php?route=tokens/create" class="btn btn-success mb-3 rounded-pill px-4">
                <i class="fas fa-plus-circle me-1"></i> Generar nuevo token
            </a>

            <?php if (!empty($_GET['msg'])): ?>
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle me-2"></i><?= htmlspecialchars($_GET['msg']) ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                </div>
            <?php endif; ?>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-dark text-center">
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
                            <td class="text-center fw-semibold"><?= htmlspecialchars($t['id']) ?></td>
                            <td><?= htmlspecialchars($t['client_name'] ?? 'Sin asignar') ?></td>
                            <td class="text-truncate" style="max-width:250px;">
                                <code class="bg-light px-2 py-1 rounded d-inline-block"><?= htmlspecialchars($t['token']) ?></code>
                            </td>
                            <td class="text-center">
                                <?php if ($t['status'] === 'activo'): ?>
                                    <span class="badge bg-success px-3 py-2">Activo</span>
                                <?php else: ?>
                                    <span class="badge bg-secondary px-3 py-2">Inactivo</span>
                                <?php endif; ?>
                            </td>
                            <td><?= htmlspecialchars($t['created_at']) ?></td>
                            <td class="text-center">
                                <a href="index.php?route=tokens/update&id=<?= $t['id'] ?>" class="btn btn-warning btn-sm rounded-pill me-1">
                                    <i class="fas fa-edit"></i> Actualizar
                                </a>
                                <a href="index.php?route=tokens/delete&id=<?= $t['id'] ?>" 
                                   class="btn btn-danger btn-sm rounded-pill"
                                   onclick="return confirm('¿Eliminar token?')">
                                    <i class="fas fa-trash-alt"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($tokens)): ?>
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">
                                <i class="fas fa-exclamation-circle me-2"></i>No hay tokens registrados.
                            </td>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Estilos adicionales -->
<style>
    body {
        background-color: #f8f9fa;
    }
    .table-hover tbody tr:hover {
        background-color: #eef5ff;
        transition: 0.2s;
    }
    .card {
        background-color: #ffffff;
        border-radius: 20px;
    }
</style>

<!-- Íconos FontAwesome (si no los tienes ya) -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
