<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Pago | Webcon</title>
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
            max-width: 800px;
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
        select,
        textarea {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
            background-color: white;
        }
        
        textarea {
            min-height: 100px;
            resize: vertical;
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
        select:focus,
        textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
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
            select,
            textarea {
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
            <h1><i class="fas fa-credit-card"></i> Editar Pago</h1>
            <a href="index.php?route=admin:dashboard#pagos" class="back-button">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        
        <div class="form-container">
            <h2 class="form-title"><i class="fas fa-money-bill-wave"></i> Información del Pago</h2>
            
            <form method="POST" action="index.php?route=pago:update&id=<?= $pago['id'] ?>" class="form-grid">
                <div class="form-group">
                    <label for="client_id">Cliente:</label>
                    <div class="select-with-icon">
                        <i class="fas fa-user"></i>
                        <select id="client_id" name="client_id" required>
                            <option value="">-- Selecciona un cliente --</option>
                            <?php foreach ($clientes as $cliente): ?>
                                <option value="<?= $cliente['id'] ?>" <?= $cliente['id'] == $pago['client_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cliente['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="project_id">Proyecto:</label>
                    <div class="select-with-icon">
                        <i class="fas fa-project-diagram"></i>
                        <select id="project_id" name="project_id" required>
                            <option value="">-- Selecciona un proyecto --</option>
                            <?php foreach ($proyectos as $proyecto): ?>
                                <option value="<?= $proyecto['id'] ?>" <?= $proyecto['id'] == $pago['project_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($proyecto['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="amount">Monto:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-dollar-sign"></i>
                        <input type="number" id="amount" name="amount" step="0.01" value="<?= $pago['amount'] ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="method">Método de Pago:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-credit-card"></i>
                        <input type="text" id="method" name="method" value="<?= htmlspecialchars($pago['method']) ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="paid_at">Fecha de Pago:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-calendar"></i>
                        <input type="date" id="paid_at" name="paid_at" value="<?= $pago['paid_at'] ?>" required>
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="note">Nota:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-sticky-note"></i>
                        <textarea id="note" name="note"><?= htmlspecialchars($pago['note']) ?></textarea>
                    </div>
                </div>
                
                <div class="form-actions">
                    <a href="index.php?route=admin:dashboard#pagos" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Pago
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>