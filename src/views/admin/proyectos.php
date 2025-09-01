<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Proyectos - WebDev Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
        }

        .sidebar-header {
            padding: 30px 20px;
            background: rgba(0,0,0,0.2);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h2 {
            font-size: 1.5em;
            margin-bottom: 5px;
        }

        .sidebar-header p {
            opacity: 0.8;
            font-size: 0.9em;
        }

        .nav-menu {
            list-style: none;
            padding: 20px 0;
        }

        .nav-item {
            margin: 5px 0;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255,255,255,0.1);
            border-left-color: #3498db;
            transform: translateX(5px);
        }

        .nav-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1em;
        }

        .main-content {
            flex: 1;
            overflow-y: auto;
        }

        .top-bar {
            background: white;
            padding: 20px 30px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .page-title {
            font-size: 1.8em;
            color: #2c3e50;
        }

        .content-area {
            padding: 30px;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .table-header {
            background: linear-gradient(135deg, #34495e, #2c3e50);
            color: white;
            padding: 20px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 1.3em;
        }

        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.9em;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #2ecc71, #27ae60);
            color: white;
        }

        .btn-warning {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
        }

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px 20px;
            text-align: left;
            border-bottom: 1px solid #ecf0f1;
        }

        th {
            background: #f8f9fa;
            font-weight: 600;
            color: #2c3e50;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8em;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-completado { background: #d4edda; color: #155724; }
        .status-en_progreso { background: #d1ecf1; color: #0c5460; }
        .status-pendiente { background: #fff3cd; color: #856404; }

        .action-buttons {
            display: flex;
            gap: 5px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
            }
            
            table {
                font-size: 0.9em;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="admin-container">
        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="sidebar-header">
                <h2><i class="fas fa-shield-alt"></i> Admin Panel</h2>
                <p>WebDev Solutions</p>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="index.php?controller=admin" class="nav-link">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?controller=admin&action=proyectos" class="nav-link active">
                        <i class="fas fa-project-diagram"></i> Proyectos
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?controller=admin&action=clientes" class="nav-link">
                        <i class="fas fa-users"></i> Clientes
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php" class="nav-link">
                        <i class="fas fa-arrow-left"></i> Volver al Sistema
                    </a>
                </li>
            </ul>
        </div>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="top-bar">
                <h1 class="page-title">Gestión de Proyectos</h1>
                <div class="user-info">
                    <span>Bienvenido, <strong>Admin</strong></span>
                    <div class="user-avatar">A</div>
                </div>
            </div>

            <div class="content-area">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Proyecto creado exitosamente.
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['updated'])): ?>
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle"></i> Proyecto actualizado exitosamente.
                    </div>
                <?php endif; ?>

                <div class="table-container">
                    <div class="table-header">
                        <h3><i class="fas fa-project-diagram"></i> Lista de Proyectos</h3>
                        <a href="index.php?controller=admin&action=crearProyecto" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Nuevo Proyecto
                        </a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Cliente</th>
                                <th>Proyecto</th>
                                <th>Tipo</th>
                                <th>Precio</th>
                                <th>Progreso</th>
                                <th>Estado</th>
                                <th>Entrega</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($proyectos as $proyecto): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($proyecto['cliente_nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($proyecto['nombre']); ?></td>
                                    <td><?php echo htmlspecialchars($proyecto['tipo_proyecto_nombre']); ?></td>
                                    <td>S/ <?php echo number_format($proyecto['precio'], 2); ?></td>
                                    <td><?php echo $proyecto['progreso']; ?>%</td>
                                    <td>
                                        <span class="status-badge status-<?php echo $proyecto['estado']; ?>">
                                            <?php echo ucfirst(str_replace('_', ' ', $proyecto['estado'])); ?>
                                        </span>
                                    </td>
                                    <td><?php echo date('d/m/Y', strtotime($proyecto['fecha_entrega'])); ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="index.php?controller=admin&action=editarProyecto&id=<?php echo $proyecto['id']; ?>" 
                                               class="btn btn-primary" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" title="Eliminar" 
                                                    onclick="eliminarProyecto(<?php echo $proyecto['id']; ?>)">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function eliminarProyecto(id) {
            if (confirm('¿Está seguro de que desea eliminar este proyecto?')) {
                // En una implementación completa, aquí se haría una petición AJAX
                window.location.href = `index.php?controller=admin&action=eliminarProyecto&id=${id}`;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Vista de proyectos cargada');
        });
    </script>
</body>
</html>