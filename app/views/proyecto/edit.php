<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Proyecto | Webcon</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7f9;
            color: #333;
            padding: 20px;
            min-height: 100vh;
        }
        
        .container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e0e0e0;
        }
        
        .header h1 {
            color: #2c3e50;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 15px;
            background-color: #95a5a6;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        
        .back-button:hover {
            background-color: #7f8c8d;
        }
        
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            padding: 30px;
        }
        
        .form-title {
            color: #3498db;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f1f1f1;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group.full-width {
            grid-column: span 2;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
            font-size: 14px;
        }
        
        .input-with-icon {
            position: relative;
        }
        
        .input-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            z-index: 1;
        }
        
        input[type="text"],
        input[type="number"],
        input[type="date"],
        select {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: white;
        }
        
        select {
            appearance: none;
            background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%237f8c8d' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px;
        }
        
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        /* Estilos para selects con iconos */
        .select-with-icon {
            position: relative;
        }
        
        .select-with-icon i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #7f8c8d;
            z-index: 1;
        }
        
        .select-with-icon select {
            padding-left: 45px;
        }
        
        /* Barra de progreso visual */
        .progress-container {
            margin-top: 8px;
        }
        
        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #ecf0f1;
            border-radius: 4px;
            overflow: hidden;
            margin-bottom: 5px;
        }
        
        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #2ecc71, #27ae60);
            border-radius: 4px;
            transition: width 0.3s ease;
        }
        
        .progress-value {
            font-size: 12px;
            color: #7f8c8d;
            text-align: right;
        }
        
        /* Badge de estado */
        .status-badge {
            display: inline-block;
            padding: 8px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 5px;
        }
        
        .status-pending {
            background-color: #ffecd9;
            color: #e67e22;
        }
        
        .status-progress {
            background-color: #d6eaf8;
            color: #3498db;
        }
        
        .status-completed {
            background-color: #d5f5e3;
            color: #27ae60;
        }
        
        .form-actions {
            grid-column: span 2;
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }
        
        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }
        
        .btn-primary {
            background: linear-gradient(90deg, #3498db, #2980b9);
            color: white;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #2980b9, #3498db);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(41, 128, 185, 0.4);
        }
        
        .btn-cancel {
            background-color: #e0e0e0;
            color: #7f8c8d;
        }
        
        .btn-cancel:hover {
            background-color: #d0d0d0;
        }
        
        /* Alert flash */
        .alert {
            padding: 12px 15px;
            border-radius: 6px;
            margin-bottom: 20px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-success {
            background-color: #d5f5e3;
            color: #27ae60;
            border-left: 4px solid #2ecc71;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
            
            .form-group.full-width {
                grid-column: span 1;
            }
            
            .form-actions {
                grid-column: span 1;
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
                justify-content: center;
            }
        }
        
        @media (max-width: 480px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
            
            .form-container {
                padding: 20px;
            }
            
            input[type="text"],
            input[type="number"],
            input[type="date"],
            select {
                padding: 12px 12px 12px 40px;
            }
            
            .select-with-icon select {
                padding-left: 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-project-diagram"></i> Editar Proyecto</h1>
            <a href="/webcon/index.php?route=admin:dashboard#proyectos" class="back-button">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        
        <div class="form-container">
            <h2 class="form-title"><i class="fas fa-edit"></i> Información del Proyecto</h2>
            
            <?php if(isset($_SESSION['flash'])): ?>
                <div class="alert alert-success">
                    <i class="fas fa-check-circle"></i>
                    <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                </div>
            <?php endif; ?>
            
            <form action="/webcon/index.php?route=proyecto:edit&id=<?= $proyecto['id']; ?>" method="POST" class="form-grid">
                <div class="form-group">
                    <label for="client_id">Cliente:</label>
                    <div class="select-with-icon">
                        <i class="fas fa-user"></i>
                        <select id="client_id" name="client_id" required>
                            <?php foreach($clientes as $cliente): ?>
                                <option value="<?= $cliente['id']; ?>" <?= $proyecto['client_id'] == $cliente['id'] ? 'selected' : ''; ?>>
                                    <?= htmlspecialchars($cliente['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="name">Nombre del proyecto:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-tag"></i>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($proyecto['name']); ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="type">Tipo:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-tasks"></i>
                        <input type="text" id="type" name="type" value="<?= htmlspecialchars($proyecto['type']); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="progress">Progreso (%):</label>
                    <div class="input-with-icon">
                        <i class="fas fa-chart-line"></i>
                        <input type="number" id="progress" name="progress" min="0" max="100" value="<?= htmlspecialchars($proyecto['progress']); ?>">
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: <?= htmlspecialchars($proyecto['progress']); ?>%;"></div>
                        </div>
                        <div class="progress-value"><?= htmlspecialchars($proyecto['progress']); ?>% completado</div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="status">Estado:</label>
                    <div class="select-with-icon">
                        <i class="fas fa-status"></i>
                        <select id="status" name="status">
                            <option value="pending" <?= $proyecto['status']=='pending' ? 'selected' : ''; ?>>Pendiente</option>
                            <option value="in_progress" <?= $proyecto['status']=='in_progress' ? 'selected' : ''; ?>>En progreso</option>
                            <option value="completed" <?= $proyecto['status']=='completed' ? 'selected' : ''; ?>>Completado</option>
                        </select>
                    </div>
                    <div class="status-badge status-<?= $proyecto['status'] ?>">
                        <?php
                        $statusText = [
                            'pending' => 'Pendiente',
                            'in_progress' => 'En progreso',
                            'completed' => 'Completado'
                        ];
                        echo $statusText[$proyecto['status']];
                        ?>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="delivery_date">Fecha de entrega:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="date" id="delivery_date" name="delivery_date" value="<?= htmlspecialchars($proyecto['delivery_date']); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="total_price">Precio total:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-dollar-sign"></i>
                        <input type="number" step="0.01" id="total_price" name="total_price" value="<?= htmlspecialchars($proyecto['total_price']); ?>">
                    </div>
                </div>
                
                <div class="form-actions">
                    <a href="/webcon/index.php?route=admin:dashboard#proyectos" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Proyecto
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Actualizar la barra de progreso en tiempo real
        document.getElementById('progress').addEventListener('input', function() {
            const progressValue = this.value;
            document.querySelector('.progress-fill').style.width = progressValue + '%';
            document.querySelector('.progress-value').textContent = progressValue + '% completado';
        });
    </script>
</body>
</html>