<?php
// Aseguramos que las variables siempre sean arrays
$clientes  = $clientes ?? [];
$proyectos = $proyectos ?? [];
$pagos     = $pagos ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - WebDev Solutions</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --dark-gradient: linear-gradient(180deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            --card-gradient: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
            --blue-gradient: linear-gradient(135deg, #3498db, #2980b9);
            --green-gradient: linear-gradient(135deg, #2ecc71, #27ae60);
            --orange-gradient: linear-gradient(135deg, #f39c12, #e67e22);
            --red-gradient: linear-gradient(135deg, #e74c3c, #c0392b);
            --purple-gradient: linear-gradient(135deg, #9b59b6, #8e44ad);
            --shadow-light: 0 8px 32px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 12px 40px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 16px 48px rgba(0, 0, 0, 0.2);
            --border-radius: 16px;
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: var(--primary-gradient);
            min-height: 100vh;
            line-height: 1.6;
            color: #2c3e50;
        }

        .admin-container {
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR MEJORADO */
        .sidebar {
            width: 300px;
            background: var(--dark-gradient);
            color: white;
            padding: 0;
            box-shadow: var(--shadow-heavy);
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            pointer-events: none;
        }

        .sidebar-header {
            padding: 40px 25px 30px;
            background: rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
        }

        .sidebar-header h2 {
            font-size: 1.8em;
            margin-bottom: 8px;
            font-weight: 700;
            background: linear-gradient(135deg, #fff, #e0e7ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar-header p {
            opacity: 0.7;
            font-size: 0.95em;
            font-weight: 400;
        }

        .nav-menu {
            list-style: none;
            padding: 25px 0;
        }

        .nav-item {
            margin: 8px 15px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 16px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition-smooth);
            border-radius: 12px;
            font-weight: 500;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: var(--transition-smooth);
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(8px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
        }

        .nav-link.active {
            background: var(--blue-gradient);
            box-shadow: 0 8px 25px rgba(52, 152, 219, 0.4);
        }

        .nav-link i {
            width: 24px;
            margin-right: 15px;
            font-size: 1.2em;
            text-align: center;
        }

        /* MAIN CONTENT MEJORADO */
        .main-content {
            flex: 1;
            margin-left: 300px;
            padding: 0;
            overflow-y: auto;
        }

        .top-bar {
            background: var(--card-gradient);
            padding: 25px 35px;
            box-shadow: var(--shadow-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .page-title {
            font-size: 2.2em;
            color: #2c3e50;
            font-weight: 700;
            background: linear-gradient(135deg, #2c3e50, #34495e);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 20px;
            background: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            border-radius: 50px;
            box-shadow: var(--shadow-light);
            backdrop-filter: blur(10px);
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            background: var(--blue-gradient);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.1em;
            box-shadow: 0 4px 15px rgba(52, 152, 219, 0.3);
        }

        .content-area {
            padding: 35px;
            background: rgba(255, 255, 255, 0.05);
            min-height: calc(100vh - 94px);
        }

        /* DASHBOARD CARDS MEJORADAS */
        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
        }

        .stat-card {
            background: var(--card-gradient);
            padding: 35px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-medium);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--blue-gradient);
            transition: var(--transition-smooth);
        }

        .stat-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-heavy);
        }

        .stat-card:nth-child(1)::before { background: var(--blue-gradient); }
        .stat-card:nth-child(2)::before { background: var(--green-gradient); }
        .stat-card:nth-child(3)::before { background: var(--orange-gradient); }
        .stat-card:nth-child(4)::before { background: var(--red-gradient); }

        .stat-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.6em;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stat-icon.clients { background: var(--blue-gradient); }
        .stat-icon.projects { background: var(--green-gradient); }
        .stat-icon.earnings { background: var(--orange-gradient); }
        .stat-icon.pending { background: var(--red-gradient); }

        .stat-number {
            font-size: 3em;
            font-weight: 800;
            color: #2c3e50;
            line-height: 1;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #7f8c8d;
            font-size: 0.95em;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .stat-change {
            margin-top: 15px;
            font-size: 0.9em;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .stat-change.positive { color: #27ae60; }
        .stat-change.negative { color: #e74c3c; }

        /* CONTENT SECTIONS */
        .content-section {
            display: none;
        }

        .content-section.active {
            display: block;
            animation: fadeInUp 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* TABLES MEJORADAS */
        .table-container {
            background: var(--card-gradient);
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow-medium);
            margin-top: 25px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .table-header {
            background: var(--dark-gradient);
            color: white;
            padding: 25px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .table-header h3 {
            font-size: 1.4em;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .btn {
            padding: 14px 28px;
            border: none;
            border-radius: 12px;
            cursor: pointer;
            font-size: 0.95em;
            transition: var(--transition-smooth);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: var(--transition-smooth);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: var(--blue-gradient);
            color: white;
            box-shadow: 0 6px 20px rgba(52, 152, 219, 0.3);
        }

        .btn-success {
            background: var(--green-gradient);
            color: white;
            box-shadow: 0 6px 20px rgba(46, 204, 113, 0.3);
        }

        .btn-warning {
            background: var(--orange-gradient);
            color: white;
            box-shadow: 0 6px 20px rgba(243, 156, 18, 0.3);
        }

        .btn-danger {
            background: var(--red-gradient);
            color: white;
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(135deg, #95a5a6, #7f8c8d);
            color: white;
            box-shadow: 0 6px 20px rgba(149, 165, 166, 0.3);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .btn-sm {
            padding: 8px 16px;
            font-size: 0.8em;
            border-radius: 8px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 18px 24px;
            text-align: left;
            border-bottom: 1px solid #f1f3f4;
        }

        th {
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            font-weight: 700;
            color: #2c3e50;
            font-size: 0.9em;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        tr {
            transition: var(--transition-smooth);
        }

        tr:hover {
            background: linear-gradient(135deg, #f8f9ff, #f0f4ff);
            transform: scale(1.001);
        }

        td {
            color: #34495e;
            font-weight: 500;
        }

        .status-badge {
            padding: 8px 16px;
            border-radius: 25px;
            font-size: 0.8em;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            display: inline-block;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .status-completed { 
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }
        
        .status-progress { 
            background: linear-gradient(135deg, #d1ecf1, #bee5eb);
            color: #0c5460;
        }
        
        .status-pending { 
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
        }

        /* SEARCH BAR MEJORADA */
        .search-container {
            padding: 25px 30px;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-bottom: 1px solid #dee2e6;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border-radius: 50px;
            padding: 15px 25px;
            box-shadow: var(--shadow-light);
            border: 2px solid transparent;
            transition: var(--transition-smooth);
        }

        .search-box:focus-within {
            border-color: #3498db;
            box-shadow: 0 0 0 4px rgba(52, 152, 219, 0.1);
        }

        .search-box i {
            color: #6c757d;
            margin-right: 15px;
            font-size: 1.1em;
        }

        .search-input {
            border: none;
            outline: none;
            flex: 1;
            font-size: 1em;
            background: transparent;
        }

        /* LOGOUT BUTTON MEJORADO */
        .logout-btn {
            background: var(--red-gradient);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 50px;
            font-size: 0.9em;
            cursor: pointer;
            transition: var(--transition-smooth);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: 0 6px 20px rgba(231, 76, 60, 0.3);
        }

        .logout-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(231, 76, 60, 0.4);
        }

        /* ACTION BUTTONS */
        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        /* MODALS */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background: var(--card-gradient);
            margin: 5% auto;
            padding: 30px;
            border-radius: var(--border-radius);
            width: 90%;
            max-width: 500px;
            box-shadow: var(--shadow-heavy);
            animation: modalSlideIn 0.3s ease-out;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f3f4;
        }

        .modal-header h3 {
            font-size: 1.4em;
            color: #2c3e50;
            font-weight: 700;
        }

        .close {
            font-size: 1.8em;
            font-weight: bold;
            cursor: pointer;
            color: #aaa;
            transition: var(--transition-smooth);
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .close:hover {
            color: #e74c3c;
            background: rgba(231, 76, 60, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }

        .form-control {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1em;
            transition: var(--transition-smooth);
            background: white;
        }

        .form-control:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
        }

        /* ANIMATIONS */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .loading {
            animation: pulse 1.5s ease-in-out infinite;
        }

        /* PROGRESS BAR MEJORADA */
        .progress-container {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .progress-bar {
            flex: 1;
            background: #f1f3f4;
            height: 12px;
            border-radius: 6px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .progress-fill {
            height: 100%;
            background: var(--green-gradient);
            transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 2px 4px rgba(46, 204, 113, 0.3);
        }

        .progress-text {
            font-weight: bold;
            color: #2c3e50;
            font-size: 0.9em;
            min-width: 45px;
        }

        /* RESPONSIVE MEJORADO */
        @media (max-width: 1024px) {
            .sidebar {
                width: 250px;
            }
            
            .main-content {
                margin-left: 250px;
            }
            
            .dashboard-stats {
                grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .admin-container {
                flex-direction: column;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .nav-menu {
                display: flex;
                overflow-x: auto;
                padding: 15px;
                gap: 10px;
            }
            
            .nav-item {
                margin: 0;
                min-width: fit-content;
            }
            
            .nav-link {
                padding: 12px 20px;
                border-radius: 25px;
                white-space: nowrap;
            }
            
            .dashboard-stats {
                grid-template-columns: 1fr;
            }
            
            .top-bar {
                padding: 20px 25px;
            }
            
            .page-title {
                font-size: 1.8em;
            }
            
            .user-info {
                flex-direction: column;
                gap: 10px;
                padding: 15px;
            }
            
            .content-area {
                padding: 20px;
            }
            
            .table-container {
                overflow-x: auto;
            }
            
            .modal-content {
                width: 95%;
                margin: 10% auto;
                padding: 20px;
            }
        }

        /* TOOLTIPS */
        [data-tooltip] {
            position: relative;
        }

        [data-tooltip]:hover::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 125%;
            left: 50%;
            transform: translateX(-50%);
            background: #2c3e50;
            color: white;
            padding: 8px 12px;
            border-radius: 6px;
            font-size: 0.8em;
            white-space: nowrap;
            z-index: 1000;
            opacity: 0;
            animation: tooltipFadeIn 0.3s ease forwards;
        }

        @keyframes tooltipFadeIn {
            from { opacity: 0; transform: translateX(-50%) translateY(5px); }
            to { opacity: 1; transform: translateX(-50%) translateY(0); }
        }

        /* LOADING STATES */
        .btn.loading {
            position: relative;
            color: transparent;
        }

        .btn.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
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
            <a href="#" class="nav-link active" data-section="dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" data-section="clientes">
                <i class="fas fa-users"></i> Clientes
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" data-section="proyectos">
                <i class="fas fa-project-diagram"></i> Proyectos
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" data-section="pagos">
                <i class="fas fa-credit-card"></i> Pagos
            </a>
        </li>
        <!-- NUEVOS MENÚS PARA API -->
        <li class="nav-item">
            <a href="#" class="nav-link" data-section="apicliente">
                <i class="fas fa-code"></i> API Clientes
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" data-section="apitoken">
                <i class="fas fa-key"></i> API Tokens
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link" data-section="countrequest">
                <i class="fas fa-chart-bar"></i> API Requests
            </a>
        </li>
    </ul>
</div>


    <!-- MAIN CONTENT -->
    <div class="main-content">
        <!-- TOP BAR -->
        <div class="top-bar">
            <h1 class="page-title" id="pageTitle">Panel de Administración</h1>
            <div class="user-info">
                <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></strong></span>
                <div class="user-avatar"><?= strtoupper(substr($_SESSION['admin_name'] ?? 'A', 0, 1)); ?></div>
                <a href="/webcon/index.php?route=admin:logout" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>

        <!-- CONTENT AREA -->
        <div class="content-area">
            <!-- DASHBOARD SECTION -->
            <div class="content-section active" id="dashboard">
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon clients">
                                <i class="fas fa-users"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?= is_countable($clientes) ? count($clientes) : 0 ?></div>
                        <div class="stat-label">Total Clientes</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> Registrados
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon projects">
                                <i class="fas fa-project-diagram"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?= is_countable($proyectos) ? count($proyectos) : 0 ?></div>
                        <div class="stat-label">Total Proyectos</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> Activos
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon earnings">
                                <i class="fas fa-dollar-sign"></i>
                            </div>
                        </div>
                        <div class="stat-number">
                            S/. <?= is_countable($pagos) && count($pagos) > 0 ? number_format(array_sum(array_column($pagos, 'amount')), 2) : '0.00' ?>
                        </div>
                        <div class="stat-label">Total Ingresos</div>
                        <div class="stat-change positive">
                            <i class="fas fa-arrow-up"></i> Recaudado
                        </div>
                    </div>

                    <div class="stat-card">
                        <div class="stat-header">
                            <div class="stat-icon pending">
                                <i class="fas fa-clock"></i>
                            </div>
                        </div>
                        <div class="stat-number"><?= is_countable($pagos) ? count($pagos) : 0 ?></div>
                        <div class="stat-label">Total Pagos</div>
                        <div class="stat-change positive">
                            <i class="fas fa-check-circle"></i> Registrados
                        </div>
                    </div>
                </div>
            </div>

            <!-- CLIENTES SECTION -->
            <div class="content-section" id="clientes">
                <div class="table-container">
                    <div class="table-header">
                        <h3><i class="fas fa-users"></i> Gestión de Clientes</h3>
                        <a href="/webcon/index.php?route=cliente:createForm" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Agregar Cliente
                        </a>
                    </div>
                    <div class="search-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="search-input" placeholder="Buscar cliente por DNI, nombre, empresa..." onkeyup="filtrarTabla(this, 'clientesTable')">
                        </div>
                    </div>
                    <table id="clientesTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>DNI</th>
                                <th>Nombre</th>
                                <th>Empresa</th>
                                <th>Teléfono</th>
                                <th>Email</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_countable($clientes) && count($clientes) > 0): ?>
                                <?php foreach ($clientes as $c): ?>
                                <tr>
                                    <td><?= $c['id'] ?></td>
                                    <td><?= $c['dni'] ?></td>
                                    <td><?= htmlspecialchars($c['name']) ?></td>
                                    <td><?= htmlspecialchars($c['company']) ?></td>
                                    <td><?= $c['phone'] ?></td>
                                    <td><?= $c['email'] ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/webcon/index.php?route=cliente:editForm&id=<?= $c['id'] ?>" class="btn btn-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="/webcon/index.php?route=cliente:delete&id=<?= $c['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Está seguro de que desea eliminar este cliente?');">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" style="text-align:center;">No hay clientes registrados</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PROYECTOS SECTION -->
            <div class="content-section" id="proyectos">
                <div class="table-container">
                    <div class="table-header">
                        <h3><i class="fas fa-project-diagram"></i> Gestión de Proyectos</h3>
                        <a href="/webcon/index.php?route=proyecto:createForm" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Agregar Proyecto
                        </a>
                    </div>
                    <div class="search-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="search-input" placeholder="Buscar proyecto por cliente, nombre, tipo..." onkeyup="filtrarTabla(this, 'proyectosTable')">
                        </div>
                    </div>
                    <table id="proyectosTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Proyecto</th>
                                <th>Tipo</th>
                                <th>Progreso</th>
                                <th>Estado</th>
                                <th>Entrega</th>
                                <th>Precio</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_countable($proyectos) && count($proyectos) > 0): ?>
                                <?php foreach ($proyectos as $p): ?>
                                <tr>
                                    <td><?= $p['id'] ?></td>
                                    <td><?= htmlspecialchars($p['client_name']) ?></td>
                                    <td><?= htmlspecialchars($p['name']) ?></td>
                                    <td><?= $p['type'] ?></td>
                                    <td>
                                        <div style="display: flex; align-items: center; gap: 10px;">
                                            <div style="flex: 1; background: #ecf0f1; height: 8px; border-radius: 4px; overflow: hidden;">
                                                <div style="height: 100%; background: linear-gradient(90deg, #2ecc71, #27ae60); width: <?= $p['progress'] ?>%; transition: width 0.3s ease;"></div>
                                            </div>
                                            <span style="font-weight: bold; color: #2c3e50;"><?= $p['progress'] ?>%</span>
                                        </div>
                                    </td>
                                    <td>
                                        <?php 
                                        $statusClass = 'status-pending';
                                        if ($p['status'] == 'completado') $statusClass = 'status-completed';
                                        elseif ($p['status'] == 'en_progreso') $statusClass = 'status-progress';
                                        ?>
                                        <span class="status-badge <?= $statusClass ?>"><?= ucfirst($p['status']) ?></span>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($p['delivery_date'])) ?></td>
                                    <td>S/. <?= number_format($p['total_price'], 2) ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/webcon/index.php?route=proyecto:editForm&id=<?= $p['id'] ?>" class="btn btn-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="/webcon/index.php?route=proyecto:delete&id=<?= $p['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Desea eliminar este proyecto?');">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="9" style="text-align:center;">No hay proyectos registrados</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PAGOS SECTION -->
            <div class="content-section" id="pagos">
                <div class="table-container">
                    <div class="table-header">
                        <h3><i class="fas fa-credit-card"></i> Gestión de Pagos</h3>
                        <a href="/webcon/index.php?route=pago:createForm" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Agregar Pago
                        </a>
                    </div>
                    <div class="search-container">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" class="search-input" placeholder="Buscar pago por cliente, proyecto, fecha..." onkeyup="filtrarTabla(this, 'pagosTable')">
                        </div>
                    </div>
                    <table id="pagosTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Proyecto</th>
                                <th>Monto</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_countable($pagos) && count($pagos) > 0): ?>
                                <?php foreach ($pagos as $pago): ?>
                                <tr>
                                    <td><?= $pago['id'] ?? '-' ?></td>
                                    <td><?= htmlspecialchars($pago['client_name'] ?? '-') ?></td>
                                    <td><?= htmlspecialchars($pago['project_name'] ?? '-') ?></td>
                                    <td>S/. <?= isset($pago['amount']) ? number_format($pago['amount'], 2) : '0.00' ?></td>
                                    <td>
                                        <?= !empty($pago['payment_date']) ? date('d/m/Y', strtotime($pago['payment_date'])) : '-' ?>
                                    </td>
                                    <td>
                                        <?php 
                                            $status = $pago['status'] ?? 'pendiente';
                                            $statusClass = $status === 'pagado' ? 'status-completed' : 'status-pending';
                                        ?>
                                        <span class="status-badge <?= $statusClass ?>"><?= ucfirst($status) ?></span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="/webcon/index.php?route=pago:editForm&id=<?= $pago['id'] ?? 0 ?>" class="btn btn-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="/webcon/index.php?route=pago:delete&id=<?= $pago['id'] ?? 0 ?>" class="btn btn-delete" onclick="return confirm('¿Desea eliminar este pago?');">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr><td colspan="7" style="text-align:center;">No hay pagos registrados</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

          <!-- API CLIENTES SECTION -->
<div class="content-section" id="apicliente">
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-plug"></i> Gestión de API Clientes</h3>
            <a href="/webcon/index.php?route=api-cliente:createForm" class="btn btn-primary">
                <i class="fas fa-plus"></i> Agregar Cliente API
            </a>
        </div>

        <!-- DEBUG MEJORADO -->
        <div style="background: #e3f2fd; border: 1px solid #90caf9; padding: 15px; margin: 15px 0; border-radius: 5px;">
            <h4 style="margin: 0 0 10px 0; color: #1565c0;">🔍 INFORMACIÓN DE DATOS</h4>
            <p style="margin: 5px 0;"><strong>Estado:</strong> 
                <?php 
                if (!isset($apiClientes)) {
                    echo '<span style="color: red;">❌ Variable $apiClientes NO está definida</span>';
                } else if (!is_array($apiClientes)) {
                    echo '<span style="color: red;">❌ Variable $apiClientes no es un array. Tipo: ' . gettype($apiClientes) . '</span>';
                } else if (count($apiClientes) === 0) {
                    echo '<span style="color: orange;">⚠️  Array vacío (0 registros en la base de datos)</span>';
                } else {
                    echo '<span style="color: green;">✅ ' . count($apiClientes) . ' registro(s) encontrado(s) en la base de datos</span>';
                }
                ?>
            </p>
        </div>

        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" placeholder="Buscar cliente por RUC, razón social, teléfono..." onkeyup="filtrarTabla(this, 'apiClientesTable')">
            </div>
        </div>

        <table id="apiClientesTable">
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
                <?php if(isset($apiClientes) && is_array($apiClientes) && count($apiClientes) > 0): ?>
                    <?php foreach ($apiClientes as $cliente): ?>
                    <tr>
                        <td><?= $cliente['id'] ?? '-' ?></td>
                        <td><?= htmlspecialchars($cliente['ruc'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($cliente['razon_social'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($cliente['telefono'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($cliente['correo'] ?? '-') ?></td>
                        <td>
                            <?= !empty($cliente['fecha_registro']) ? date('d/m/Y', strtotime($cliente['fecha_registro'])) : '-' ?>
                        </td>
                        <td>
                            <?php 
                                $estado = $cliente['estado'] ?? 1;
                                $statusClass = $estado == 1 ? 'status-completed' : 'status-pending';
                                $statusText = $estado == 1 ? 'Activo' : 'Inactivo';
                            ?>
                            <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
                        </td>
                        <td>
                            <!-- En la sección API Clientes del dashboard.php -->
<div class="action-buttons">
    <a href="/webcon/index.php?route=api-cliente:editForm&id=<?= $cliente['id'] ?>" class="btn btn-edit">
        <i class="fas fa-edit"></i> Editar
    </a>
    <a href="/webcon/index.php?route=api-cliente:delete&id=<?= $cliente['id'] ?>" class="btn btn-delete" onclick="return confirm('¿Desea eliminar este cliente API?');">
        <i class="fas fa-trash"></i> Eliminar
    </a>
</div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="text-align:center; padding: 30px; color: #666;">
                            <i class="fas fa-database" style="font-size: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                            <p>No hay clientes API registrados</p>
                            <a href="/webcon/index.php?route=api-cliente:createForm" class="btn btn-primary">
    <i class="fas fa-plus"></i> Agregar Cliente API
</a>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- API TOKENS SECTION -->
<div class="content-section" id="apitoken">
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-key"></i> Gestión de API Tokens</h3>
            <a href="/webcon/index.php?route=apitoken:createForm" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Token
            </a>
        </div>

        <!-- Mostrar mensajes flash -->
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="flash-message flash-success">
                <i class="fas fa-check-circle"></i> <?= $_SESSION['flash'] ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="flash-message flash-error">
                <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" placeholder="Buscar token por cliente, token..." onkeyup="filtrarTabla(this, 'apitokensTable')">
            </div>
        </div>

        <table id="apitokensTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente API</th>
                    <th>Token</th>
                    <th>Fecha Registro</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Asegurar que la variable existe y es un array
                $apiTokens = isset($apiTokens) ? $apiTokens : [];
                ?>
                <?php if(is_countable($apiTokens) && count($apiTokens) > 0): ?>
                    <?php foreach ($apiTokens as $at): ?>
                    <tr>
                        <td><?= $at['id'] ?? '' ?></td>
                        <td><?= htmlspecialchars($at['razon_social'] ?? 'N/A') ?></td>
                        <td>
                            <div class="token-preview" title="<?= htmlspecialchars($at['token'] ?? '') ?>">
                                <?= htmlspecialchars(substr($at['token'] ?? '', 0, 20)) ?>...
                            </div>
                        </td>
                        <td><?= !empty($at['fecha_registro']) ? date('d/m/Y', strtotime($at['fecha_registro'])) : 'N/A' ?></td>
                        <td>
                            <span class="status-badge <?= ($at['estado'] ?? 0) ? 'status-completed' : 'status-pending' ?>">
                                <?= ($at['estado'] ?? 0) ? 'Activo' : 'Inactivo' ?>
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="/webcon/index.php?route=apitoken:editForm&id=<?= $at['id'] ?? '' ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/webcon/index.php?route=apitoken:regenerateToken&id=<?= $at['id'] ?? '' ?>" class="btn btn-primary btn-sm"
                                   onclick="return confirm('¿Estás seguro de regenerar el token? El anterior dejará de funcionar.')">
                                    <i class="fas fa-key"></i> Regenerar
                                </a>
                                <a href="/webcon/index.php?route=apitoken:delete&id=<?= $at['id'] ?? '' ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Estás seguro de eliminar este token?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; color: #7f8c8d; padding: 30px;">
                            <i class="fas fa-key" style="font-size: 48px; margin-bottom: 15px; display: block; opacity: 0.5;"></i>
                            No hay API tokens registrados
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- COUNT REQUEST SECTION -->
<div class="content-section" id="countrequest">
    <div class="table-container">
        <div class="table-header">
            <h3><i class="fas fa-chart-bar"></i> Registros de API Requests</h3>
            <a href="/webcon/index.php?route=countrequest:createForm" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nuevo Registro
            </a>
        </div>

        <!-- Mostrar mensajes flash -->
        <?php if (isset($_SESSION['flash'])): ?>
            <div class="flash-message flash-success">
                <i class="fas fa-check-circle"></i> <?= $_SESSION['flash'] ?>
            </div>
            <?php unset($_SESSION['flash']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="flash-message flash-error">
                <i class="fas fa-exclamation-circle"></i> <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Estadísticas -->
        <?php 
        $requestStats = isset($requestStats) ? $requestStats : [];
        if (!empty($requestStats)): 
        ?>
        <div style="padding: 20px 30px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-bottom: 1px solid #dee2e6;">
            <h4 style="margin-bottom: 15px; color: #2c3e50; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-chart-line"></i> Estadísticas (Últimos 7 días)
            </h4>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                <?php foreach ($requestStats as $stat): ?>
                <div style="text-align: center; padding: 15px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div style="font-size: 20px; font-weight: bold; color: var(--primary);">
                        <?= $stat['total_requests'] ?? 0 ?>
                    </div>
                    <div style="font-size: 12px; color: var(--secondary);">
                        <?= !empty($stat['request_date']) ? date('d/m', strtotime($stat['request_date'])) : 'N/A' ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" placeholder="Buscar request por token, tipo, fecha..." onkeyup="filtrarTabla(this, 'countrequestsTable')">
            </div>
        </div>

        <table id="countrequestsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Token</th>
                    <th>Cliente</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                // Asegurar que la variable existe y es un array
                $countRequests = isset($countRequests) ? $countRequests : [];
                ?>
                <?php if(is_countable($countRequests) && count($countRequests) > 0): ?>
                    <?php foreach ($countRequests as $cr): ?>
                    <tr>
                        <td><?= $cr['id'] ?? '' ?></td>
                        <td>
                            <div class="token-preview" title="<?= htmlspecialchars($cr['token'] ?? '') ?>">
                                <?= htmlspecialchars(substr($cr['token'] ?? '', 0, 15)) ?>...
                            </div>
                        </td>
                        <td><?= htmlspecialchars($cr['razon_social'] ?? 'N/A') ?></td>
                        <td>
                            <span class="status-badge status-completed">
                                <?= htmlspecialchars($cr['tipo'] ?? '') ?>
                            </span>
                        </td>
                        <td><?= !empty($cr['fecha']) ? date('d/m/Y H:i', strtotime($cr['fecha'])) : 'N/A' ?></td>
                        <td>
                            <div class="action-buttons">
                                <a href="/webcon/index.php?route=countrequest:editForm&id=<?= $cr['id'] ?? '' ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/webcon/index.php?route=countrequest:delete&id=<?= $cr['id'] ?? '' ?>" class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Estás seguro de eliminar este registro?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; color: #7f8c8d; padding: 30px;">
                            <i class="fas fa-chart-bar" style="font-size: 48px; margin-bottom: 15px; display: block; opacity: 0.5;"></i>
                            No hay registros de requests
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
            

<script>
document.addEventListener("DOMContentLoaded", () => {
    // --- Cambiar secciones ---
    const navLinks = document.querySelectorAll(".nav-link");
    const sections = document.querySelectorAll(".content-section");
    const pageTitle = document.getElementById("pageTitle");

    if (navLinks.length && sections.length && pageTitle) {
        navLinks.forEach(link => {
            link.addEventListener("click", e => {
                e.preventDefault();

                // Quitar "active" de todos los links
                navLinks.forEach(l => l.classList.remove("active"));
                link.classList.add("active");

                // Mostrar la sección correspondiente
                const sectionId = link.getAttribute("data-section");
                if (sectionId) {
                    sections.forEach(sec => sec.classList.remove("active"));
                    const targetSection = document.getElementById(sectionId);
                    if (targetSection) {
                        targetSection.classList.add("active");
                    }
                }

                // Cambiar título de página
                pageTitle.textContent = link.textContent.trim();
            });
        });
    }

    // --- Función de búsqueda en tablas ---
    window.filtrarTabla = function (input, tableId) {
        const filter = input.value.toUpperCase();
        const table = document.getElementById(tableId);

        if (!table) return;

        const tr = table.getElementsByTagName("tr");
        for (let i = 1; i < tr.length; i++) {
            let tdArray = tr[i].getElementsByTagName("td");
            let mostrar = false;
            for (let j = 0; j < tdArray.length; j++) {
                if (tdArray[j] && tdArray[j].textContent.toUpperCase().includes(filter)) {
                    mostrar = true;
                    break;
                }
            }
            tr[i].style.display = mostrar ? "" : "none";
        }
    };
});
</script>

</body>
</html>
