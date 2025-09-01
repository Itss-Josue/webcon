<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - WebDev Solutions</title>
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

        /* SIDEBAR */
        .sidebar {
            width: 280px;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            padding: 0;
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

        /* MAIN CONTENT */
        .main-content {
            flex: 1;
            padding: 0;
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

        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .content-area {
            padding: 30px;
        }

        /* DASHBOARD CARDS */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5em;
        }

        .stat-icon.clients { background: linear-gradient(135deg, #3498db, #2980b9); }
        .stat-icon.projects { background: linear-gradient(135deg, #2ecc71, #27ae60); }
        .stat-icon.earnings { background: linear-gradient(135deg, #f39c12, #e67e22); }
        .stat-icon.pending { background: linear-gradient(135deg, #e74c3c, #c0392b); }

        .stat-number {
            font-size: 2.5em;
            font-weight: bold;
            color: #2c3e50;
            line-height: 1;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-change {
            margin-top: 10px;
            font-size: 0.85em;
        }

        .stat-change.positive { color: #27ae60; }

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

        .btn-danger {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .progress-container {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-top: 20px;
        }

        .progress-item {
            margin-bottom: 20px;
        }

        .progress-info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }

        .progress-bar {
            height: 12px;
            background: #ecf0f1;
            border-radius: 6px;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 6px;
            transition: width 0.5s ease;
        }

        .progress-fill.high { background: linear-gradient(90deg, #2ecc71, #27ae60); }
        .progress-fill.medium { background: linear-gradient(90deg, #f39c12, #e67e22); }
        .progress-fill.low { background: linear-gradient(90deg, #e74c3c, #c0392b); }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
            }
            
            .nav-menu {
                display: flex;
                overflow-x: auto;
                padding: 10px;
            }
            
            .nav-item {
                margin: 0 5px;
            }
            
            .dashboard-stats {
                grid-template-columns: 1fr;
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
                    <a href="index.php?controller=admin" class="nav-link active">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="index.php?controller=admin&action=proyectos" class="nav-link">
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
            <!-- TOP BAR -->
            <div class="top-bar">
                <h1 class="page-title">Dashboard General</h1>
                <div class="user-info">
                    <span>Bienvenido, <strong>Admin</strong></span>
                    <div class="user-avatar">A</div>
                </div>
            </div>

            <!-- CONTENT AREA -->
            <div class="content-area">
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon clients">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $total_clientes; ?></div>
                        <div class="stat-label">Total Clientes</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> Clientes activos
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon projects">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $estadisticas['proyectos_activos']; ?></div>
                        <div class="stat-label">Proyectos Activos</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> En desarrollo
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon earnings">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-number">S/ <?php echo number_format($estadisticas['ingresos_mes'], 2); ?></div>
                        <div class="stat-label">Ingresos Este Mes</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> Pagos recibidos
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $estadisticas['pendientes']; ?></div>
                        <div class="stat-label">Proyectos Pendientes</div>
                        <div class="stat-change positive">
                            <i class="fas fa-hourglass-half"></i> Por iniciar
                        </div>
                    </div>
                </div>

                <div class="progress-container">
                    <h3><i class="fas fa-tasks"></i> Progreso de Proyectos Activos</h3>
                    <?php foreach ($progreso_proyectos as $proyecto): ?>
                        <div class="progress-item">
                            <div class="progress-info">
                                <span><strong><?php echo htmlspecialchars($proyecto['nombre']); ?> - <?php echo htmlspecialchars($proyecto['cliente_nombre']); ?></strong></span>
                                <span><?php echo $proyecto['progreso']; ?>%</span>
                            </div>
                            <div class="progress-bar">
                                <?php
                                $progressClass = 'low';
                                if ($proyecto['progreso'] >= 70) $progressClass = 'high';
                                elseif ($proyecto['progreso'] >= 40) $progressClass = 'medium';
                                ?>
                                <div class="progress-fill <?php echo $progressClass; ?>" style="width: <?php echo $proyecto['progreso']; ?>%"></div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Navigation functionality
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function() {
                document.querySelectorAll('.nav-link').forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });

        // Auto-update dashboard stats
        function actualizarEstadisticas() {
            fetch('index.php?controller=admin&action=obtenerDatos&tipo=estadisticas')
                .then(response => response.json())
                .then(data => {
                    console.log('Estadísticas actualizadas', data);
                })
                .catch(error => {
                    console.error('Error actualizando estadísticas:', error);
                });
        }

        // Update stats every 5 minutes
        setInterval(actualizarEstadisticas, 300000);

        document.addEventListener('DOMContentLoaded', function() {
            console.log('Panel de administrador cargado correctamente');
        });
    </script>
</body>
</html>