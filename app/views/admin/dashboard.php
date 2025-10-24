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
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --primary-light: #818cf8;
    --secondary: #8b5cf6;
    --success: #10b981;
    --warning: #f59e0b;
    --danger: #ef4444;
    --info: #3b82f6;
    --dark: #0f172a;
    --dark-secondary: #1e293b;
    --dark-tertiary: #334155;
    --light: #f8fafc;
    --light-secondary: #f1f5f9;
    --text-primary: #0f172a;
    --text-secondary: #64748b;
    --border: #e2e8f0;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-md: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
    --radius: 12px;
    --radius-sm: 8px;
    --radius-lg: 16px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', 'Roboto', 'Oxygen', sans-serif;
    background: var(--light);
    min-height: 100vh;
    line-height: 1.6;
    color: var(--text-primary);
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
}

.admin-container {
    display: flex;
    min-height: 100vh;
    background: var(--light);
}

/* ==================== SIDEBAR ==================== */
.sidebar {
    width: 280px;
    background: var(--dark);
    color: white;
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    z-index: 100;
    border-right: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar::-webkit-scrollbar {
    width: 6px;
}

.sidebar::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.05);
}

.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255, 255, 255, 0.2);
    border-radius: 3px;
}

.sidebar::-webkit-scrollbar-thumb:hover {
    background: rgba(255, 255, 255, 0.3);
}

.sidebar-header {
    padding: 32px 24px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar-header h2 {
    font-size: 1.5rem;
    margin-bottom: 6px;
    font-weight: 700;
    color: white;
    display: flex;
    align-items: center;
    gap: 10px;
}

.sidebar-header p {
    color: rgba(255, 255, 255, 0.6);
    font-size: 0.875rem;
    font-weight: 400;
}

.nav-menu {
    list-style: none;
    padding: 16px 12px;
}

.nav-item {
    margin: 4px 0;
}

.nav-link {
    display: flex;
    align-items: center;
    padding: 12px 16px;
    color: rgba(255, 255, 255, 0.7);
    text-decoration: none;
    transition: var(--transition);
    border-radius: var(--radius-sm);
    font-weight: 500;
    font-size: 0.9375rem;
    position: relative;
}

.nav-link i {
    width: 20px;
    margin-right: 12px;
    font-size: 1.125rem;
    text-align: center;
}

.nav-link:hover {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    transform: translateX(4px);
}

.nav-link.active {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.4);
}

/* ==================== MAIN CONTENT ==================== */
.main-content {
    flex: 1;
    margin-left: 280px;
    background: var(--light);
}

.top-bar {
    background: white;
    padding: 20px 32px;
    box-shadow: var(--shadow-sm);
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border);
    position: sticky;
    top: 0;
    z-index: 50;
    backdrop-filter: blur(8px);
    background: rgba(255, 255, 255, 0.95);
}

.page-title {
    font-size: 1.875rem;
    color: var(--text-primary);
    font-weight: 700;
    letter-spacing: -0.025em;
}

.user-info {
    display: flex;
    align-items: center;
    gap: 16px;
    background: var(--light-secondary);
    padding: 10px 16px;
    border-radius: 999px;
    border: 1px solid var(--border);
}

.user-info span {
    font-size: 0.875rem;
    color: var(--text-secondary);
}

.user-info strong {
    color: var(--text-primary);
}

.user-avatar {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 1rem;
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2);
}

.content-area {
    padding: 32px;
    min-height: calc(100vh - 81px);
}

/* ==================== DASHBOARD CARDS ==================== */
.dashboard-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    background: white;
    padding: 24px;
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow);
    transition: var(--transition);
    border: 1px solid var(--border);
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary), var(--secondary));
}

.stat-card:nth-child(2)::before {
    background: linear-gradient(90deg, var(--success), #059669);
}

.stat-card:nth-child(3)::before {
    background: linear-gradient(90deg, var(--warning), #d97706);
}

.stat-card:nth-child(4)::before {
    background: linear-gradient(90deg, var(--danger), #dc2626);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.stat-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
}

.stat-icon {
    width: 52px;
    height: 52px;
    border-radius: var(--radius);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
}

.stat-icon.clients {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
}

.stat-icon.projects {
    background: linear-gradient(135deg, var(--success), #059669);
}

.stat-icon.earnings {
    background: linear-gradient(135deg, var(--warning), #d97706);
}

.stat-icon.pending {
    background: linear-gradient(135deg, var(--danger), #dc2626);
}

.stat-number {
    font-size: 2.25rem;
    font-weight: 800;
    color: var(--text-primary);
    line-height: 1;
    margin-bottom: 6px;
    letter-spacing: -0.025em;
}

.stat-label {
    color: var(--text-secondary);
    font-size: 0.875rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.stat-change {
    margin-top: 12px;
    font-size: 0.875rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.stat-change.positive {
    color: var(--success);
}

.stat-change.negative {
    color: var(--danger);
}

/* ==================== SECTIONS ==================== */
.content-section {
    display: none;
}

.content-section.active {
    display: block;
    animation: fadeInUp 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

/* ==================== TABLES ==================== */
.table-container {
    background: white;
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow);
    margin-top: 24px;
    border: 1px solid var(--border);
}

.table-header {
    background: var(--light-secondary);
    padding: 20px 28px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid var(--border);
}

.table-header h3 {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    gap: 10px;
}

/* ==================== BUTTONS ==================== */
.btn {
    padding: 10px 20px;
    border: none;
    border-radius: var(--radius-sm);
    cursor: pointer;
    font-size: 0.875rem;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-weight: 600;
    position: relative;
    overflow: hidden;
    white-space: nowrap;
}

.btn::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn:hover::before {
    width: 300px;
    height: 300px;
}

.btn:active {
    transform: scale(0.96);
}

.btn-primary {
    background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    color: white;
    box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
}

.btn-primary:hover {
    box-shadow: 0 6px 20px rgba(99, 102, 241, 0.4);
    transform: translateY(-2px);
}

.btn-success {
    background: linear-gradient(135deg, var(--success), #059669);
    color: white;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.btn-success:hover {
    box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
    transform: translateY(-2px);
}

.btn-warning {
    background: linear-gradient(135deg, var(--warning), #d97706);
    color: white;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.btn-warning:hover {
    box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
    transform: translateY(-2px);
}

.btn-danger {
    background: linear-gradient(135deg, var(--danger), #dc2626);
    color: white;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.btn-danger:hover {
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
    transform: translateY(-2px);
}

.btn-secondary {
    background: linear-gradient(135deg, #64748b, #475569);
    color: white;
    box-shadow: 0 4px 12px rgba(100, 116, 139, 0.3);
}

.btn-secondary:hover {
    box-shadow: 0 6px 20px rgba(100, 116, 139, 0.4);
    transform: translateY(-2px);
}

.btn-edit {
    background: var(--info);
    color: white;
    padding: 8px 14px;
    font-size: 0.8125rem;
}

.btn-edit:hover {
    background: #2563eb;
}

.btn-delete {
    background: var(--danger);
    color: white;
    padding: 8px 14px;
    font-size: 0.8125rem;
}

.btn-delete:hover {
    background: #dc2626;
}

.btn-sm {
    padding: 6px 14px;
    font-size: 0.8125rem;
}

/* ==================== TABLE STYLES ==================== */
table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 16px 24px;
    text-align: left;
    border-bottom: 1px solid var(--border);
}

th {
    background: var(--light-secondary);
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.8125rem;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

tr {
    transition: var(--transition);
}

tbody tr:hover {
    background: var(--light-secondary);
}

tbody tr:last-child td {
    border-bottom: none;
}

td {
    color: var(--text-primary);
    font-weight: 500;
    font-size: 0.9375rem;
}

/* ==================== STATUS BADGES ==================== */
.status-badge {
    padding: 6px 14px;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    display: inline-block;
}

.status-completed {
    background: #d1fae5;
    color: #065f46;
}

.status-progress {
    background: #dbeafe;
    color: #1e40af;
}

.status-pending {
    background: #fef3c7;
    color: #92400e;
}

/* ==================== SEARCH BOX ==================== */
.search-container {
    padding: 20px 28px;
    background: var(--light-secondary);
    border-bottom: 1px solid var(--border);
}

.search-box {
    display: flex;
    align-items: center;
    background: white;
    border-radius: 999px;
    padding: 12px 20px;
    box-shadow: var(--shadow-sm);
    border: 1px solid var(--border);
    transition: var(--transition);
}

.search-box:focus-within {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.search-box i {
    color: var(--text-secondary);
    margin-right: 12px;
    font-size: 1rem;
}

.search-input {
    border: none;
    outline: none;
    flex: 1;
    font-size: 0.9375rem;
    background: transparent;
    color: var(--text-primary);
}

.search-input::placeholder {
    color: var(--text-secondary);
}

/* ==================== LOGOUT BUTTON ==================== */
.logout-btn {
    background: linear-gradient(135deg, var(--danger), #dc2626);
    color: white;
    border: none;
    padding: 10px 18px;
    border-radius: 999px;
    font-size: 0.875rem;
    cursor: pointer;
    transition: var(--transition);
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.logout-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
}

/* ==================== ACTION BUTTONS ==================== */
.action-buttons {
    display: flex;
    gap: 8px;
    align-items: center;
    flex-wrap: wrap;
}

/* ==================== MODALS ==================== */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
}

.modal-content {
    background: white;
    margin: 5% auto;
    padding: 32px;
    border-radius: var(--radius-lg);
    width: 90%;
    max-width: 500px;
    box-shadow: var(--shadow-xl);
    animation: modalSlideIn 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border);
}

.modal-header h3 {
    font-size: 1.5rem;
    color: var(--text-primary);
    font-weight: 700;
}

.close {
    font-size: 1.5rem;
    font-weight: bold;
    cursor: pointer;
    color: var(--text-secondary);
    transition: var(--transition);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
}

.close:hover {
    color: var(--danger);
    background: rgba(239, 68, 68, 0.1);
}

/* ==================== FORMS ==================== */
.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-weight: 600;
    color: var(--text-primary);
    font-size: 0.875rem;
}

.form-control {
    width: 100%;
    padding: 12px 16px;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    font-size: 0.9375rem;
    transition: var(--transition);
    background: white;
    color: var(--text-primary);
}

.form-control:focus {
    outline: none;
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* ==================== ANIMATIONS ==================== */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes modalSlideIn {
    from {
        opacity: 0;
        transform: scale(0.95);
    }
    to {
        opacity: 1;
        transform: scale(1);
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

/* ==================== PROGRESS BAR ==================== */
.progress-container {
    display: flex;
    align-items: center;
    gap: 12px;
}

.progress-bar {
    flex: 1;
    background: var(--light-secondary);
    height: 8px;
    border-radius: 999px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--success), #059669);
    transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1);
}

.progress-text {
    font-weight: 700;
    color: var(--text-primary);
    font-size: 0.875rem;
    min-width: 45px;
}

/* ==================== TOKEN PREVIEW ==================== */
.token-preview {
    font-family: 'Courier New', monospace;
    background: var(--light-secondary);
    padding: 6px 12px;
    border-radius: var(--radius-sm);
    font-size: 0.8125rem;
    color: var(--text-primary);
    cursor: help;
    display: inline-block;
}

/* ==================== RESPONSIVE ==================== */
@media (max-width: 1024px) {
    .sidebar {
        width: 260px;
    }
    
    .main-content {
        margin-left: 260px;
    }
    
    .dashboard-stats {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
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
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .nav-menu {
        display: flex;
        overflow-x: auto;
        padding: 12px;
        gap: 8px;
    }
    
    .nav-item {
        margin: 0;
    }
    
    .nav-link {
        padding: 10px 16px;
        border-radius: 999px;
        white-space: nowrap;
    }
    
    .dashboard-stats {
        grid-template-columns: 1fr;
    }
    
    .top-bar {
        padding: 16px 20px;
        flex-direction: column;
        gap: 16px;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .user-info {
        width: 100%;
        justify-content: space-between;
    }
    
    .content-area {
        padding: 20px;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .table-header {
        flex-direction: column;
        gap: 16px;
        align-items: flex-start;
    }
    
    .action-buttons {
        flex-direction: column;
        width: 100%;
    }
    
    .action-buttons .btn {
        width: 100%;
        justify-content: center;
    }
    
    .modal-content {
        width: 95%;
        margin: 10% auto;
        padding: 24px;
    }
}

/* ==================== LOADING STATES ==================== */
.btn.loading {
    position: relative;
    color: transparent;
    pointer-events: none;
}

.btn.loading::after {
    content: '';
    position: absolute;
    width: 16px;
    height: 16px;
    top: 50%;
    left: 50%;
    margin-left: -8px;
    margin-top: -8px;
    border: 2px solid transparent;
    border-top: 2px solid currentColor;
    border-radius: 50%;
    animation: spin 0.8s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* ==================== TOOLTIPS ==================== */
[data-tooltip] {
    position: relative;
}

[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    bottom: 125%;
    left: 50%;
    transform: translateX(-50%);
    background: var(--dark);
    color: white;
    padding: 8px 12px;
    border-radius: var(--radius-sm);
    font-size: 0.8125rem;
    white-space: nowrap;
    z-index: 1000;
    box-shadow: var(--shadow-lg);
    animation: tooltipFadeIn 0.2s ease;
}

@keyframes tooltipFadeIn {
    from {
        opacity: 0;
        transform: translateX(-50%) translateY(4px);
    }
    to {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }
}

/* ==================== SCROLLBAR ==================== */
::-webkit-scrollbar {
    width: 10px;
    height: 10px;
}

::-webkit-scrollbar-track {
    background: var(--light);
}

::-webkit-scrollbar-thumb {
    background: var(--border);
    border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
    background: var(--text-secondary);
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
                            <div class="action-buttons">
                                <a href="/webcon/index.php?route=api-cliente:editForm&id=<?= $cliente['id'] ?>" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/webcon/index.php?route=api-cliente:delete&id=<?= $cliente['id'] ?>" 
                                   class="btn btn-delete" 
                                   onclick="confirmDelete(event, '¿Está seguro de eliminar este cliente API?')">
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
                            <a href="/webcon/index.php?route=api-cliente:createForm" class="btn btn-primary" style="margin-top: 10px;">
                                <i class="fas fa-plus"></i> Agregar primer cliente API
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
                <i class="fas fa-plus"></i> Generar Token API
            </a>
        </div>

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
                <?php if(isset($apiTokens) && is_array($apiTokens) && count($apiTokens) > 0): ?>
                    <?php foreach ($apiTokens as $token): ?>
                    <tr>
                        <td><?= $token['id'] ?? '-' ?></td>
                        <td><?= htmlspecialchars($token['razon_social'] ?? 'N/A') ?></td>
                        <td>
                            <div class="token-preview" title="<?= htmlspecialchars($token['token'] ?? '') ?>">
                                <?= htmlspecialchars(substr($token['token'] ?? '', 0, 20)) ?>...
                            </div>
                        </td>
                        <td>
                            <?= !empty($token['fecha_registro']) ? date('d/m/Y', strtotime($token['fecha_registro'])) : '-' ?>
                        </td>
                        <td>
                            <?php 
                                $estado = $token['estado'] ?? 1;
                                $statusClass = $estado == 1 ? 'status-completed' : 'status-pending';
                                $statusText = $estado == 1 ? 'Activo' : 'Inactivo';
                            ?>
                            <span class="status-badge <?= $statusClass ?>"><?= $statusText ?></span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <!-- Botón VER agregado -->
                                <a href="/webcon/index.php?route=apitoken:view&id=<?= $token['id'] ?>" class="btn btn-info">
                                    <i class="fas fa-eye"></i> Ver
                                </a>
                                
                                <a href="/webcon/index.php?route=apitoken:editForm&id=<?= $token['id'] ?>" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding: 30px; color: #666;">
                            <i class="fas fa-key" style="font-size: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                            <p>No hay tokens API registrados</p>
                            <a href="/webcon/index.php?route=apitoken:createForm" class="btn btn-primary" style="margin-top: 10px;">
                                <i class="fas fa-plus"></i> Generar primer token API
                            </a>
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

        <!-- Estadísticas -->
        <?php if (isset($requestStats) && is_array($requestStats) && count($requestStats) > 0): ?>
        <div style="padding: 20px 30px; background: linear-gradient(135deg, #f8f9fa, #e9ecef); border-bottom: 1px solid #dee2e6;">
            <h4 style="margin-bottom: 15px; color: #2c3e50; display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-chart-line"></i> Estadísticas (Últimos 7 días)
            </h4>
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 15px;">
                <?php foreach ($requestStats as $stat): ?>
                <div style="text-align: center; padding: 15px; background: white; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                    <div style="font-size: 20px; font-weight: bold; color: #3498db;">
                        <?= $stat['total_requests'] ?? 0 ?>
                    </div>
                    <div style="font-size: 12px; color: #7f8c8d;">
                        <?= !empty($stat['fecha']) ? date('d/m', strtotime($stat['fecha'])) : 'N/A' ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <div class="search-container">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" placeholder="Buscar request por cliente, token, tipo..." onkeyup="filtrarTabla(this, 'countrequestsTable')">
            </div>
        </div>

        <table id="countrequestsTable">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Token</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if(isset($countRequests) && is_array($countRequests) && count($countRequests) > 0): ?>
                    <?php foreach ($countRequests as $request): ?>
                    <tr>
                        <td><?= $request['id'] ?? '-' ?></td>
                        <td><?= htmlspecialchars($request['razon_social'] ?? 'N/A') ?></td>
                        <td>
                            <div class="token-preview" title="<?= htmlspecialchars($request['token'] ?? '') ?>">
                                <?= htmlspecialchars(substr($request['token'] ?? '', 0, 15)) ?>...
                            </div>
                        </td>
                        <td>
                            <?php 
                                $tipo = $request['tipo'] ?? '';
                                $tipos = [
                                    'consulta' => 'Consulta',
                                    'autenticacion' => 'Autenticación',
                                    'reporte' => 'Reporte',
                                    'validacion' => 'Validación',
                                    'api_consulta' => 'API Consulta',
                                    'auth_login' => 'Auth Login',
                                    'data_export' => 'Exportación',
                                    'report_generate' => 'Reporte',
                                    'user_validation' => 'Validación'
                                ];
                                $tipoText = $tipos[$tipo] ?? ucfirst($tipo);
                            ?>
                            <span class="status-badge status-completed"><?= $tipoText ?></span>
                        </td>
                        <td>
                            <?= !empty($request['fecha']) ? date('d/m/Y', strtotime($request['fecha'])) : '-' ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="/webcon/index.php?route=countrequest:editForm&id=<?= $request['id'] ?>" class="btn btn-edit">
                                    <i class="fas fa-edit"></i> Editar
                                </a>
                                <a href="/webcon/index.php?route=countrequest:delete&id=<?= $request['id'] ?>" 
                                   class="btn btn-delete" 
                                   onclick="confirmDelete(event, '¿Está seguro de eliminar este registro de request?')">
                                    <i class="fas fa-trash"></i> Eliminar
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align:center; padding: 30px; color: #666;">
                            <i class="fas fa-chart-bar" style="font-size: 48px; margin-bottom: 10px; opacity: 0.5;"></i>
                            <p>No hay registros de requests</p>
                            <a href="/webcon/index.php?route=countrequest:createForm" class="btn btn-primary" style="margin-top: 10px;">
                                <i class="fas fa-plus"></i> Crear primer registro
                            </a>
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