<h2>📋 Listado de Clientes API</h2>

<a href="index.php?route=apicliente:create">➕ Nuevo Cliente</a>

<table border="1" cellpadding="5" cellspacing="0" style="margin-top:10px; border-collapse: collapse; width:100%;">
    <tr>
        <th>ID</th>
        <th>RUC</th>
        <th>Razón Social</th>
        <th>Teléfono</th>
        <th>Correo</th>
        <th>Fecha Registro</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php if (!empty($clientes)): ?>
        <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?= htmlspecialchars($c['id']) ?></td>
            <td><?= htmlspecialchars($c['ruc']) ?></td>
            <td><?= htmlspecialchars($c['razon_social']) ?></td>
            <td><?= htmlspecialchars($c['telefono']) ?></td>
            <td><?= htmlspecialchars($c['correo']) ?></td>
            <td><?= htmlspecialchars($c['fecha_registro']) ?></td>
            <td><?= $c['estado'] ? '✅ Activo' : '❌ Inactivo' ?></td>
            <td>
                <a href="index.php?route=apicliente:view&id=<?= $c['id'] ?>">👁 Ver</a> |
                <a href="index.php?route=apicliente:edit&id=<?= $c['id'] ?>">✏ Editar</a> |
                <a href="index.php?route=apicliente:delete&id=<?= $c['id'] ?>" 
                   onclick="return confirm('¿Seguro que deseas eliminar este cliente?')">🗑 Eliminar</a>
            </td>
        </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8" style="text-align:center;">⚠️ No hay clientes registrados</td>
        </tr>
    <?php endif; ?>
</table>
