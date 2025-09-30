<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle Cliente API</title>
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
            max-width: 800px;
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
            margin-bottom: 5px;
        }
        
        .content {
            padding: 30px;
        }
        
        .detail-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 25px;
            margin-bottom: 25px;
            border-left: 4px solid #3498db;
        }
        
        .detail-item {
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .detail-item:last-child {
            margin-bottom: 0;
            padding-bottom: 0;
            border-bottom: none;
        }
        
        .detail-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 5px;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-value {
            color: #495057;
            font-size: 16px;
            padding-left: 10px;
        }
        
        .status-active {
            color: #27ae60;
            font-weight: 600;
        }
        
        .status-inactive {
            color: #e74c3c;
            font-weight: 600;
        }
        
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .back-link:hover {
            background: linear-gradient(135deg, #2980b9, #1c5d87);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        .actions {
            display: flex;
            gap: 15px;
            margin-top: 25px;
            flex-wrap: wrap;
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 18px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            color: white;
        }
        
        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        @media (max-width: 600px) {
            .content {
                padding: 20px;
            }
            
            .detail-card {
                padding: 20px;
            }
            
            .actions {
                flex-direction: column;
            }
            
            .action-btn {
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h2>👁 Detalle Cliente API</h2>
        </header>
        
        <div class="content">
            <div class="detail-card">
                <div class="detail-item">
                    <div class="detail-label">ID</div>
                    <div class="detail-value"><?= htmlspecialchars($cliente['id']) ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">RUC</div>
                    <div class="detail-value"><?= htmlspecialchars($cliente['ruc']) ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Razón Social</div>
                    <div class="detail-value"><?= htmlspecialchars($cliente['razon_social']) ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Teléfono</div>
                    <div class="detail-value"><?= htmlspecialchars($cliente['telefono']) ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Correo</div>
                    <div class="detail-value"><?= htmlspecialchars($cliente['correo']) ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Fecha Registro</div>
                    <div class="detail-value"><?= htmlspecialchars($cliente['fecha_registro']) ?></div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-label">Estado</div>
                    <div class="detail-value <?= $cliente['estado'] ? 'status-active' : 'status-inactive' ?>">
                        <?= $cliente['estado'] ? '✅ Activo' : '❌ Inactivo' ?>
                    </div>
                </div>
            </div>
            
            <div class="actions">
                <a href="index.php?route=apicliente:index" class="back-link">⬅ Volver al Listado</a>
                <a href="index.php?route=apicliente:edit&id=<?= $cliente['id'] ?>" class="action-btn btn-edit">✏ Editar Cliente</a>
                <a href="index.php?route=apicliente:delete&id=<?= $cliente['id'] ?>" 
                   onclick="return confirm('¿Seguro de eliminar este cliente?')" 
                   class="action-btn btn-delete">🗑 Eliminar Cliente</a>
            </div>
        </div>
    </div>
</body>
</html>