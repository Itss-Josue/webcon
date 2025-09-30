<!DOCTYPE html>
<html lang="es">
<head>
    <!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Clientes API</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        header {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            padding: 25px;
            text-align: center;
        }
        
        header h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }
        
        .content {
            padding: 30px;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #2980b9, #1c5d87);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        .table-container {
            margin-top: 20px;
            overflow-x: auto;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 800px;
        }
        
        thead {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }
        
        th {
            padding: 15px 12px;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        tbody tr {
            border-bottom: 1px solid #e1e1e1;
            transition: all 0.2s ease;
        }
        
        tbody tr:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }
        
        td {
            padding: 14px 12px;
            font-size: 14px;
        }
        
        .status-active {
            color: #27ae60;
            font-weight: 600;
        }
        
        .status-inactive {
            color: #e74c3c;
            font-weight: 600;
        }
        
        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }
        
        .action-link {
            padding: 6px 10px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .action-view {
            background-color: #3498db;
            color: white;
        }
        
        .action-edit {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }
        
        .action-delete {
            background-color: #e74c3c;
            color: white;
        }
        
        .action-link:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
            font-style: italic;
        }
        
        .empty-state::before {
            content: "⚠";
            display: block;
            font-size: 2rem;
            margin-bottom: 10px;
        }
        
        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 5px;
            }
            
            .content {
                padding: 20px;
            }
            
            th, td {
                padding: 10px 8px;
                font-size: 13px;
            }
            
            .actions {
                flex-direction: column;
                gap: 5px;
            }
            
            .action-link {
                text-align: center;
                padding: 8px;
            }
        }
        
        @media (max-width: 480px) {
            header {
                padding: 15px;
            }
            
            header h2 {
                font-size: 1.5rem;
            }
            
            .btn-primary {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h2>📋 Listado de Clientes API</h2>
        </header>
        
        <div class="content">
            <div class="actions-top">
                <a href="/webcon/index.php?route=admin:dashboard" class="btn-secondary">🏠 Volver al Dashboard</a>
                <a href="index.php?route=apicliente:create" class="btn-primary">➕ Nuevo Cliente</a>
            </div>
            
            <div class="table-container">
                <table>
                    <thead>
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
                    </thead>
                    <tbody>
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['id'] ?? '') ?></td>
                                <td><?= htmlspecialchars($c['ruc'] ?? '') ?></td>
                                <td><?= htmlspecialchars($c['razon_social'] ?? '') ?></td>
                                <td><?= htmlspecialchars($c['telefono'] ?? '') ?></td>
                                <td><?= htmlspecialchars($c['correo'] ?? '') ?></td>
                                <td><?= htmlspecialchars($c['fecha_registro'] ?? '') ?></td>
                                <td class="<?= isset($c['estado']) && $c['estado'] == 1 ? 'status-active' : 'status-inactive' ?>">
                                    <?= isset($c['estado']) && $c['estado'] == 1 ? '✅ Activo' : '❌ Inactivo' ?>
                                </td>
                                <td>
                                    <div class="actions">
                                        <a href="index.php?route=apicliente:view&id=<?= $c['id'] ?>" class="action-link action-view">👁 Ver</a>
                                        <a href="index.php?route=apicliente:edit&id=<?= $c['id'] ?>" class="action-link action-edit">✏ Editar</a>
                                        <a href="javascript:void(0);" 
                                           class="action-link action-delete btn-delete" 
                                           data-id="<?= $c['id'] ?>">🗑 Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="empty-state">⚠ No hay clientes registrados</td>
                        </tr>
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
                    title: '¿Estás seguro?',
                    text: "No podrás revertir esta acción",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "index.php?route=apicliente:delete&id=" + id;
                    }
                });
            });
        });

        // ✅ Mostrar alertas modernas después de acciones
        <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] === 'created'): ?>
                Swal.fire('✅ Éxito','El cliente fue registrado correctamente.','success');
            <?php elseif ($_GET['status'] === 'updated'): ?>
                Swal.fire('✏ Actualizado','Los datos del cliente se modificaron correctamente.','success');
            <?php elseif ($_GET['status'] === 'deleted'): ?>
                Swal.fire('🗑 Eliminado','El cliente fue eliminado del sistema.','success');
            <?php endif; ?>
        <?php endif; ?>
    });
    </script>

    <style>
        .actions-top {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .btn-primary, .btn-secondary {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            color: #fff;
        }
        .btn-primary {
            background: #28a745;
        }
        .btn-secondary {
            background: #007bff;
        }
        .btn-primary:hover, .btn-secondary:hover {
            opacity: 0.85;
        }
    </style>
</body>


</html>