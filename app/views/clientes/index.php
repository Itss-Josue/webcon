<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hoteles en Huanta</title>
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
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            --hover-shadow: 0 10px 15px rgba(0, 0, 0, 0.15);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f1f5f9;
            color: var(--dark);
            line-height: 1.6;
            padding: 0;
            margin: 0;
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 20px;
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
            max-width: 1400px;
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
        
        .btn-danger {
            background-color: var(--danger);
            color: white;
        }
        
        .btn-danger:hover {
            background-color: #dc2626;
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }
        
        .btn-success {
            background-color: var(--success);
            color: white;
        }
        
        .btn-success:hover {
            background-color: #059669;
            transform: translateY(-2px);
            box-shadow: var(--card-shadow);
        }
        
        .card {
            background-color: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-header {
            padding: 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: linear-gradient(120deg, #f8fafc 0%, #e2e8f0 100%);
        }
        
        .card-title {
            font-size: 22px;
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .card-body {
            padding: 0;
        }
        
        .table-container {
            overflow-x: auto;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid var(--border);
        }
        
        th {
            background-color: #f1f5f9;
            font-weight: 600;
            color: var(--secondary);
            text-transform: uppercase;
            font-size: 13px;
            letter-spacing: 0.5px;
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover {
            background-color: #f8fafc;
        }
        
        .hotel-name {
            font-weight: 600;
            color: var(--primary);
        }
        
        .hotel-category {
            display: flex;
            gap: 2px;
        }
        
        .star {
            color: #ffc107;
            font-size: 14px;
        }
        
        .hotel-description {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .hotel-contact {
            display: flex;
            flex-direction: column;
            gap: 5px;
            font-size: 14px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .actions {
            display: flex;
            gap: 12px;
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 8px 12px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        
        .action-edit {
            background-color: #eff6ff;
            color: var(--primary);
        }
        
        .action-edit:hover {
            background-color: #dbeafe;
        }
        
        .action-delete {
            background-color: #fef2f2;
            color: var(--danger);
        }
        
        .action-delete:hover {
            background-color: #fee2e2;
        }
        
        .action-view {
            background-color: #f0fdf4;
            color: var(--success);
        }
        
        .action-view:hover {
            background-color: #dcfce7;
        }
        
        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: var(--secondary);
        }
        
        .empty-state i {
            font-size: 48px;
            margin-bottom: 15px;
            color: #cbd5e1;
        }
        
        .empty-state p {
            font-size: 16px;
            margin-bottom: 20px;
        }
        
        .filters {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
            flex-wrap: wrap;
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .filter-label {
            font-weight: 500;
            color: var(--secondary);
        }
        
        .filter-select {
            padding: 8px 12px;
            border: 1px solid var(--border);
            border-radius: 6px;
            background-color: white;
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border: 1px solid var(--border);
            border-radius: 6px;
            padding: 0 10px;
            flex: 1;
            max-width: 300px;
        }
        
        .search-input {
            padding: 8px;
            border: none;
            outline: none;
            width: 100%;
        }
        
        @media (max-width: 1024px) {
            .container {
                overflow-x: auto;
            }
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
            
            th, td {
                padding: 12px 15px;
            }
            
            .actions {
                flex-direction: column;
                gap: 8px;
            }
            
            .filters {
                flex-direction: column;
                align-items: stretch;
            }
            
            .search-box {
                max-width: 100%;
            }
        }
        
        @media (max-width: 576px) {
            .btn {
                padding: 8px 15px;
                font-size: 13px;
            }
            
            .card-header {
                flex-direction: column;
                gap: 15px;
                align-items: flex-start;
            }
            
            .app-title {
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
                <a href="index.php?controller=hotel&action=create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Agregar Hotel
                </a>
                <a href="index.php?controller=auth&action=login" class="btn btn-danger">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </header>
    
    <div class="container">
        <div class="filters">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" class="search-input" placeholder="Buscar hoteles...">
            </div>
            
            <div class="filter-group">
                <span class="filter-label">Categoría:</span>
                <select class="filter-select">
                    <option value="">Todas</option>
                    <option value="1">1 Estrella</option>
                    <option value="2">2 Estrellas</option>
                    <option value="3">3 Estrellas</option>
                    <option value="4">4 Estrellas</option>
                    <option value="5">5 Estrellas</option>
                </select>
            </div>
            
            <div class="filter-group">
                <span class="filter-label">Ordenar por:</span>
                <select class="filter-select">
                    <option value="name">Nombre</option>
                    <option value="category">Categoría</option>
                    <option value="district">Distrito</option>
                </select>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2 class="card-title"><i class="fas fa-list"></i> Lista de Hoteles</h2>
                <span><?php echo count($hotels); ?> hoteles registrados</span>
            </div>
            <div class="card-body">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Categoría</th>
                                <th>Descripción</th>
                                <th>Ubicación</th>
                                <th>Contacto</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($hotels)): ?>
                                <?php foreach ($hotels as $h): ?>
                                <tr>
                                    <td>
                                        <div class="hotel-name"><?= $h['name'] ?></div>
                                        <small>ID: <?= $h['id'] ?></small>
                                    </td>
                                    <td>
                                        <div class="hotel-category">
                                            <?php 
                                            $stars = isset($h['category']) ? $h['category'] : 0;
                                            for ($i = 0; $i < 5; $i++): 
                                            ?>
                                                <span class="star"><?= $i < $stars ? '★' : '☆' ?></span>
                                            <?php endfor; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="hotel-description" title="<?= isset($h['description']) ? $h['description'] : '' ?>">
                                            <?= isset($h['description']) ? (strlen($h['description']) > 50 ? substr($h['description'], 0, 50) . '...' : $h['description']) : 'Sin descripción' ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div><strong>Dirección:</strong> <?= $h['address'] ?></div>
                                        <div><strong>Distrito:</strong> <?= isset($h['district']) ? $h['district'] : 'N/A' ?></div>
                                        <div><strong>Provincia:</strong> <?= isset($h['province']) ? $h['province'] : 'N/A' ?></div>
                                    </td>
                                    <td>
                                        <div class="hotel-contact">
                                            <?php if (isset($h['phone'])): ?>
                                                <div class="contact-item">
                                                    <i class="fas fa-phone"></i> <?= $h['phone'] ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($h['email'])): ?>
                                                <div class="contact-item">
                                                    <i class="fas fa-envelope"></i> <?= $h['email'] ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (isset($h['website'])): ?>
                                                <div class="contact-item">
                                                    <i class="fas fa-globe"></i> 
                                                    <a href="<?= $h['website'] ?>" target="_blank">Sitio web</a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="actions">
                                            <a href="index.php?controller=hotel&action=view&id=<?= $h['id'] ?>" class="action-btn action-view">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                            <a href="index.php?controller=hotel&action=edit&id=<?= $h['id'] ?>" class="action-btn action-edit">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="index.php?controller=hotel&action=delete&id=<?= $h['id'] ?>" class="action-btn action-delete" onclick="return confirm('¿Estás seguro de que deseas eliminar este hotel?')">
                                                <i class="fas fa-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="fas fa-hotel"></i>
                                            <p>No hay hoteles registrados</p>
                                            <a href="index.php?controller=hotel&action=create" class="btn btn-primary">
                                                <i class="fas fa-plus"></i> Agregar primer hotel
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Efecto de confirmación mejorado para eliminación
        document.querySelectorAll('.action-delete').forEach(link => {
            link.addEventListener('click', function(e) {
                if (!confirm('¿Estás seguro de que deseas eliminar este hotel? Esta acción no se puede deshacer.')) {
                    e.preventDefault();
                }
            });
        });
        
        // Búsqueda en tiempo real
        const searchInput = document.querySelector('.search-input');
        const tableRows = document.querySelectorAll('tbody tr');
        
        searchInput.addEventListener('input', function() {
            const searchText = this.value.toLowerCase();
            
            tableRows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchText)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
        
        // Filtrado por categoría
        const categoryFilter = document.querySelector('.filter-select');
        categoryFilter.addEventListener('change', function() {
            const value = this.value;
            
            tableRows.forEach(row => {
                if (!value) {
                    row.style.display = '';
                    return;
                }
                
                const stars = row.querySelectorAll('.star').length;
                if (value == stars) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>