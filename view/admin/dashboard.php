<!-- view/admin/dashboard.php -->
<div class="admin-container">
    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="sidebar-header">
            <h2><i class="fas fa-shield-alt"></i> Admin Panel</h2>
            <p>WebDev Solutions</p>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="index.php?controller=Admin&action=dashboard" class="nav-link active">
                    <i class="fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?controller=Project&action=index" class="nav-link">
                    <i class="fas fa-project-diagram"></i> Proyectos
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?controller=Client&action=index" class="nav-link">
                    <i class="fas fa-users"></i> Clientes
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?controller=Payment&action=index" class="nav-link">
                    <i class="fas fa-credit-card"></i> Pagos
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?controller=Report&action=index" class="nav-link">
                    <i class="fas fa-chart-bar"></i> Reportes
                </a>
            </li>
            <li class="nav-item">
                <a href="index.php?controller=Settings&action=index" class="nav-link">
                    <i class="fas fa-cogs"></i> Configuración
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
                <span>Bienvenido, <strong><?php echo $_SESSION['usuario_nombre']; ?></strong></span>
                <div class="user-avatar"><?php echo substr($_SESSION['usuario_nombre'], 0, 1); ?></div>
                <a href="logout.php" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>

        <!-- CONTENT AREA -->
        <div class="content-area">
            <!-- DASHBOARD SECTION -->
            <div class="content-section active">
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon clients">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $totalClientes; ?></div>
                        <div class="stat-label">Total Clientes</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +12% este mes
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon projects">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $proyectosActivos; ?></div>
                        <div class="stat-label">Proyectos Activos</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +8% este mes
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon earnings">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-number">S/ <?php echo number_format($ingresosMes, 2); ?></div>
                        <div class="stat-label">Ingresos Este Mes</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> +23% este mes
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?php echo $proyectosPendientes; ?></div>
                        <div class="stat-label">Proyectos Pendientes</div>
                        <div class="stat-change negative">
                            <i class="fas fa-arrow-down"></i> -5% este mes
                        </div>
                    </div>
                </div>

                <div class="progress-container">
                    <h3><i class="fas fa-tasks"></i> Progreso de Proyectos Activos</h3>
                    <?php foreach ($proyectosProgreso as $proyecto): ?>
                    <div class="progress-item">
                        <div class="progress-info">
                            <span><strong><?php echo $proyecto['nombre']; ?></strong></span>
                            <span><?php echo $proyecto['progreso']; ?>%</span>
                        </div>
                        <div class="progress-bar">
                            <?php 
                            $claseProgreso = 'high';
                            if ($proyecto['progreso'] < 50) $claseProgreso = 'low';
                            elseif ($proyecto['progreso'] < 80) $claseProgreso = 'medium';
                            ?>
                            <div class="progress-fill <?php echo $claseProgreso; ?>" style="width: <?php echo $proyecto['progreso']; ?>%"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>