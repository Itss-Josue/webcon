<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente API</title>
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
            padding: 20px;
            text-align: center;
        }
        
        header h2 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        
        .form-container {
            padding: 30px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #2c3e50;
        }
        
        input[type="text"],
        input[type="email"],
        input[type="date"],
        select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        
        input:focus,
        select:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        button {
            background: linear-gradient(135deg, #3498db, #2980b9);
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }
        
        button:hover {
            background: linear-gradient(135deg, #2980b9, #1c5d87);
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
        }
        
        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #3498db;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .back-link:hover {
            color: #2980b9;
            text-decoration: underline;
        }
        
        .required::after {
            content: " *";
            color: #e74c3c;
        }
        
        .form-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
        }
        
        @media (max-width: 600px) {
            .form-footer {
                flex-direction: column;
                gap: 15px;
            }
            
            button {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h2>✏ Editar Cliente API</h2>
        </header>
        
        <div class="form-container">
            <form method="POST">
                <div class="form-group">
                    <label class="required">RUC:</label>
                    <input type="text" name="ruc" value="<?= htmlspecialchars($cliente['ruc']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label class="required">Razón Social:</label>
                    <input type="text" name="razon_social" value="<?= htmlspecialchars($cliente['razon_social']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Teléfono:</label>
                    <input type="text" name="telefono" value="<?= htmlspecialchars($cliente['telefono']) ?>">
                </div>
                
                <div class="form-group">
                    <label>Correo:</label>
                    <input type="email" name="correo" value="<?= htmlspecialchars($cliente['correo']) ?>">
                </div>
                
                <div class="form-group">
                    <label class="required">Fecha Registro:</label>
                    <input type="date" name="fecha_registro" value="<?= htmlspecialchars($cliente['fecha_registro']) ?>" required>
                </div>
                
                <div class="form-group">
                    <label>Estado:</label>
                    <select name="estado">
                        <option value="1" <?= $cliente['estado'] ? 'selected' : '' ?>>Activo</option>
                        <option value="0" <?= !$cliente['estado'] ? 'selected' : '' ?>>Inactivo</option>
                    </select>
                </div>
                
                <div class="form-footer">
                    <button type="submit">Actualizar</button>
                    <a href="index.php?route=apicliente:index" class="back-link">⬅ Volver</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>