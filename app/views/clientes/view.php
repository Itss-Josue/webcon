<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Hotel - Sistema de Hoteles</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary: #64748b;
            --light: #f8fafc;
            --dark: #1e293b;
            --success: #10b981;
            --danger: #ef4444;
            --warning: #f59e0b;
            --border: #e2e8f0;
            --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }
        
        header {
            background: linear-gradient(120deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px 0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .app-title {
            font-size: 28px;
            font-weight: 700;
        }
        
        .user-actions {
            display: flex;
            gap: 15px;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 14px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }
        
        .btn-secondary {
            background-color: var(--secondary);
            color: white;
        }
        
        .btn-secondary:hover {
            background-color: #475569;
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }
        
        .card {
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            margin-bottom: 30px;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-header {
            background: linear-gradient(120deg, var(--primary), var(--primary-dark));
            color: white;
            padding: 30px;
            text-align: center;
            position: relative;
        }
        
        .hotel-image {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 40px;
        }
        
        .hotel-name {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .hotel-category {
            display: flex;
            justify-content: center;
            gap: 5px;
            margin-bottom: 15px;
        }
        
        .star {
            color: #ffc107;
            font-size: 20px;
        }
        
        .hotel-id {
            background: rgba(255, 255, 255, 0.2);
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            display: inline-block;
        }
        
        .card-body {
            padding: 30px;
        }
        
        .info-section {
            margin-bottom: 30px;
        }
        
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--border);
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .info-item {
            display: flex;
            gap: 15px;
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            background: #eff6ff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary);
            flex-shrink: 0;
        }
        
        .info-content {
            flex: 1;
        }
        
        .info-label {
            font-weight: 500;
            color: var(--secondary);
            font-size: 14px;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 16px;
            color: var(--dark);
        }
        
        .info-value a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .info-value a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        .action-buttons {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }
        
        footer {
            background-color: var(--dark);
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: auto;
        }
        
        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .user-actions {
                justify-content: center;
            }
            
            .info-grid {
                grid-template-columns: 1fr;
            }
            
            .action-buttons {
                flex-direction: column;
            }
        }
        
        @media (max-width: 576px) {
            .btn {
                padding: 8px 15px;
                font-size: 13px;
            }
            
            .card-body {
                padding: 20px;
            }
            
            .card-header {
                padding: 20px;
            }
            
            .app-title {
                font-size: 24px;
            }
            
            .hotel-name {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <h1 class="app-title"><i class="fas fa-hotel"></i> Hoteles en Huanta</h1>
            <div class="user-actions">
                <a href="index.php?controller=hotel&action=index" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Volver al Listado
                </a>
                <a href="index.php?controller=auth&action=logout" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="hotel-image">
                    <i class="fas fa-hotel"></i>
                </div>
                <h2 class="hotel-name"><?= htmlspecialchars($hotel['name']) ?></h2>
                <div class="hotel-category">
                    <?php 
                    $stars = isset($hotel['category']) ? $hotel['category'] : 0;
                    for ($i = 0; $i < 5; $i++): 
                    ?>
                        <span class="star"><?= $i < $stars ? '★' : '☆' ?></span>
                    <?php endfor; ?>
                </div>
                <div class="hotel-id">ID: <?= htmlspecialchars($hotel['id']) ?></div>
            </div>
            
            <div class="card-body">
                <div class="info-section">
                    <h3 class="section-title"><i class="fas fa-info-circle"></i> Información General</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-align-left"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Descripción</div>
                                <div class="info-value"><?= htmlspecialchars($hotel['description']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="info-section">
                    <h3 class="section-title"><i class="fas fa-map-marker-alt"></i> Ubicación</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-location-dot"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Dirección</div>
                                <div class="info-value"><?= htmlspecialchars($hotel['address']) ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Distrito</div>
                                <div class="info-value"><?= htmlspecialchars($hotel['district']) ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Provincia</div>
                                <div class="info-value"><?= htmlspecialchars($hotel['province']) ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-map"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Departamento</div>
                                <div class="info-value"><?= htmlspecialchars($hotel['department']) ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="info-section">
                    <h3 class="section-title"><i class="fas fa-address-book"></i> Información de Contacto</h3>
                    
                    <div class="info-grid">
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Teléfono</div>
                                <div class="info-value"><?= htmlspecialchars($hotel['phone']) ?></div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Email</div>
                                <div class="info-value">
                                    <?php if (!empty($hotel['email'])): ?>
                                        <a href="mailto:<?= htmlspecialchars($hotel['email']) ?>"><?= htmlspecialchars($hotel['email']) ?></a>
                                    <?php else: ?>
                                        No especificado
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="info-content">
                                <div class="info-label">Página Web</div>
                                <div class="info-value">
                                    <?php if (!empty($hotel['website'])): ?>
                                        <a href="<?= htmlspecialchars($hotel['website']) ?>" target="_blank"><?= htmlspecialchars($hotel['website']) ?></a>
                                    <?php else: ?>
                                        No especificado
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="action-buttons">
                    <a href="index.php?controller=hotel&action=edit&id=<?= $hotel['id'] ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Editar Hotel
                    </a>
                    <a href="index.php?controller=hotel&action=index" class="btn btn-secondary">
                        <i class="fas fa-list"></i> Volver al Listado
                    </a>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>Sistema de Gestión de Hoteles en Huanta &copy; 2023</p>
    </footer>
</body>
</html>