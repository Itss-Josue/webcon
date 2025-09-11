<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente | Webcon</title>
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
        }
        
        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 14px 15px 14px 45px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="email"]:focus {
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
            text-decoration: none;
        }
        
        .btn-cancel:hover {
            background-color: #d0d0d0;
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
            input[type="email"] {
                padding: 12px 12px 12px 40px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-users"></i> Editar Cliente</h1>
            <a href="/webcon/index.php?route=admin:clientes" class="back-button">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
        
        <div class="form-container">
            <h2 class="form-title"><i class="fas fa-user-edit"></i> Información del Cliente</h2>
            
            <form action="/webcon/index.php?route=cliente:update" method="POST" class="form-grid">
                <input type="hidden" name="id" value="<?= $cliente['id'] ?>">
                
                <div class="form-group">
                    <label for="dni">DNI:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" id="dni" name="dni" value="<?= htmlspecialchars($cliente['dni']) ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" value="<?= htmlspecialchars($cliente['name']) ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="company">Empresa:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-building"></i>
                        <input type="text" id="company" name="company" value="<?= htmlspecialchars($cliente['company']) ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="phone">Teléfono:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-phone"></i>
                        <input type="text" id="phone" name="phone" value="<?= htmlspecialchars($cliente['phone']) ?>">
                    </div>
                </div>
                
                <div class="form-group full-width">
                    <label for="email">Email:</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" value="<?= htmlspecialchars($cliente['email']) ?>">
                    </div>
                </div>
                
                <div class="form-actions">
                    <a href="/webcon/index.php?route=admin:clientes" class="btn btn-cancel">
                        <i class="fas fa-times"></i> Cancelar
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Cliente
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>